# Xot Module - Ottimizzazioni e Correzioni

## 🎯 Overview
Documentazione delle ottimizzazioni, correzioni e miglioramenti per il modulo Xot - foundation module che fornisce classi base, traits e funzionalità core per tutti gli altri moduli.

## 📋 Stato Attuale

### ✅ Punti di Forza
- XotBaseModel con traits avanzati
- XotBaseResource per Filament
- BaseController per pattern comuni
- Helper classes e utilities
- Architettura modulare solida
- Sistema di configurazione centralizzato

### ⚠️ Aree da Migliorare
- Documentazione foundation pattern limitata
- Mancanza di guide per estensioni custom
- Performance patterns non documentati
- Best practices per traits non formalizzate
- Testing guidelines per classi base

## 🚀 Ottimizzazioni Architetturali

### 1. XotBaseModel Enhancements

#### Performance Optimizations
```php
// ✅ XotBaseModel ottimizzato con caching
abstract class XotBaseModel extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    use CacheableModel, OptimizedQueries, AuditableModel;
    
    protected $cacheTime = 3600; // 1 ora default
    
    /**
     * Cache key generator ottimizzato
     */
    public function getCacheKey(string $suffix = ''): string
    {
        $class = str_replace('\\', '.', static::class);
        return "model.{$class}.{$this->getKey()}.{$suffix}";
    }
    
    /**
     * Eager loading intelligente basato su context
     */
    public function scopeWithOptimalRelations(Builder $query): Builder
    {
        $relations = $this->getOptimalRelations();
        return $relations ? $query->with($relations) : $query;
    }
    
    /**
     * Determine optimal relations based on usage patterns
     */
    protected function getOptimalRelations(): array
    {
        return Cache::remember(
            "optimal_relations." . static::class,
            86400, // 24 ore
            fn() => $this->analyzeRelationUsage()
        );
    }
}
```

#### Advanced Traits Integration
```php
// ✅ Trait per performance monitoring
trait PerformanceTrackable
{
    protected static function bootPerformanceTrackable(): void
    {
        static::retrieved(function ($model) {
            $model->trackQueryTime();
        });
        
        static::created(function ($model) {
            $model->clearRelatedCaches();
        });
    }
    
    public function trackQueryTime(): void
    {
        if (app()->environment('local', 'testing')) {
            $time = request()->get('_query_time', 0);
            if ($time > 100) { // > 100ms
                Log::debug("Slow model query", [
                    'model' => static::class,
                    'time' => $time,
                    'key' => $this->getKey()
                ]);
            }
        }
    }
}
```

#### Memory Optimization
```php
// ✅ Memory-efficient model loading
trait MemoryOptimized
{
    /**
     * Large collection processing con chunking
     */
    public static function processLargeDataset(
        callable $callback,
        int $chunkSize = 1000
    ): void {
        static::lazy($chunkSize)->each($callback);
    }
    
    /**
     * Selective attribute loading
     */
    public function scopeSelectOptimal(Builder $query, array $context = []): Builder
    {
        $fields = $this->getRequiredFields($context);
        return $query->select($fields);
    }
    
    protected function getRequiredFields(array $context): array
    {
        // Base fields sempre necessari
        $fields = [$this->getTable() . '.id', 'created_at', 'updated_at'];
        
        // Context-specific fields
        switch ($context['type'] ?? null) {
            case 'list':
                return array_merge($fields, $this->getListFields());
            case 'detail':
                return array_merge($fields, $this->getDetailFields());
            default:
                return ['*'];
        }
    }
}
```

### 2. XotBaseResource Optimizations

#### Performance-Aware Resource
```php
// ✅ Filament Resource ottimizzata
abstract class XotBaseResource extends Resource
{
    use CacheableResource, OptimizedTableQueries;
    
    protected static int $defaultPerPage = 25;
    protected static bool $enableBulkActions = true;
    protected static array $searchableFields = [];
    
    /**
     * Query optimization per table
     */
    protected static function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->with(static::getTableEagerLoads())
            ->when(
                static::shouldEnableAdvancedFilters(),
                fn($query) => $query->withoutGlobalScopes()
            );
    }
    
    /**
     * Intelligent eager loading based on columns
     */
    protected static function getTableEagerLoads(): array
    {
        $columns = static::table(Table::make())->getColumns();
        $relations = [];
        
        foreach ($columns as $column) {
            if ($relation = static::extractRelationFromColumn($column)) {
                $relations[] = $relation;
            }
        }
        
        return array_unique($relations);
    }
    
    /**
     * Cache form schema per performance
     */
    public static function form(Form $form): Form
    {
        return Cache::remember(
            'form_schema.' . static::class,
            3600,
            fn() => static::buildFormSchema($form)
        );
    }
}
```

#### Advanced Table Optimizations
```php
// ✅ Table performance enhancements
trait OptimizedTableQueries
{
    /**
     * Pagination ottimizzata per grandi dataset
     */
    protected static function getTablePaginationPageOptions(): array
    {
        $totalRecords = static::getModel()::count();
        
        if ($totalRecords > 10000) {
            return [10, 25, 50]; // Ridotte per grandi dataset
        }
        
        return [10, 25, 50, 100];
    }
    
    /**
     * Search optimization con full-text quando possibile
     */
    protected static function getTableSearchQuery(Builder $query, string $search): Builder
    {
        if (static::supportsFullTextSearch()) {
            return $query->whereFullText(
                static::getFullTextColumns(),
                $search
            );
        }
        
        return static::getDefaultSearchQuery($query, $search);
    }
}
```

### 3. BaseController Enhancements

#### RESTful Controller Template
```php
// ✅ BaseController con pattern ottimizzati
abstract class XotBaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    use CacheableResponses, ApiResponseHelpers;
    
    protected string $modelClass;
    protected string $resourceClass;
    protected array $defaultIncludes = [];
    
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', $this->modelClass);
        
        $query = $this->modelClass::query()
            ->with($this->getIncludes($request))
            ->when($request->search, fn($q, $search) => 
                $this->applySearch($q, $search)
            )
            ->when($request->filters, fn($q, $filters) => 
                $this->applyFilters($q, $filters)
            );
            
        $items = $request->per_page 
            ? $query->paginate($request->per_page)
            : $query->get();
            
        return $this->successResponse([
            'data' => $this->resourceClass::collection($items),
            'meta' => $this->getPaginationMeta($items)
        ]);
    }
    
    protected function applySearch(Builder $query, string $search): Builder
    {
        $searchableFields = $this->modelClass::getSearchableFields();
        
        return $query->where(function ($q) use ($search, $searchableFields) {
            foreach ($searchableFields as $field) {
                $q->orWhere($field, 'LIKE', "%{$search}%");
            }
        });
    }
    
    protected function applyFilters(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field => $value) {
            if (in_array($field, $this->modelClass::getFilterableFields())) {
                $query->where($field, $value);
            }
        }
        
        return $query;
    }
}
```

#### API Response Standardization
```php
// ✅ Consistent API responses
trait ApiResponseHelpers
{
    protected function successResponse(
        mixed $data = null, 
        string $message = 'Success',
        int $statusCode = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->toISOString(),
            'version' => config('app.api_version', 'v1')
        ], $statusCode);
    }
    
    protected function errorResponse(
        string $message = 'Error',
        mixed $errors = null,
        int $statusCode = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'timestamp' => now()->toISOString(),
            'version' => config('app.api_version', 'v1')
        ], $statusCode);
    }
    
    protected function getPaginationMeta($items): ?array
    {
        if (method_exists($items, 'total')) {
            return [
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
            ];
        }
        
        return null;
    }
}
```

## 🔧 Correzioni Specifiche

### 1. Configuration Management
```php
// ✅ Centralized config management
class XotConfig
{
    private static array $cache = [];
    
    public static function get(string $key, mixed $default = null): mixed
    {
        if (!isset(static::$cache[$key])) {
            static::$cache[$key] = config("xot.{$key}", $default);
        }
        
        return static::$cache[$key];
    }
    
    public static function isEnabled(string $feature): bool
    {
        return (bool) static::get("features.{$feature}", false);
    }
    
    public static function getModuleConfig(string $module, string $key = null): mixed
    {
        $configKey = "modules.{$module}" . ($key ? ".{$key}" : '');
        return static::get($configKey);
    }
}
```

### 2. Exception Handling Standardization
```php
// ✅ Custom exceptions per module system
abstract class XotException extends Exception
{
    protected string $moduleContext = 'unknown';
    protected array $extraData = [];
    
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null,
        array $extraData = []
    ) {
        parent::__construct($message, $code, $previous);
        $this->extraData = $extraData;
    }
    
    public function getModuleContext(): string
    {
        return $this->moduleContext;
    }
    
    public function getExtraData(): array
    {
        return $this->extraData;
    }
    
    public function toArray(): array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'module' => $this->getModuleContext(),
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'extra_data' => $this->getExtraData(),
            'trace_id' => request()->header('X-Trace-Id', uniqid())
        ];
    }
}

class XotModelException extends XotException
{
    protected string $moduleContext = 'model';
}

class XotResourceException extends XotException  
{
    protected string $moduleContext = 'resource';
}
```

### 3. Helper Utilities Enhancement
```php
// ✅ Enhanced helper utilities
class XotHelper
{
    /**
     * Smart class resolution con caching
     */
    public static function resolveClass(string $className, ?string $namespace = null): ?string
    {
        return Cache::remember(
            "class_resolution.{$className}.{$namespace}",
            3600,
            function() use ($className, $namespace) {
                $attempts = [
                    $className,
                    $namespace ? "{$namespace}\\{$className}" : null,
                    "App\\Models\\{$className}",
                    "Modules\\*\\Models\\{$className}"
                ];
                
                foreach (array_filter($attempts) as $attempt) {
                    if (class_exists($attempt)) {
                        return $attempt;
                    }
                }
                
                return null;
            }
        );
    }
    
    /**
     * Module detection e metadata
     */
    public static function getModuleFromPath(string $path): ?string
    {
        if (preg_match('/Modules\/(\w+)\//', $path, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
    
    /**
     * Performance monitoring helpers
     */
    public static function measureTime(callable $callback, string $label = null): mixed
    {
        $start = microtime(true);
        $result = $callback();
        $time = round((microtime(true) - $start) * 1000, 2);
        
        if ($label && $time > 100) { // Log se > 100ms
            Log::debug("Performance measurement: {$label}", [
                'time_ms' => $time,
                'memory_mb' => round(memory_get_usage() / 1024 / 1024, 2)
            ]);
        }
        
        return $result;
    }
}
```

## 📈 Performance Monitoring

### 1. Query Performance Tracking
```php
// ✅ Query performance monitoring
class XotQueryMonitor
{
    public static function startMonitoring(): void
    {
        if (!XotConfig::isEnabled('query_monitoring')) {
            return;
        }
        
        DB::listen(function ($query) {
            static::logSlowQuery($query);
        });
    }
    
    private static function logSlowQuery($query): void
    {
        $threshold = XotConfig::get('query_monitoring.slow_threshold', 1000);
        
        if ($query->time > $threshold) {
            Log::warning('Slow query detected', [
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time,
                'module' => XotHelper::getModuleFromBacktrace()
            ]);
        }
    }
    
    public static function getQueryStats(): array
    {
        return Cache::get('xot.query_stats', [
            'total_queries' => 0,
            'slow_queries' => 0,
            'avg_time' => 0
        ]);
    }
}
```

### 2. Memory Usage Monitoring
```php
// ✅ Memory monitoring per modules
class XotMemoryMonitor
{
    private static array $checkpoints = [];
    
    public static function checkpoint(string $label): void
    {
        static::$checkpoints[$label] = [
            'memory' => memory_get_usage(true),
            'peak' => memory_get_peak_usage(true),
            'time' => microtime(true)
        ];
    }
    
    public static function reportUsage(): array
    {
        $report = [];
        $previous = null;
        
        foreach (static::$checkpoints as $label => $data) {
            $report[$label] = [
                'memory_mb' => round($data['memory'] / 1024 / 1024, 2),
                'peak_mb' => round($data['peak'] / 1024 / 1024, 2),
                'delta_mb' => $previous 
                    ? round(($data['memory'] - $previous['memory']) / 1024 / 1024, 2)
                    : 0
            ];
            $previous = $data;
        }
        
        return $report;
    }
}
```

## 🛠️ Development Tools

### 1. Module Generator Enhanced
```php
// ✅ Advanced module scaffolding
class XotModuleGenerator
{
    public function generateModule(
        string $name,
        array $options = []
    ): void {
        $this->validateModuleName($name);
        
        $structure = $this->getModuleStructure($name, $options);
        
        foreach ($structure as $path => $content) {
            $this->createFile($path, $content);
        }
        
        $this->registerModule($name);
        $this->runPostGenerationTasks($name, $options);
    }
    
    private function getModuleStructure(string $name, array $options): array
    {
        return [
            "Modules/{$name}/composer.json" => $this->generateComposerJson($name),
            "Modules/{$name}/module.json" => $this->generateModuleJson($name),
            "Modules/{$name}/Models/BaseModel.php" => $this->generateBaseModel($name),
            "Modules/{$name}/Resources/BaseResource.php" => $this->generateBaseResource($name),
            "Modules/{$name}/Controllers/BaseController.php" => $this->generateBaseController($name),
            "Modules/{$name}/docs/README.md" => $this->generateReadme($name),
            "Modules/{$name}/docs/optimizations.md" => $this->generateOptimizationsDoc($name),
        ];
    }
}
```

### 2. Testing Utilities
```php
// ✅ Enhanced testing support
abstract class XotTestCase extends TestCase
{
    use RefreshDatabase; // Solo se necessario
    use WithFaker;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->seedRequiredData();
        $this->setupModule();
    }
    
    protected function seedRequiredData(): void
    {
        // Base data required for all tests
    }
    
    protected function setupModule(): void
    {
        // Module-specific setup
    }
    
    /**
     * Helper per test performance
     */
    protected function assertQueryCountLessThan(int $maxQueries, callable $callback): void
    {
        $queryCount = 0;
        
        DB::listen(function() use (&$queryCount) {
            $queryCount++;
        });
        
        $callback();
        
        $this->assertLessThan(
            $maxQueries,
            $queryCount,
            "Expected less than {$maxQueries} queries, but {$queryCount} were executed"
        );
    }
    
    /**
     * Helper per test memory usage
     */
    protected function assertMemoryUsageLessThan(int $maxMB, callable $callback): void
    {
        $startMemory = memory_get_usage(true);
        $callback();
        $endMemory = memory_get_usage(true);
        
        $usedMB = ($endMemory - $startMemory) / 1024 / 1024;
        
        $this->assertLessThan(
            $maxMB,
            $usedMB,
            "Expected less than {$maxMB}MB memory usage, but {$usedMB}MB were used"
        );
    }
}
```

## 📚 Best Practices Documentation

### 1. Coding Standards
```php
// ✅ Code style enforcement
class XotCodingStandards
{
    /**
     * Naming conventions
     */
    public const CONVENTIONS = [
        'models' => 'PascalCase',
        'controllers' => 'PascalCase + Controller suffix',
        'resources' => 'PascalCase + Resource suffix', 
        'variables' => 'camelCase',
        'methods' => 'camelCase',
        'constants' => 'UPPER_SNAKE_CASE',
        'database_tables' => 'snake_case',
        'database_columns' => 'snake_case',
    ];
    
    /**
     * Required docblock templates
     */
    public const DOCBLOCK_TEMPLATES = [
        'class' => [
            '@package',
            '@author', 
            '@since',
            '@version'
        ],
        'method' => [
            '@param',
            '@return',
            '@throws'
        ]
    ];
}
```

## 🎯 Metriche di Successo

### Performance Targets
- **Query Time**: < 100ms per request standard
- **Memory Usage**: < 64MB per request
- **Cache Hit Rate**: > 85%
- **Page Load**: < 200ms per pagina admin

### Code Quality Targets  
- **PHPStan Level**: 9 compliance
- **Test Coverage**: > 80%
- **Cyclomatic Complexity**: < 10 per metodo
- **Documentation Coverage**: > 90%

---

*Documentazione aggiornata: $(date +%Y-%m-%d)*