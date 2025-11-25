# Code Quality - Xot Module

> Last Updated: 2025-11-15 08:05:46

## Current Metrics

| Tool | Score | Status |
|------|-------|--------|
| PHPStan (Level 10) | 0 errors | 🟢 |
| PHPMD | 0 violations | 🟢 |
| PHP Insights - Quality | N/A% | ⚪ |
| PHP Insights - Complexity | N/A% | ⚪ |
| PHP Insights - Architecture | N/A% | ⚪ |
| PHP Insights - Style | N/A% | ⚪ |

### Status Legend
- 🟢 Excellent (meets or exceeds target)
- 🟡 Good (minor improvements needed)
- 🔴 Needs Work (significant improvements required)
- ⚪ Not Available

### Quality Targets
- **PHPStan**: 0 errors (Level 10)
- **PHPMD**: < 10 violations
- **PHP Insights**:
  - Quality: ≥ 80%
  - Complexity: ≥ 70%
  - Architecture: ≥ 75%
  - Style: ≥ 85%

## Improvement History

### 2025-11-15 - Initial Analysis
- PHPStan errors: 0
- PHPMD violations: 0
- Quality metrics recorded

## Common Issues and Solutions

### PHPStan Issues

✓ No PHPStan errors detected!

### PHPMD Issues

✓ No PHPMD violations detected!

## Best Practices for Xot

### Type Safety (PHPStan Level 10)

1. **Always use type hints**
   ```php
   // ✅ CORRECT
   public function getUserById(int $id): ?User
   {
       return User::find($id);
   }

   // ❌ WRONG
   public function getUserById($id)
   {
       return User::find($id);
   }
   ```

2. **Use Safe library for unsafe functions**
   ```php
   use function Safe\json_decode;
   use function Safe\file_get_contents;

   $data = json_decode($json, true); // Throws on error
   ```

3. **Handle edge cases**
   ```php
   public function getConnectionName(): ?string
   {
       if (isset($this->connection)) {
           $connection = $this->connection;

           // Handle UnitEnum edge case
           if ($connection instanceof \UnitEnum) {
               return null;
           }

           return $connection;
       }

       return parent::getConnectionName();
   }
   ```

### Code Complexity (PHPMD)

1. **Keep methods focused** - Max 150 lines per method
2. **Limit parameters** - Max 10 parameters (consider DTOs for more)
3. **Avoid deep nesting** - Extract complex logic to separate methods
4. **Reduce coupling** - Use dependency injection and interfaces

### Model Architecture

Models in this module extend:
- **BaseModel** - For regular Eloquent models
- **BasePivot** - For many-to-many pivot tables
- **BaseMorphPivot** - For polymorphic pivot tables

See [`models/README.md`](./models/README.md) for detailed model documentation.

## Continuous Improvement

### Weekly Checks
```bash
# Run quality analysis
./bashscripts/quality-improvement/analyze-module.sh Xot

# Update documentation
./bashscripts/quality-improvement/update-module-docs.sh Xot
```

### Pre-commit
```bash
# Format code
vendor/bin/pint --dirty

# Quick PHPStan check on changed files
vendor/bin/phpstan analyse path/to/changed/file.php --level=10
```

## Resources

- [PHPStan Documentation](https://phpstan.org/user-guide/getting-started)
- [PHPMD Rules](https://phpmd.org/rules/index.html)
- [PHP Insights](https://phpinsights.com/)
- [Safe Library](https://github.com/thecodingmachine/safe)
- [Project CLAUDE.md](../../CLAUDE.md)

---

**Analysis Reports**: `bashscripts/quality-improvement/results/Xot/`
