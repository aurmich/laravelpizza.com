# Xot Module - Ottimizzazioni e Correzioni (CORE MODULE)

## Panoramica
Il modulo Xot è il **CORE MODULE** dell'architettura, fornendo funzionalità base condivise da tutti gli altri moduli. Dall'analisi del codice emergono diversi punti critici che richiedono ottimizzazione immediata.

## 🚨 Problemi Critici Identificati

### 1. Actions - Problemi Architetturali

#### SendMailByRecordAction
**File:** `Modules/Xot/app/Actions/Mail/SendMailByRecordAction.php`

**Problemi identificati:**
- Action troppo generico senza type hints specifici
- Gestione errori insufficiente
- Mancanza di rate limiting per invio email

**Correzioni consigliate:**
```php
class SendMailByRecordAction
{
    public function __construct(
        private MailManager $mail,
        private RateLimiter $rateLimiter,
        private NotificationService $notifications
    ) {}

    public function execute(
        Model $record, 
        string $template, 
        ?User $recipient = null,
        array $data = []
    ): SendMailResult {
        // Rate limiting
        $key = "send-mail:{$record->getMorphClass()}:{$record->getKey()}";
        if ($this->rateLimiter->tooManyAttempts($key, 10, 60)) {
            throw new TooManyEmailsException();
        }

        try {
            $this->rateLimiter->hit($key);

            // Validate record supports mailing
            if (!$record instanceof Mailable) {
                throw new InvalidMailableRecordException();
            }

            // Send email
            $result = $record->sendMail($template, $recipient, $data);

            // Log success
            Log::info('Email sent successfully', [
                'record_type' => $record->getMorphClass(),
                'record_id' => $record->getKey(),
                'template' => $template,
            ]);

            return new SendMailResult(true, $result);

        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'record_type' => $record->getMorphClass(),
                'record_id' => $record->getKey(),
                'error' => $e->getMessage(),
            ]);

            // Notify admins of failure
            $this->notifications->notifyAdmins(
                new MailSendingFailedNotification($record, $e)
            );

            throw $e;
        }
    }
}
```

### 2. Model Actions - Problemi di Performance

#### GetAllModelsAction
**Problemi:**
- Caricamento di tutti i modelli in memoria (performance risk)
- Mancanza di caching
- Pattern non scalabile

**Ottimizzazioni:**
```php
class GetAllModelsAction
{
    public function __construct(private Cache $cache) {}

    public function execute(bool $forceRefresh = false): Collection
    {
        return $this->cache->remember(
            'all_models_list',
            3600, // 1 hour
            fn() => $this->discoverModels()
        );
    }

    private function discoverModels(): Collection
    {
        $models = collect();
        
        // Get models from all modules
        $modules = app('modules')->allEnabled();
        
        foreach ($modules as $module) {
            $modelPath = $module->getPath() . '/app/Models';
            
            if (!File::exists($modelPath)) {
                continue;
            }
            
            $modelFiles = File::allFiles($modelPath);
            
            foreach ($modelFiles as $file) {
                $className = $this->getClassNameFromFile($file, $module);
                
                if ($this->isValidModel($className)) {
                    $models->push([
                        'class' => $className,
                        'module' => $module->getName(),
                        'table' => app($className)->getTable(),
                    ]);
                }
            }
        }
        
        return $models->sortBy('class');
    }

    private function isValidModel(string $className): bool
    {
        try {
            return class_exists($className) 
                && is_subclass_of($className, Model::class)
                && !(new \ReflectionClass($className))->isAbstract();
        } catch (\Exception) {
            return false;
        }
    }
}
```

### 3. State Management - XotBaseState

**Problemi identificati:**
- State management senza type safety
- Mancanza di validation
- Pattern non thread-safe

**Miglioramenti:**
```php
abstract class XotBaseState
{
    protected array $data = [];
    protected array $rules = [];
    protected array $casts = [];

    public function __construct(array $data = [])
    {
        $this->validateAndSet($data);
    }

    public function set(string $key, mixed $value): static
    {
        $this->validateSingle($key, $value);
        
        $this->data[$key] = $this->castValue($key, $value);
        
        return $this;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function merge(array $data): static
    {
        $this->validateAndSet($data);
        
        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    private function validateAndSet(array $data): void
    {
        $validator = Validator::make($data, $this->rules);
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        foreach ($data as $key => $value) {
            $this->data[$key] = $this->castValue($key, $value);
        }
    }

    private function validateSingle(string $key, mixed $value): void
    {
        if (isset($this->rules[$key])) {
            $validator = Validator::make(
                [$key => $value], 
                [$key => $this->rules[$key]]
            );
            
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
    }

    private function castValue(string $key, mixed $value): mixed
    {
        if (!isset($this->casts[$key])) {
            return $value;
        }

        return match ($this->casts[$key]) {
            'int', 'integer' => (int) $value,
            'float', 'double' => (float) $value,
            'bool', 'boolean' => (bool) $value,
            'string' => (string) $value,
            'array' => (array) $value,
            'json' => is_string($value) ? json_decode($value, true) : $value,
            'datetime' => $value instanceof Carbon ? $value : Carbon::parse($value),
            default => $value,
        };
    }
}
```

## 🔧 Filament Resources - XotBaseResource

### Problemi Architetturali
**Analisi del base resource rivela:**
- Mancanza di standard per form/table schema
- Inconsistenza nei pattern di resource
- Performance issues con eager loading

### Optimized XotBaseResource
```php
abstract class XotBaseResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static int $globalSearchResultsLimit = 20;
    protected static bool $shouldRegisterNavigation = true;

    // Abstract methods che ogni resource deve implementare
    abstract public static function getFormSchema(): array;
    abstract public static function getTableColumns(): array;

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getTableColumns())
            ->filters(static::getTableFilters())
            ->actions(static::getTableActions())
            ->bulkActions(static::getBulkActions())
            ->defaultSort('created_at', 'desc');
    }

    public static function getTableFilters(): array
    {
        return [
            Tables\Filters\TrashedFilter::make(),
        ];
    }

    public static function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
    }

    public static function getBulkActions(): array
    {
        return [
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => static::getIndexPage()::route('/'),
            'create' => static::getCreatePage()::route('/create'),
            'view' => static::getViewPage()::route('/{record}'),
            'edit' => static::getEditPage()::route('/{record}/edit'),
        ];
    }

    // Template method pattern for page customization
    protected static function getIndexPage(): string
    {
        return Pages\ListRecords::class;
    }

    protected static function getCreatePage(): string  
    {
        return Pages\CreateRecord::class;
    }

    protected static function getViewPage(): string
    {
        return Pages\ViewRecord::class;
    }

    protected static function getEditPage(): string
    {
        return Pages\EditRecord::class;
    }

    // Enhanced query optimization
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(static::getDefaultEagerLoads())
            ->withoutGlobalScopes(static::getExcludedGlobalScopes());
    }

    protected static function getDefaultEagerLoads(): array
    {
        return [];
    }

    protected static function getExcludedGlobalScopes(): array
    {
        return [];
    }
}
```

## 📊 Performance Optimizations

### 1. Service Container Optimization
```php
// XotServiceProvider enhancements
class XotServiceProvider extends ServiceProvider
{
    protected array $singletons = [
        'xot.cache' => CacheManager::class,
        'xot.models' => ModelRegistry::class,
        'xot.permissions' => PermissionManager::class,
    ];

    public function register(): void
    {
        // Register core services as singletons for better performance
        foreach ($this->singletons as $alias => $concrete) {
            $this->app->singleton($alias, $concrete);
        }

        // Register configuration
        $this->mergeConfigFrom(__DIR__.'/../config/xot.php', 'xot');
        
        // Register macro extensions
        $this->registerMacros();
    }

    public function boot(): void
    {
        // Boot performance optimizations
        $this->optimizeQueries();
        $this->registerEventListeners();
        $this->publishAssets();
    }

    private function optimizeQueries(): void
    {
        // Prevent N+1 queries in development
        if (app()->environment('local')) {
            DB::enableQueryLog();
            
            $this->app['events']->listen(RequestHandled::class, function () {
                $queries = DB::getQueryLog();
                if (count($queries) > 50) {
                    Log::warning('High query count detected', [
                        'count' => count($queries),
                        'url' => request()->url(),
                    ]);
                }
            });
        }
    }
}
```

### 2. Caching Strategy
```php
class XotCacheService
{
    private const CACHE_PREFIX = 'xot:';
    private const DEFAULT_TTL = 3600;

    public function remember(string $key, callable $callback, ?int $ttl = null): mixed
    {
        $cacheKey = self::CACHE_PREFIX . $key;
        $ttl = $ttl ?? self::DEFAULT_TTL;

        return Cache::remember($cacheKey, $ttl, $callback);
    }

    public function rememberForever(string $key, callable $callback): mixed
    {
        $cacheKey = self::CACHE_PREFIX . $key;
        
        return Cache::rememberForever($cacheKey, $callback);
    }

    public function flush(string $pattern = '*'): void
    {
        $keys = Cache::getRedis()->keys(self::CACHE_PREFIX . $pattern);
        
        if (!empty($keys)) {
            Cache::getRedis()->del($keys);
        }
    }

    public function tags(array $tags): self
    {
        // For Redis/Memcached with tag support
        if (Cache::getStore() instanceof TaggableStore) {
            return new static(Cache::tags($tags));
        }

        return $this;
    }
}
```

## 🛡️ Security Enhancements

### 1. Input Sanitization
```php
class XotSanitizer
{
    public function sanitizeInput(array $data): array
    {
        return array_map(function ($value) {
            if (is_string($value)) {
                // Basic XSS protection
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                
                // SQL injection prevention (additional layer)
                $value = addslashes($value);
                
                // Remove potentially dangerous protocols
                $value = preg_replace('/javascript:/i', '', $value);
                $value = preg_replace('/vbscript:/i', '', $value);
                
                return trim($value);
            }
            
            if (is_array($value)) {
                return $this->sanitizeInput($value);
            }
            
            return $value;
        }, $data);
    }
}
```

### 2. Rate Limiting Service
```php
class XotRateLimiter
{
    public function __construct(private RateLimiter $limiter) {}

    public function attempt(string $key, int $maxAttempts, int $decayMinutes): bool
    {
        $key = 'xot:rate_limit:' . $key;
        
        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decayMinutes)) {
            return false;
        }

        $this->limiter->hit($key, $decayMinutes * 60);
        
        return true;
    }

    public function clear(string $key): void
    {
        $key = 'xot:rate_limit:' . $key;
        $this->limiter->clear($key);
    }
}
```

## 🧪 Testing Infrastructure

### 1. Base Test Classes
```php
abstract class XotTestCase extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup test environment
        $this->artisan('module:seed');
        $this->setupTestData();
    }

    protected function setupTestData(): void
    {
        // Override in specific test classes
    }

    protected function actingAsAdmin(): self
    {
        $admin = User::factory()->create();
        $admin->assignRole('super-admin');
        
        return $this->actingAs($admin);
    }

    protected function assertDatabaseHasModel(Model $model, array $attributes = []): void
    {
        $this->assertDatabaseHas($model->getTable(), array_merge([
            $model->getKeyName() => $model->getKey(),
        ], $attributes));
    }
}
```

## 🎯 Priorità di Implementazione

### 🔴 Critica (Immediata - CORE MODULE)
1. ✅ Ottimizzare GetAllModelsAction per performance
2. ✅ Fix SendMailByRecordAction con proper error handling
3. ✅ Implementare XotBaseState type safety
4. ✅ Enhanced XotBaseResource standardization

### 🟡 Alta (Entro 3 giorni - Impatta tutti i moduli)
1. Service container optimization
2. Caching strategy implementation
3. Security enhancements (sanitization, rate limiting)
4. Base test infrastructure

### 🟢 Media (Entro 1 settimana)
1. Performance monitoring
2. Advanced error handling
3. Documentation improvements
4. Module dependency management

### 🔵 Bassa (Future)
1. Advanced state management patterns
2. Module hot-reloading
3. Advanced caching strategies
4. Performance analytics

## 💡 Conclusioni Critiche

Il modulo Xot essendo il **CORE MODULE** ha impatto diretto su tutti gli altri moduli dell'applicazione. I problemi identificati, se non corretti, si propagano su tutto il sistema:

### Impatti Critici:
1. **GetAllModelsAction**: Può causare memory exhaustion in produzione
2. **XotBaseResource**: Inconsistenze si propagano su tutte le Filament resources
3. **SendMailByRecordAction**: Mancanza rate limiting può causare spam/blocchi email
4. **XotBaseState**: Type safety issues possono causare runtime errors

### Raccomandazioni Immediate:
1. **Priorità assoluta** alle correzioni del core module
2. **Testing comprehensivo** prima del deploy (impatta tutto)  
3. **Monitoring specifico** per performance core actions
4. **Backward compatibility** assicurata per non rompere moduli esistenti

**ATTENZIONE**: Ogni modifica al modulo Xot deve essere testata con tutti gli altri moduli per evitare regressioni sistemiche.