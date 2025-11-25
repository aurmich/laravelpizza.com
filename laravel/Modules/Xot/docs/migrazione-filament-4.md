# Xot Module - Migrazione a Filament 4 (CORE MODULE)

## Panoramica Xot Core Module
Il modulo Xot è il **CORE MODULE** dell'intera architettura, fornendo base classes, actions, e services condivisi. La migrazione a Filament 4 è **CRITICA** perché impatta tutti gli altri moduli.

## 🔄 Modifiche Richieste per la Migrazione

### 1. XotBaseResource - Schema Unificato Foundation
**Criticità**: Tutti i resource erediano da XotBaseResource

**Filament 4 - Enhanced XotBaseResource:**

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
use Filament\Tables\Actions\BulkAction;

abstract class XotBaseResource extends Resource
{
    protected static ?string $recordTitleAttribute = 'name';
    protected static int $globalSearchResultsLimit = 20;
    protected static bool $shouldRegisterNavigation = true;

    /**
     * Abstract methods - ogni child resource deve implementare
     */
    abstract public static function getMainSchema(): array;
    abstract public static function getTableColumns(): array;

    /**
     * Unified Schema pattern per Filament 4
     */
    public static function schema(): Schema
    {
        return Schema::make([
            // Main content section
            Section::make('Information')
                ->schema(static::getMainSchema())
                ->columns(2),
                
            // Common audit fields section
            static::getAuditSection(),
        ]);
    }

    /**
     * Common audit fields for all resources
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
            ->poll('30s') // Real-time updates
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
    }

    /**
     * Common columns for all resources
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
     * Enhanced filters with common patterns
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
                
            DateFilter::make('created_at')
                ->label('Created Date'),
                
            Filter::make('recent')
                ->query(fn($query) => $query->where('created_at', '>', now()->subWeek()))
                ->label('Recent (7 days)'),
        ];
    }

    /**
     * Enhanced actions with audit logging
     */
    public static function getTableActions(): array
    {
        return [
            Action::make('toggle_status')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->action(function($record) {
                    $record->update(['is_active' => !$record->is_active]);
                    
                    activity()
                        ->performedOn($record)
                        ->causedBy(auth()->user())
                        ->log($record->is_active ? 'activated' : 'deactivated');
                })
                ->requiresConfirmation(),
                
            Action::make('audit_log')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->url(fn($record) => route('admin.audit-log', [
                    'subject_type' => $record->getMorphClass(),
                    'subject_id' => $record->getKey(),
                ]))
                ->openUrlInNewTab(),
        ];
    }

    /**
     * Enhanced bulk actions
     */
    public static function getBulkActions(): array
    {
        return [
            BulkAction::make('bulk_activate')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function($records) {
                    $records->each->update(['is_active' => true]);
                    
                    Notification::make()
                        ->title('Records activated successfully')
                        ->success()
                        ->send();
                }),
                
            BulkAction::make('bulk_deactivate')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function($records) {
                    $records->each->update(['is_active' => false]);
                }),
                
            BulkAction::make('export_selected')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function($records) {
                    return static::exportRecords($records);
                }),
        ];
    }

    /**
     * Enhanced query with performance optimizations
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(static::getDefaultEagerLoads())
            ->withoutGlobalScopes(static::getExcludedGlobalScopes())
            ->when(
                static::shouldApplyTenantScope(),
                fn($query) => $query->whereBelongsTo(Filament::getTenant())
            );
    }

    /**
     * Template methods for customization
     */
    protected static function getDefaultEagerLoads(): array
    {
        return ['creator', 'updater']; // Common relationships
    }

    protected static function getExcludedGlobalScopes(): array
    {
        return [];
    }

    protected static function shouldApplyTenantScope(): bool
    {
        return method_exists(static::getModel(), 'tenant');
    }

    /**
     * Export functionality
     */
    protected static function exportRecords(Collection $records): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . Str::slug(static::getModelLabel()) . '-export.csv"',
        ];

        return response()->stream(function() use ($records) {
            $handle = fopen('php://output', 'w');
            
            // Headers
            if ($records->isNotEmpty()) {
                fputcsv($handle, array_keys($records->first()->toArray()));
            }
            
            // Data
            $records->each(function($record) use ($handle) {
                fputcsv($handle, $record->toArray());
            });
            
            fclose($handle);
        }, 200, $headers);
    }
}
```

### 2. Core Actions Enhancement

#### Enhanced SendMailByRecordAction
```php
<?php

namespace Modules\Xot\Actions\Mail;

use Filament\Notifications\Notification;

class SendMailByRecordAction
{
    public function __construct(
        private MailManager $mail,
        private RateLimiter $rateLimiter,
        private ActivityLogger $logger
    ) {}

    public function execute(
        Model $record,
        string $template,
        ?User $recipient = null,
        array $data = []
    ): MailResult {
        // Rate limiting per record type
        $rateLimitKey = $this->buildRateLimitKey($record);
        
        if (!$this->checkRateLimit($rateLimitKey)) {
            throw new TooManyMailsException(
                'Rate limit exceeded for ' . class_basename($record)
            );
        }

        DB::beginTransaction();
        
        try {
            // Validate record supports mailing
            $this->validateMailableRecord($record);
            
            // Prepare mail data
            $mailData = $this->prepareMailData($record, $data);
            
            // Send email
            $result = $this->sendMail($template, $recipient, $mailData);
            
            // Log successful send
            $this->logger->logMailSent($record, $template, $recipient, $result);
            
            // Show success notification in admin
            $this->showSuccessNotification($record, $template);
            
            DB::commit();
            
            return new MailResult(true, $result);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log failure
            $this->logger->logMailFailed($record, $template, $recipient, $e);
            
            // Show error notification
            $this->showErrorNotification($record, $e);
            
            throw $e;
        }
    }

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
        // Allow 10 emails per hour per record per user
        return !$this->rateLimiter->tooManyAttempts($key, 10, 60);
    }

    private function showSuccessNotification(Model $record, string $template): void
    {
        Notification::make()
            ->title('Email sent successfully')
            ->body("Template '{$template}' sent for " . class_basename($record))
            ->success()
            ->send();
    }

    private function showErrorNotification(Model $record, \Exception $e): void
    {
        Notification::make()
            ->title('Email sending failed')
            ->body($e->getMessage())
            ->danger()
            ->persistent()
            ->send();
    }
}
```

### 3. Enhanced Model Discovery Action
```php
<?php

namespace Modules\Xot\Actions\Model;

class GetAllModelsAction
{
    public function __construct(
        private Cache $cache,
        private ModuleRegistry $modules
    ) {}

    public function execute(bool $forceRefresh = false): Collection
    {
        if ($forceRefresh) {
            $this->cache->forget('xot:all_models');
        }

        return $this->cache->remember(
            'xot:all_models',
            3600, // 1 hour
            fn() => $this->discoverAllModels()
        );
    }

    private function discoverAllModels(): Collection
    {
        $models = collect();
        
        // Get enabled modules
        $enabledModules = $this->modules->getEnabled();
        
        foreach ($enabledModules as $module) {
            $moduleModels = $this->discoverModuleModels($module);
            $models = $models->merge($moduleModels);
        }
        
        return $models->sortBy('class');
    }

    private function discoverModuleModels(Module $module): Collection
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
                Log::warning('Failed to analyze model file', [
                    'file' => $file->getPathname(),
                    'module' => $module->getName(),
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        return $models;
    }

    private function analyzeModelFile(SplFileInfo $file, Module $module): ?array
    {
        $className = $this->getClassNameFromFile($file, $module);
        
        if (!$this->isValidModelClass($className)) {
            return null;
        }

        $reflection = new ReflectionClass($className);
        $instance = app($className);

        return [
            'class' => $className,
            'module' => $module->getName(),
            'table' => $instance->getTable(),
            'fillable_count' => count($instance->getFillable()),
            'relationships' => $this->extractRelationships($reflection),
            'has_soft_deletes' => in_array(SoftDeletes::class, class_uses_recursive($className)),
            'is_pivot' => $instance instanceof Pivot,
            'file_path' => $file->getPathname(),
        ];
    }
}
```

### 4. Static Dashboard Data per Core Metrics
```php
class XotSystemDashboard extends Widget
{
    public function table(Table $table): Table
    {
        return $table
            ->records($this->getCoreMetrics())
            ->columns([
                TextColumn::make('metric')
                    ->weight('semibold'),
                    
                TextColumn::make('value')
                    ->numeric()
                    ->color(fn($record) => match($record['status']) {
                        'critical' => 'danger',
                        'warning' => 'warning',
                        'healthy' => 'success',
                        default => 'info',
                    }),
                    
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'critical',
                        'warning' => 'warning',
                        'success' => 'healthy',
                    ]),
                    
                TextColumn::make('impact')
                    ->badge()
                    ->colors([
                        'danger' => 'high',
                        'warning' => 'medium',
                        'success' => 'low',
                    ]),
                    
                TextColumn::make('last_check')
                    ->since(),
            ])
            ->actions([
                Action::make('investigate')
                    ->icon('heroicon-o-magnifying-glass')
                    ->visible(fn($record) => $record['status'] !== 'healthy')
                    ->action(function($record) {
                        return $this->handleInvestigation($record);
                    }),
                    
                Action::make('optimize')
                    ->icon('heroicon-o-rocket-launch')
                    ->color('success')
                    ->action(function($record) {
                        return $this->handleOptimization($record);
                    }),
            ])
            ->poll('60s');
    }

    private function getCoreMetrics(): array
    {
        return [
            [
                'metric' => 'Active Modules',
                'value' => app('modules')->getByStatus(1)->count(),
                'status' => 'healthy',
                'impact' => 'low',
                'last_check' => now(),
            ],
            [
                'metric' => 'Registered Models',
                'value' => app(GetAllModelsAction::class)->execute()->count(),
                'status' => $this->getModelsStatus(),
                'impact' => 'medium',
                'last_check' => now(),
            ],
            [
                'metric' => 'Cache Hit Rate',
                'value' => $this->getCacheHitRate(),
                'status' => $this->getCacheStatus(),
                'impact' => 'high',
                'last_check' => now(),
            ],
            [
                'metric' => 'Queue Jobs Pending',
                'value' => Queue::size(),
                'status' => $this->getQueueStatus(),
                'impact' => 'medium',
                'last_check' => now(),
            ],
            [
                'metric' => 'Failed Jobs (24h)',
                'value' => FailedJob::where('failed_at', '>', now()->subDay())->count(),
                'status' => $this->getFailedJobsStatus(),
                'impact' => 'high',
                'last_check' => now(),
            ],
        ];
    }
}
```

## 🚀 Vantaggi della Migrazione Xot Core Module

### 1. Foundation Modernization
- **Unified Schema system** per tutti i child resources
- **Enhanced performance** con caching optimizations
- **Real-time updates** per dashboard monitoring
- **Consistent UX patterns** across all modules

### 2. Advanced Core Features
```php
// Enhanced base model con audit trail
abstract class XotBaseModel extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    
    protected $guarded = ['id'];
    
    protected static function boot(): void
    {
        parent::boot();
        
        static::creating(function($model) {
            $model->created_by = auth()->id();
        });
        
        static::updating(function($model) {
            $model->updated_by = auth()->id();
        });
    }
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
```

### 3. Performance Monitoring Integration
- **Real-time system metrics**
- **Automated performance alerts**
- **Resource usage tracking**
- **Bottleneck identification**

### 4. Advanced Error Handling
```php
// Global exception handling per core module
class XotExceptionHandler
{
    public function handle(\Exception $e): void
    {
        // Log to appropriate channel based on severity
        $channel = match(true) {
            $e instanceof CriticalSystemException => 'critical',
            $e instanceof PerformanceException => 'performance',
            $e instanceof SecurityException => 'security',
            default => 'general',
        };
        
        Log::channel($channel)->error($e->getMessage(), [
            'exception' => $e,
            'context' => $this->gatherContext(),
        ]);
        
        // Send notifications for critical issues
        if ($e instanceof CriticalSystemException) {
            $this->notifyAdmins($e);
        }
    }
}
```

## ⚠️ Svantaggi e Rischi CRITICI

### 1. System-Wide Impact Risk
```bash
# RISCHIO MASSIMO: Breaking change impacts ALL modules
⚠️  XotBaseResource changes affect every resource
⚠️  Core actions modifications break dependent modules
⚠️  State management changes cascade everywhere
⚠️  Performance regressions multiply across system
```

### 2. Migration Complexity
```php
// Complex dependencies to manage:
⚠️  All modules depend on Xot core classes
⚠️  Backward compatibility critical
⚠️  Testing requires full system validation
⚠️  Rollback affects entire application
```

### 3. Performance Monitoring Overhead
```php
// Additional monitoring costs:
⚠️  Real-time polling increases server load
⚠️  Extensive logging impacts performance
⚠️  Cache invalidation strategies complex
⚠️  Memory usage for system metrics
```

### 4. Testing Infrastructure Requirements
```php
// Comprehensive testing needed:
⚠️  All modules must be tested together
⚠️  Integration testing critical
⚠️  Performance testing under full load
⚠️  Rollback scenarios validation
```

## 🎯 Piano di Migrazione Xot Core Module (HIGHEST PRIORITY)

### Fase 0: Critical Preparation (5-7 giorni)
1. 🆘 **CRITICAL**: Full system backup + rollback testing
2. 🆘 **CRITICAL**: Comprehensive dependency mapping
3. 🆘 **CRITICAL**: Performance baseline establishment  
4. 🆘 **CRITICAL**: Emergency procedures documentation
5. 🆘 **CRITICAL**: Stakeholder communication plan

### Fase 1: Core Foundation Migration (7-10 giorni)
1. 🔧 Migrate XotBaseResource to unified Schema
2. 🔧 Enhanced core actions (SendMail, GetAllModels)
3. 🔧 Implement performance monitoring
4. 🔧 Setup real-time system metrics

### Fase 2: Advanced Core Features (5-7 giorni)
1. 🔄 Enhanced error handling system
2. 🔄 Advanced caching strategies
3. 🔄 Security enhancements integration
4. 🔄 Performance optimization tools

### Fase 3: System Integration Testing (7-10 giorni)
1. ✅ All modules functionality testing
2. ✅ Performance testing under load
3. ✅ Integration scenarios validation
4. ✅ Rollback procedures verification

### Fase 4: Monitoring & Optimization (3-5 giorni)
1. 📊 System metrics validation
2. 📊 Performance bottleneck identification
3. 📊 Security audit completion
4. 📊 Documentation finalization

## 💡 Raccomandazioni per Xot Core Module

### 🚨 EXTREME CAUTION - CORE MODULE

**Motivi per maximum caution:**
1. **System-wide impact** - ogni change impatta tutto
2. **Dependency complexity** - tutti i moduli dipendono da Xot
3. **Performance critical** - core optimizations affect everything
4. **Rollback complexity** - difficult to undo changes

### ✅ Procedere SOLO CON:

1. **Dedicated team** con expertise completa sul sistema
2. **Extended maintenance window** di almeno 48-72h  
3. **Full system testing environment** identico a produzione
4. **Comprehensive rollback plan** testato multiple volte
5. **Real-time monitoring** durante tutta la migrazione
6. **All stakeholders** informati e allineati

### 🔄 Strategic Approach:

**PRIMO MODULO DA MIGRARE:**
1. Xot core deve essere migrato **PRIMA** di tutti gli altri
2. Tutti gli altri moduli dipendono da Xot foundation
3. Success del core module determina success dell'intero progetto
4. **Foundation stability** is prerequisite for everything else

## 🕐 Timeline Stimato Xot Core Module

**EXTENDED TIMELINE per criticità:**
- **Preparation & planning**: 6-8 giorni
- **Core migration execution**: 8-12 giorni
- **System integration testing**: 8-10 giorni
- **Performance validation**: 4-6 giorni
- **Monitoring & adjustment**: 3-5 giorni

**TOTALE: 29-41 giorni lavorativi**

## 🔮 Conclusioni Xot Core Module

**🎯 MIGRATION PRIORITY #1 - FOUNDATION MODULE**

**Raccomandazione CRITICA**: Xot deve essere migrato **PER PRIMO** perché:

✅ **Foundation requirement** - tutti gli altri moduli ereditano da Xot  
✅ **Architectural dependency** - XotBaseResource è parent class universale  
✅ **Performance impact** - core optimizations benefit entire system  
✅ **Risk management** - better to fail early on foundation than late on dependencies  
✅ **Strategic approach** - establishes patterns per tutti gli altri moduli

**Migration order strategy**:
1. **Xot Core** (foundation) ← **START HERE**
2. Simple modules (Badge, Lang) ← test patterns
3. Complex modules (User, GDPR) ← apply learned patterns  
4. Integration modules (Notify, Media) ← final implementation

**Success criteria**: 
- All child resources inherit enhanced Schema patterns
- Performance improvements measurable across system
- Real-time monitoring operational  
- Zero regression in existing functionality

**CRITICAL**: **Foundation first, everything else follows**