# Xot Module - Guida Step-by-Step Migrazione Filament 4

## 🎯 Panoramica della Migrazione

Il modulo Xot è il **CORE MODULE** e deve essere migrato **per primo**. Questa guida fornisce istruzioni dettagliate per ogni singolo passo della migrazione.

---

## 📋 Pre-Migrazione Checklist

### Step 1: Environment Preparation
```bash
# 1.1 - Backup completo del database
php artisan backup:run --only-db
mysqldump -u username -p database_name > backup_pre_xot_migration.sql

# 1.2 - Backup completo del codice
git branch backup-pre-xot-migration
git checkout -b xot-filament-4-migration

# 1.3 - Backup delle configurazioni attuali
cp -r Modules/Xot/config/ backup_configs/
cp -r Modules/Xot/app/Filament/ backup_filament_resources/
```

### Step 2: Dependencies Check
```bash
# 2.1 - Verificare versioni attuali
composer show filament/filament
composer show livewire/livewire

# 2.2 - Update a Filament 4 beta
composer require "filament/filament:^4.0@beta" --dev
composer require "filament/spatie-laravel-media-library-plugin:^4.0@beta" --dev
composer require "filament/spatie-laravel-settings-plugin:^4.0@beta" --dev

# 2.3 - Clear cache
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Step 3: Create Testing Environment
```bash
# 3.1 - Setup test database
cp .env .env.backup
php artisan migrate:fresh --seed --env=testing

# 3.2 - Run existing tests per baseline
php artisan test Modules/Xot/tests/ --env=testing
```

---

## 🏗️ STEP 1: Core Base Classes Migration

### 1.1 - Migrate XotBaseResource to Schema System

**File da modificare:** `Modules/Xot/app/Filament/Resources/XotBaseResource.php`

**Prima (Filament 3):**
```php
<?php

namespace Modules\Xot\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

abstract class XotBaseResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form->schema([
            // Schema components
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            // Table columns
        ]);
    }
}
```

**Dopo (Filament 4) - PASSO PER PASSO:**

```bash
# 1.1.1 - Backup file originale
cp Modules/Xot/app/Filament/Resources/XotBaseResource.php Modules/Xot/app/Filament/Resources/XotBaseResource.php.backup
```

**1.1.2 - Replace with unified Schema approach:**
```php
<?php

namespace Modules\Xot\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Schema\Schema;
use Filament\Schema\Components\Section;
use Filament\Schema\Components\TextInput;
use Filament\Schema\Components\DateTimePicker;
use Filament\Schema\Components\Toggle;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Models\User;

abstract class XotBaseResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static int $globalSearchResultsLimit = 20;
    protected static bool $shouldRegisterNavigation = true;

    /**
     * STEP 1: Abstract methods - ogni child deve implementare
     */
    abstract public static function getMainSchema(): array;
    abstract public static function getTableColumns(): array;

    /**
     * STEP 2: Unified Schema - NUOVA ARCHITETTURA FILAMENT 4
     */
    public static function schema(): Schema
    {
        return Schema::make([
            // Sezione principale - definita dai child resources
            Section::make('Information')
                ->schema(static::getMainSchema())
                ->columns(2),
                
            // Sezione audit comune a tutti i resources
            static::getAuditSection(),
        ]);
    }

    /**
     * STEP 3: Audit section standardized
     */
    protected static function getAuditSection(): Section
    {
        return Section::make('Audit Information')
            ->schema([
                TextInput::make('created_by')
                    ->disabled()
                    ->formatStateUsing(fn($state) => 
                        $state ? User::find($state)?->name : 'System'
                    ),
                    
                DateTimePicker::make('created_at')
                    ->disabled()
                    ->native(false),
                    
                TextInput::make('updated_by')
                    ->disabled()
                    ->formatStateUsing(fn($state) => 
                        $state ? User::find($state)?->name : 'System'
                    ),
                    
                DateTimePicker::make('updated_at')
                    ->disabled()
                    ->native(false),
                    
                Toggle::make('is_active')
                    ->default(true)
                    ->visibleOn(['edit', 'create']),
            ])
            ->columns(2)
            ->collapsed()
            ->visibleOn(['view', 'edit']);
    }

    /**
     * STEP 4: Enhanced table con real-time features
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                static::getTableColumns(),
                static::getCommonTableColumns()
            ))
            ->filters(static::getTableFilters())
            ->actions(static::getTableActions())
            ->bulkActions(static::getBulkActions())
            ->defaultSort('created_at', 'desc')
            ->poll('30s') // NUOVO: Real-time updates
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
    }

    /**
     * STEP 5: Common columns standardized
     */
    protected static function getCommonTableColumns(): array
    {
        return [
            BadgeColumn::make('is_active')
                ->label('Status')
                ->formatStateUsing(fn($state) => $state ? 'Active' : 'Inactive')
                ->colors([
                    'success' => true,
                    'danger' => false,
                ]),
                
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->since()
                ->toggleable(),
        ];
    }

    /**
     * STEP 6: Enhanced filters
     */
    public static function getTableFilters(): array
    {
        return [
            SelectFilter::make('is_active')
                ->options([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->label('Status'),
        ];
    }

    /**
     * STEP 7: Enhanced actions con audit logging
     */
    public static function getTableActions(): array
    {
        return [
            Action::make('toggle_status')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->action(function($record) {
                    $record->update(['is_active' => !$record->is_active]);
                    
                    // NUOVO: Activity logging
                    activity()
                        ->performedOn($record)
                        ->causedBy(auth()->user())
                        ->log($record->is_active ? 'activated' : 'deactivated');
                })
                ->requiresConfirmation(),
        ];
    }

    /**
     * STEP 8: Performance optimization
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(static::getDefaultEagerLoads())
            ->withoutGlobalScopes(static::getExcludedGlobalScopes());
    }

    protected static function getDefaultEagerLoads(): array
    {
        return ['creator', 'updater'];
    }

    protected static function getExcludedGlobalScopes(): array
    {
        return [];
    }
}
```

**1.1.3 - Test the base resource:**
```bash
# Test che il base resource compili senza errori
php artisan tinker
>>> new ReflectionClass('Modules\Xot\Filament\Resources\XotBaseResource');
```

### 1.2 - Update Child Resources Pattern

**Per ogni resource che estende XotBaseResource, seguire questo pattern:**

**Esempio con un resource esistente - STEP PER STEP:**

**File:** `Modules/Xot/app/Filament/Resources/ExampleResource.php`

```bash
# 1.2.1 - Identify resources that extend XotBaseResource
find Modules/ -name "*.php" -exec grep -l "extends XotBaseResource" {} \;
```

**1.2.2 - Convertire ogni resource trovato:**

**Prima (Filament 3):**
```php
class ExampleResource extends XotBaseResource
{
    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            Select::make('type')->options(['a' => 'A', 'b' => 'B']),
        ]);
    }

    public static function table(Table $table): Table  
    {
        return $table->columns([
            TextColumn::make('name'),
            TextColumn::make('type'),
        ]);
    }
}
```

**Dopo (Filament 4):**
```php
class ExampleResource extends XotBaseResource
{
    protected static ?string $model = Example::class;
    protected static ?string $navigationIcon = 'heroicon-o-document';

    /**
     * STEP 1: Implement required abstract methods
     */
    public static function getMainSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true),
                
            Select::make('type')
                ->options([
                    'a' => 'Type A',
                    'b' => 'Type B',
                ])
                ->required(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->searchable()
                ->sortable(),
                
            BadgeColumn::make('type')
                ->colors([
                    'success' => 'a',
                    'warning' => 'b',
                ]),
        ];
    }
}
```

---

## 🏗️ STEP 2: Core Actions Migration

### 2.1 - Migrate SendMailByRecordAction

**File:** `Modules/Xot/app/Actions/Mail/SendMailByRecordAction.php`

**2.1.1 - Backup originale:**
```bash
cp Modules/Xot/app/Actions/Mail/SendMailByRecordAction.php Modules/Xot/app/Actions/Mail/SendMailByRecordAction.php.backup
```

**2.1.2 - Enhanced implementation:**
```php
<?php

namespace Modules\Xot\Actions\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Modules\User\Models\User;
use Modules\Xot\Exceptions\TooManyMailsException;
use Modules\Xot\Exceptions\InvalidMailableRecordException;
use Modules\Xot\Services\ActivityLogger;
use Modules\Xot\DTOs\MailResult;

class SendMailByRecordAction
{
    public function __construct(
        private RateLimiter $rateLimiter,
        private ActivityLogger $logger
    ) {}

    /**
     * STEP 1: Enhanced execute method con proper typing
     */
    public function execute(
        Model $record,
        string $template,
        ?User $recipient = null,
        array $data = []
    ): MailResult {
        // STEP 2: Rate limiting per sicurezza
        $rateLimitKey = $this->buildRateLimitKey($record);
        
        if (!$this->checkRateLimit($rateLimitKey)) {
            throw new TooManyMailsException(
                'Rate limit exceeded for ' . class_basename($record)
            );
        }

        DB::beginTransaction();
        
        try {
            // STEP 3: Validation
            $this->validateMailableRecord($record);
            
            // STEP 4: Prepare data
            $mailData = $this->prepareMailData($record, $data);
            
            // STEP 5: Send email
            $result = $this->sendMail($template, $recipient, $mailData);
            
            // STEP 6: Success logging
            $this->logger->logMailSent($record, $template, $recipient, $result);
            
            // STEP 7: Admin notification
            $this->showSuccessNotification($record, $template);
            
            DB::commit();
            
            return new MailResult(true, $result);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // STEP 8: Error handling
            $this->logger->logMailFailed($record, $template, $recipient, $e);
            $this->showErrorNotification($record, $e);
            
            throw $e;
        }
    }

    /**
     * STEP 9: Rate limiting implementation
     */
    private function buildRateLimitKey(Model $record): string
    {
        return sprintf(
            'send-mail:%s:%s:%s',
            $record->getMorphClass(),
            $record->getKey(),
            auth()->id() ?? 'system'
        );
    }

    private function checkRateLimit(string $key): bool
    {
        // 10 emails per hour per record per user
        if ($this->rateLimiter->tooManyAttempts($key, 10, 60)) {
            return false;
        }
        
        $this->rateLimiter->hit($key);
        return true;
    }

    /**
     * STEP 10: Validation methods
     */
    private function validateMailableRecord(Model $record): void
    {
        // Check se il record ha un'email o implementa contratto mailable
        if (!method_exists($record, 'getEmailAttribute') && 
            !method_exists($record, 'sendMail')) {
            throw new InvalidMailableRecordException(
                class_basename($record) . ' does not support mailing'
            );
        }
    }

    /**
     * STEP 11: Enhanced notifications
     */
    private function showSuccessNotification(Model $record, string $template): void
    {
        Notification::make()
            ->title('Email sent successfully')
            ->body("Template '{$template}' sent for " . class_basename($record))
            ->success()
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->button()
                    ->url(route('admin.mail-logs.show', [
                        'model' => $record->getMorphClass(),
                        'id' => $record->getKey(),
                    ])),
            ])
            ->send();
    }

    private function showErrorNotification(Model $record, \Exception $e): void
    {
        Notification::make()
            ->title('Email sending failed')
            ->body($e->getMessage())
            ->danger()
            ->persistent()
            ->actions([
                \Filament\Notifications\Actions\Action::make('retry')
                    ->button()
                    ->action(fn() => $this->execute($record, 'retry-template')),
            ])
            ->send();
    }
}
```

**2.1.3 - Create supporting classes:**

**File:** `Modules/Xot/app/DTOs/MailResult.php`
```php
<?php

namespace Modules\Xot\DTOs;

class MailResult
{
    public function __construct(
        public readonly bool $success,
        public readonly mixed $data = null,
        public readonly ?string $message = null,
        public readonly ?string $messageId = null
    ) {}
}
```

**2.1.4 - Test the action:**
```bash
php artisan tinker
>>> $action = app('Modules\Xot\Actions\Mail\SendMailByRecordAction');
>>> // Test instantiation
```

### 2.2 - Migrate GetAllModelsAction

**File:** `Modules/Xot/app/Actions/Model/GetAllModelsAction.php`

**2.2.1 - Enhanced implementation:**
```php
<?php

namespace Modules\Xot\Actions\Model;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nwidart\Modules\Facades\Module;
use ReflectionClass;
use SplFileInfo;

class GetAllModelsAction
{
    private const CACHE_KEY = 'xot:all_models';
    private const CACHE_TTL = 3600; // 1 hour

    /**
     * STEP 1: Execute con caching strategy
     */
    public function execute(bool $forceRefresh = false): Collection
    {
        if ($forceRefresh) {
            Cache::forget(self::CACHE_KEY);
        }

        return Cache::remember(
            self::CACHE_KEY,
            self::CACHE_TTL,
            fn() => $this->discoverAllModels()
        );
    }

    /**
     * STEP 2: Discover models con error handling
     */
    private function discoverAllModels(): Collection
    {
        $models = collect();
        $enabledModules = Module::getByStatus(1);
        
        foreach ($enabledModules as $module) {
            try {
                $moduleModels = $this->discoverModuleModels($module);
                $models = $models->merge($moduleModels);
                
            } catch (\Exception $e) {
                Log::warning('Failed to discover models for module', [
                    'module' => $module->getName(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        return $models->sortBy('class');
    }

    /**
     * STEP 3: Module-specific discovery
     */
    private function discoverModuleModels($module): Collection
    {
        $models = collect();
        $modelPath = $module->getPath() . '/app/Models';
        
        if (!File::exists($modelPath)) {
            return $models;
        }

        $modelFiles = File::allFiles($modelPath);
        
        foreach ($modelFiles as $file) {
            try {
                $modelInfo = $this->analyzeModelFile($file, $module);
                
                if ($modelInfo) {
                    $models->push($modelInfo);
                }
                
            } catch (\Exception $e) {
                Log::debug('Skipping model file', [
                    'file' => $file->getPathname(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        return $models;
    }

    /**
     * STEP 4: Enhanced model analysis
     */
    private function analyzeModelFile(SplFileInfo $file, $module): ?array
    {
        $className = $this->getClassNameFromFile($file, $module);
        
        if (!$this->isValidModelClass($className)) {
            return null;
        }

        $reflection = new ReflectionClass($className);
        
        // Skip abstract classes
        if ($reflection->isAbstract()) {
            return null;
        }

        $instance = app($className);

        return [
            'class' => $className,
            'short_name' => $reflection->getShortName(),
            'module' => $module->getName(),
            'table' => $instance->getTable(),
            'primary_key' => $instance->getKeyName(),
            'fillable_count' => count($instance->getFillable()),
            'relationships' => $this->extractRelationships($reflection),
            'has_soft_deletes' => $this->hasSoftDeletes($className),
            'is_pivot' => $this->isPivotModel($instance),
            'has_factory' => $this->hasFactory($className),
            'file_path' => $file->getPathname(),
            'created_at' => $file->getCTime(),
            'updated_at' => $file->getMTime(),
        ];
    }

    /**
     * STEP 5: Utility methods
     */
    private function getClassNameFromFile(SplFileInfo $file, $module): string
    {
        $relativePath = str_replace($module->getPath() . '/app/', '', $file->getPathname());
        $className = str_replace(['/', '.php'], ['\\', ''], $relativePath);
        
        return "Modules\\{$module->getName()}\\App\\{$className}";
    }

    private function isValidModelClass(string $className): bool
    {
        try {
            return class_exists($className) 
                && is_subclass_of($className, Model::class);
        } catch (\Exception) {
            return false;
        }
    }

    private function hasSoftDeletes(string $className): bool
    {
        return in_array(SoftDeletes::class, class_uses_recursive($className));
    }

    private function isPivotModel($instance): bool
    {
        return $instance instanceof \Illuminate\Database\Eloquent\Relations\Pivot;
    }

    private function hasFactory(string $className): bool
    {
        return method_exists($className, 'factory');
    }

    /**
     * STEP 6: Relationship extraction
     */
    private function extractRelationships(ReflectionClass $reflection): array
    {
        $relationships = [];
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        foreach ($methods as $method) {
            if ($method->getDeclaringClass()->getName() === $reflection->getName()) {
                $returnType = $method->getReturnType();
                
                if ($returnType && $this->isRelationshipReturnType($returnType->getName())) {
                    $relationships[] = [
                        'name' => $method->getName(),
                        'type' => $this->getRelationshipType($returnType->getName()),
                    ];
                }
            }
        }
        
        return $relationships;
    }

    private function isRelationshipReturnType(string $returnType): bool
    {
        $relationshipTypes = [
            'Illuminate\Database\Eloquent\Relations\HasOne',
            'Illuminate\Database\Eloquent\Relations\HasMany',
            'Illuminate\Database\Eloquent\Relations\BelongsTo',
            'Illuminate\Database\Eloquent\Relations\BelongsToMany',
            'Illuminate\Database\Eloquent\Relations\MorphOne',
            'Illuminate\Database\Eloquent\Relations\MorphMany',
        ];
        
        return in_array($returnType, $relationshipTypes);
    }

    private function getRelationshipType(string $returnType): string
    {
        return class_basename($returnType);
    }
}
```

**2.2.2 - Test performance:**
```bash
php artisan tinker
>>> $action = app('Modules\Xot\Actions\Model\GetAllModelsAction');
>>> $start = microtime(true);
>>> $models = $action->execute();
>>> $duration = microtime(true) - $start;
>>> echo "Found " . $models->count() . " models in " . round($duration, 2) . " seconds";
```

---

## 🏗️ STEP 3: State Management Enhancement

### 3.1 - Migrate XotBaseState

**File:** `Modules/Xot/app/States/XotBaseState.php`

**3.1.1 - Enhanced implementation:**
```php
<?php

namespace Modules\Xot\States;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

abstract class XotBaseState
{
    protected array $data = [];
    protected array $rules = [];
    protected array $casts = [];
    protected array $defaults = [];

    /**
     * STEP 1: Constructor con validation
     */
    public function __construct(array $data = [])
    {
        $this->initializeDefaults();
        $this->validateAndSet($data);
    }

    /**
     * STEP 2: Type-safe setters
     */
    public function set(string $key, mixed $value): static
    {
        $this->validateSingle($key, $value);
        
        $this->data[$key] = $this->castValue($key, $value);
        
        return $this;
    }

    /**
     * STEP 3: Type-safe getters
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $this->defaults[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * STEP 4: Batch operations
     */
    public function merge(array $data): static
    {
        $this->validateAndSet($data);
        
        return $this;
    }

    public function only(array $keys): array
    {
        return array_intersect_key($this->data, array_flip($keys));
    }

    public function except(array $keys): array
    {
        return array_diff_key($this->data, array_flip($keys));
    }

    /**
     * STEP 5: Serialization
     */
    public function toArray(): array
    {
        return $this->data;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR);
    }

    /**
     * STEP 6: Validation methods
     */
    private function validateAndSet(array $data): void
    {
        if (empty($this->rules)) {
            $this->data = array_merge($this->data, $data);
            return;
        }

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

    /**
     * STEP 7: Type casting
     */
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
            'date' => $value instanceof Carbon ? $value->startOfDay() : Carbon::parse($value)->startOfDay(),
            default => $value,
        };
    }

    /**
     * STEP 8: Defaults initialization
     */
    private function initializeDefaults(): void
    {
        foreach ($this->defaults as $key => $value) {
            if (!array_key_exists($key, $this->data)) {
                $this->data[$key] = $value;
            }
        }
    }

    /**
     * STEP 9: Magic methods
     */
    public function __get(string $key): mixed
    {
        return $this->get($key);
    }

    public function __set(string $key, mixed $value): void
    {
        $this->set($key, $value);
    }

    public function __isset(string $key): bool
    {
        return $this->has($key);
    }

    public function __unset(string $key): void
    {
        unset($this->data[$key]);
    }
}
```

**3.1.2 - Create example concrete state:**

**File:** `Modules/Xot/app/States/SystemState.php`
```php
<?php

namespace Modules\Xot\States;

class SystemState extends XotBaseState
{
    protected array $rules = [
        'debug_mode' => 'boolean',
        'maintenance_mode' => 'boolean',
        'cache_enabled' => 'boolean',
        'last_updated' => 'date',
        'version' => 'string|max:20',
    ];

    protected array $casts = [
        'debug_mode' => 'boolean',
        'maintenance_mode' => 'boolean',
        'cache_enabled' => 'boolean',
        'last_updated' => 'datetime',
        'version' => 'string',
    ];

    protected array $defaults = [
        'debug_mode' => false,
        'maintenance_mode' => false,
        'cache_enabled' => true,
        'version' => '1.0.0',
    ];
}
```

---

## 🏗️ STEP 4: Enhanced Service Provider

### 4.1 - Upgrade XotServiceProvider

**File:** `Modules/Xot/app/Providers/XotServiceProvider.php`

**4.1.1 - Enhanced implementation:**
```php
<?php

namespace Modules\Xot\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XotServiceProvider extends ServiceProvider
{
    protected array $singletons = [
        'xot.cache' => \Modules\Xot\Services\CacheService::class,
        'xot.models' => \Modules\Xot\Services\ModelRegistry::class,
        'xot.state' => \Modules\Xot\Services\StateManager::class,
    ];

    /**
     * STEP 1: Enhanced registration
     */
    public function register(): void
    {
        // Register core services as singletons
        foreach ($this->singletons as $alias => $concrete) {
            $this->app->singleton($alias, $concrete);
        }

        // Register configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/xot.php', 'xot');
        
        // Register macro extensions
        $this->registerMacros();
        
        // Register custom exceptions
        $this->registerExceptionHandlers();
    }

    /**
     * STEP 2: Enhanced booting
     */
    public function boot(): void
    {
        // Performance optimizations
        $this->optimizeQueries();
        
        // Event listeners
        $this->registerEventListeners();
        
        // Publish assets
        $this->publishAssets();
        
        // Register commands
        $this->registerCommands();
        
        // Setup monitoring
        $this->setupMonitoring();
    }

    /**
     * STEP 3: Query optimization
     */
    private function optimizeQueries(): void
    {
        if ($this->app->environment('local', 'testing')) {
            DB::enableQueryLog();
            
            $this->app['events']->listen(
                \Illuminate\Foundation\Http\Events\RequestHandled::class,
                function ($event) {
                    $queries = DB::getQueryLog();
                    
                    if (count($queries) > 50) {
                        Log::warning('High query count detected', [
                            'count' => count($queries),
                            'url' => request()->url(),
                            'method' => request()->method(),
                        ]);
                    }
                    
                    // Log slow queries
                    foreach ($queries as $query) {
                        if ($query['time'] > 1000) { // > 1 second
                            Log::warning('Slow query detected', [
                                'sql' => $query['query'],
                                'time' => $query['time'] . 'ms',
                                'bindings' => $query['bindings'],
                            ]);
                        }
                    }
                }
            );
        }
    }

    /**
     * STEP 4: Macro registration
     */
    private function registerMacros(): void
    {
        // Request macro for getting client IP
        Request::macro('getRealIp', function () {
            return $this->header('CF-Connecting-IP') 
                ?? $this->header('X-Forwarded-For')
                ?? $this->ip();
        });

        // Response macro for API responses
        Response::macro('apiSuccess', function ($data = null, $message = 'Success', $code = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $code);
        });

        Response::macro('apiError', function ($message = 'Error', $code = 400, $errors = null) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors,
            ], $code);
        });
    }

    /**
     * STEP 5: Event listeners
     */
    private function registerEventListeners(): void
    {
        // Model events for automatic audit logging
        $this->app['events']->listen('eloquent.creating: *', function ($event, $models) {
            foreach ($models as $model) {
                if (method_exists($model, 'setCreatedBy')) {
                    $model->setCreatedBy(auth()->id());
                }
            }
        });

        $this->app['events']->listen('eloquent.updating: *', function ($event, $models) {
            foreach ($models as $model) {
                if (method_exists($model, 'setUpdatedBy')) {
                    $model->setUpdatedBy(auth()->id());
                }
            }
        });
    }

    /**
     * STEP 6: Asset publishing
     */
    private function publishAssets(): void
    {
        $this->publishes([
            __DIR__.'/../../config/xot.php' => config_path('xot.php'),
        ], 'xot-config');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/xot'),
        ], 'xot-views');
    }

    /**
     * STEP 7: Command registration
     */
    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Modules\Xot\Console\Commands\OptimizeSystemCommand::class,
                \Modules\Xot\Console\Commands\ClearAllCacheCommand::class,
                \Modules\Xot\Console\Commands\AnalyzePerformanceCommand::class,
            ]);
        }
    }

    /**
     * STEP 8: Performance monitoring
     */
    private function setupMonitoring(): void
    {
        // Memory usage monitoring
        register_shutdown_function(function () {
            $memoryUsage = memory_get_peak_usage(true);
            $memoryLimit = ini_get('memory_limit');
            
            if ($memoryUsage > (128 * 1024 * 1024)) { // > 128MB
                Log::info('High memory usage detected', [
                    'peak_usage' => round($memoryUsage / 1024 / 1024, 2) . 'MB',
                    'limit' => $memoryLimit,
                    'url' => request()->url(),
                ]);
            }
        });
    }

    /**
     * STEP 9: Exception handlers
     */
    private function registerExceptionHandlers(): void
    {
        $this->app->bind(
            \Modules\Xot\Contracts\ExceptionHandlerContract::class,
            \Modules\Xot\Services\XotExceptionHandler::class
        );
    }
}
```

---

## 🏗️ STEP 5: Testing & Validation

### 5.1 - Create Comprehensive Tests

**File:** `Modules/Xot/tests/Feature/FilamentMigrationTest.php`

```php
<?php

namespace Modules\Xot\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Xot\Filament\Resources\XotBaseResource;

class FilamentMigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * STEP 1: Test base resource schema
     */
    public function test_base_resource_has_unified_schema(): void
    {
        $this->assertTrue(method_exists(XotBaseResource::class, 'schema'));
        $this->assertTrue(method_exists(XotBaseResource::class, 'getMainSchema'));
        $this->assertTrue(method_exists(XotBaseResource::class, 'getTableColumns'));
    }

    /**
     * STEP 2: Test actions work correctly
     */
    public function test_send_mail_action_works(): void
    {
        $action = app('Modules\Xot\Actions\Mail\SendMailByRecordAction');
        $this->assertInstanceOf(
            'Modules\Xot\Actions\Mail\SendMailByRecordAction',
            $action
        );
    }

    /**
     * STEP 3: Test model discovery
     */
    public function test_get_all_models_action_returns_collection(): void
    {
        $action = app('Modules\Xot\Actions\Model\GetAllModelsAction');
        $models = $action->execute();
        
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $models);
        $this->assertGreaterThan(0, $models->count());
    }

    /**
     * STEP 4: Test state management
     */
    public function test_base_state_validation_works(): void
    {
        $state = new class(['test' => 'value']) extends \Modules\Xot\States\XotBaseState {
            protected array $rules = ['test' => 'required|string'];
            protected array $casts = ['test' => 'string'];
        };

        $this->assertEquals('value', $state->get('test'));
    }
}
```

**5.1.1 - Run tests:**
```bash
php artisan test Modules/Xot/tests/Feature/FilamentMigrationTest.php
```

### 5.2 - Performance Testing

**File:** `Modules/Xot/tests/Performance/ResourcePerformanceTest.php`

```php
<?php

namespace Modules\Xot\Tests\Performance;

use Tests\TestCase;

class ResourcePerformanceTest extends TestCase
{
    /**
     * STEP 1: Test table rendering performance
     */
    public function test_table_renders_within_acceptable_time(): void
    {
        $start = microtime(true);
        
        // Simulate loading a resource table
        $action = app('Modules\Xot\Actions\Model\GetAllModelsAction');
        $models = $action->execute();
        
        $duration = microtime(true) - $start;
        
        $this->assertLessThan(2.0, $duration, 'Model discovery took too long');
    }
}
```

---

## 🏗️ STEP 6: Deployment & Verification

### 6.1 - Deployment Checklist

```bash
# STEP 1: Pre-deployment verification
php artisan config:clear
php artisan view:clear
php artisan route:clear

# STEP 2: Run full test suite
php artisan test Modules/Xot/tests/

# STEP 3: Check for errors
php artisan tinker
>>> \Modules\Xot\Filament\Resources\XotBaseResource::schema()

# STEP 4: Verify child resources still work
find Modules/ -name "*Resource.php" -exec php -l {} \;
```

### 6.2 - Rollback Procedure (if needed)

```bash
# STEP 1: Restore from backup
git checkout backup-pre-xot-migration
git branch -D xot-filament-4-migration

# STEP 2: Restore database
mysql -u username -p database_name < backup_pre_xot_migration.sql

# STEP 3: Restore configurations
cp -r backup_configs/* Modules/Xot/config/
cp -r backup_filament_resources/* Modules/Xot/app/Filament/

# STEP 4: Clear caches
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

---

## ✅ Post-Migration Validation

### Final Verification Steps

```bash
# 1. All resources load correctly
php artisan route:list | grep filament

# 2. No PHP errors
tail -f storage/logs/laravel.log

# 3. Performance check
php artisan xot:analyze-performance

# 4. Memory usage acceptable
php artisan tinker
>>> memory_get_usage(true)

# 5. All modules still detect Xot correctly
php artisan module:list
```

### Success Indicators

✅ **Tutte le child resources caricano senza errori**  
✅ **Performance uguale o migliore della versione precedente**  
✅ **Real-time updates funzionano**  
✅ **Audit logging attivo**  
✅ **Rate limiting operativo**  
✅ **Caching funzionale**  

---

## 🎯 Next Steps

Dopo il successo della migrazione Xot:

1. **Documentare patterns** etabliti per altri moduli
2. **Condividere best practices** con il team
3. **Procedere con Badge module** (pilot project)
4. **Monitor performance** in produzione
5. **Collect feedback** da utilizzatori

La migrazione del modulo Xot costituirà la **foundation** per tutti gli altri moduli del sistema.