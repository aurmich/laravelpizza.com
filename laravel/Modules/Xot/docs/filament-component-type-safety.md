# Filament Component Type Safety Guidelines

## Overview
This document establishes type safety standards for Filament components in the Xot module to ensure robust, maintainable code and pass PHPStan analysis.

## Core Principles

### 1. Explicit Type Declarations
Always declare parameter and return types explicitly:

```php
// ✅ Good
public function action(?string $state, Set $set, ?Model $record): void
{
    // Implementation
}

// ❌ Bad
public function action($state, $set, $record)
{
    // Implementation
}
```

### 2. Null Safety First
Handle nullable values before using them:

```php
// ✅ Good
$name = $this->getName();
if ($name === null) {
    throw new InvalidArgumentException('Action name is required');
}

// ❌ Bad
$name = $this->getName();
$method = 'get' . Str::studly($name); // Potential null error
```

### 3. Type Guards and Assertions
Use type guards to ensure proper types:

```php
// ✅ Good - Type guard
public function handleRecord($record): void
{
    if (!$record instanceof Module) {
        throw new InvalidArgumentException('Expected Module instance');
    }

    $this->processModule($record);
}

// ✅ Good - Assertion for known contexts
protected function afterSave(): void
{
    assert($this->record instanceof Module);
    $module = $this->record;
    // $module is now properly typed
}
```

## Component-Specific Guidelines

### Form Actions

#### FieldRefreshAction Pattern
```php
class FieldRefreshAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel();
        $this->icon('heroicon-o-arrow-path')
            ->tooltip('Ricalcola valore')
            ->action($this->getRefreshAction());
    }

    private function getRefreshAction(): \Closure
    {
        return function (?string $state, Set $set, ?Model $record): void {
            $name = $this->getName();
            if ($name === null) {
                throw new \RuntimeException('Action name is required for field refresh');
            }

            if ($record === null) {
                throw new \RuntimeException('Record is required for field refresh');
            }

            $methodName = 'get' . Str::studly($name);

            if (!method_exists($record, $methodName)) {
                throw new \RuntimeException("Method {$methodName} does not exist on record");
            }

            $value = $record->{$methodName}();
            $set($name, $value);

            Notification::make()
                ->title("Ricalcolato {$name}")
                ->body("Vecchio valore: {$state}, nuovo valore: {$value}")
                ->success()
                ->send();
        };
    }
}
```

### Resource Pages

#### EditRecord Pattern
```php
/**
 * @property Module $record
 */
class EditModule extends XotBaseEditRecord
{
    protected static string $resource = ModuleResource::class;

    protected function afterSave(): void
    {
        $module = $this->getTypedRecord();
        $configPath = $this->buildConfigPath($module);
        $this->updateModuleConfig($module, $configPath);
    }

    private function getTypedRecord(): Module
    {
        if (!$this->record instanceof Module) {
            throw new \RuntimeException('Expected Module record');
        }

        return $this->record;
    }

    private function buildConfigPath(Module $module): string
    {
        $path = $module->path;
        if ($path === null) {
            throw new \RuntimeException('Module path is required');
        }

        return $path . '/config/config.php';
    }

    private function updateModuleConfig(Module $module, string $configPath): void
    {
        $data = File::getRequire($configPath);
        if (!is_array($data)) {
            $data = [];
        }

        $moduleData = $module->toArray();
        unset($moduleData['path']);

        $data = array_merge($data, $moduleData);
        app(SaveArrayAction::class)->execute($data, $configPath);
    }
}
```

### Table Actions

#### BaseTableAction Pattern
```php
abstract class XotBaseTableAction extends Action
{
    public function getRecord(): ?Model
    {
        $record = $this->record;

        // Handle Closure case (lazy loading)
        if ($record instanceof \Closure) {
            $record = $record();
        }

        return $record instanceof Model ? $record : null;
    }

    protected function requireRecord(): Model
    {
        $record = $this->getRecord();
        if ($record === null) {
            throw new \RuntimeException('Record is required for this action');
        }

        return $record;
    }
}
```

## Common Patterns

### 1. Safe Property Access
```php
// ✅ Good - Safe property access
public function getModulePath(Module $module): string
{
    return $module->path ?? throw new \RuntimeException('Module path is not set');
}

// ✅ Good - With default
public function getModuleIcon(Module $module): string
{
    return $module->icon ?? 'heroicon-o-cube';
}
```

### 2. Method Existence Checks
```php
// ✅ Good - Dynamic method calls with validation
public function callDynamicMethod(Model $record, string $methodName): mixed
{
    if (!method_exists($record, $methodName)) {
        throw new \BadMethodCallException("Method {$methodName} does not exist");
    }

    return $record->{$methodName}();
}
```

### 3. Collection Type Safety
```php
// ✅ Good - Collection with type checking
public function processRecords(Collection $records): void
{
    $records->each(function ($record): void {
        if (!$record instanceof Model) {
            throw new \InvalidArgumentException('All items must be Model instances');
        }

        $this->processRecord($record);
    });
}
```

## Error Handling Strategies

### 1. Fail Fast Approach
```php
public function validateAndProcess(?Model $record): void
{
    if ($record === null) {
        throw new \InvalidArgumentException('Record cannot be null');
    }

    if (!$record instanceof Module) {
        throw new \InvalidArgumentException('Expected Module instance');
    }

    $this->processModule($record);
}
```

### 2. Defensive Programming
```php
public function safeProcess(?Model $record): bool
{
    if ($record === null || !$record instanceof Module) {
        Log::warning('Invalid record provided to safeProcess');
        return false;
    }

    try {
        $this->processModule($record);
        return true;
    } catch (\Exception $e) {
        Log::error('Failed to process module', ['error' => $e->getMessage()]);
        return false;
    }
}
```

## PHPStan Configuration

### Recommended PHPStan Rules
```neon
parameters:
    level: 8
    paths:
        - Modules/Xot/app/Filament
    ignoreErrors:
        # Only ignore errors that are confirmed false positives
    checkMissingIterableValueType: true
    checkGenericClassInNonGenericObjectType: true
```

### Custom PHPStan Extensions
Consider implementing custom rules for:
- Filament action parameter validation
- Model type checking in resource pages
- Component method signature validation

## Testing Recommendations

### Unit Tests for Type Safety
```php
class FieldRefreshActionTest extends TestCase
{
    public function test_throws_exception_when_name_is_null(): void
    {
        $action = new FieldRefreshAction();
        // Mock getName() to return null

        $this->expectException(\RuntimeException::class);
        $action->callAction(null, new Set(), new Module());
    }

    public function test_handles_valid_record_properly(): void
    {
        $module = Module::factory()->create();
        $action = new FieldRefreshAction();

        // Test successful execution
        $this->assertDoesNotThrow(function () use ($action, $module) {
            $action->callAction('test', new Set(), $module);
        });
    }
}
```

## Migration Strategy

### Phase 1: Critical Fixes
1. Fix null safety issues in FieldRefreshAction
2. Add type assertions in EditModule
3. Correct return types in XotBaseTableAction

### Phase 2: Enhanced Type Safety
1. Add comprehensive type guards
2. Implement defensive programming patterns
3. Add method existence checks

### Phase 3: Advanced Features
1. Custom PHPStan rules
2. Automated type safety testing
3. Documentation generation from type annotations

## Maintenance Guidelines

### Regular Checks
- Run PHPStan on every commit
- Monitor for new type-related issues
- Update type annotations when Filament updates

### Code Review Checklist
- [ ] All parameters have explicit types
- [ ] Nullable values are handled properly
- [ ] Dynamic method calls are validated
- [ ] Return types match actual returns
- [ ] Type guards are used where appropriate

This document should be updated as new patterns emerge and Filament evolves.