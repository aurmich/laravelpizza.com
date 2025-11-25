# Approccio Sistematico PHPStan - Framework Laraxot

**Creato**: 2025-09-10
**Scopo**: Guida operativa per correggere sistematicamente TUTTI gli errori PHPStan
**Principi**: DRY + KISS + Type Safety level 10/10

## 🏗️ Architettura Fondamentale

### REGOLA CRITICA #1: Estensione XotBase
**MAI ESTENDERE CLASSI FILAMENT DIRETTAMENTE**

❌ **VIETATO**:
```php
class Dashboard extends Filament\Pages\Dashboard
class MyResource extends Filament\Resources\Resource
class MyWidget extends Filament\Widgets\Widget
```

✅ **OBBLIGATORIO**:
```php
class Dashboard extends Modules\Xot\Filament\Pages\XotBaseDashboard
class MyResource extends Modules\Xot\Filament\Resources\XotBaseResource
class MyWidget extends Modules\Xot\Filament\Widgets\XotBaseWidget
```

### REGOLA #2: Tipizzazione Rigorosa
- **Nuovo codice**: Livello PHPStan 9+
- **Codice critico**: Livello 10
- **Factory**: Template generics per base classes

## 📊 Categorizzazione Errori PHPStan

### Priorità 1 - CRITICI (Fix Immediato)
- Syntax errors che bloccano l'analisi
- Chiamate a metodi inesistenti 
- Accesso a proprietà non definite
- Incompatibilità PHP 8.x

### Priorità 2 - TIPO SAFETY (Fix Sistematico)
- Annotazioni PHPDoc mancanti/errate
- Gestione null non sicura
- Tipi di ritorno incompatibili
- Template generics factory

### Priorità 3 - QUALITÀ CODICE (Fix Incrementale)
- Warning deprecazione
- Suggerimenti ottimizzazione
- Miglioramenti DRY/KISS

## 🔧 Pattern di Correzione Comuni

### 1. Factory Template Generics
```php
/**
 * @template TModel of \Modules\User\Models\User
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
}
```

### 1.1 Language File Syntax Validation
```php
// ❌ ERRATO - Missing closing array bracket
return [
    'key' => 'value',

// ✅ CORRETTO - Properly closed array
return [
    'key' => 'value',
];
```

### 1.2 UserContract Consistency Across Modules
```php
// ❌ ERRATO - Inconsistent UserContract usage
use Modules\User\Contracts\UserContract; // Wrong module
use Modules\Xot\Contracts\UserContract; // Correct module

// ✅ CORRETTO - Consistent Xot UserContract usage
use Modules\Xot\Contracts\UserContract;

class CacheLockPolicy extends XotBasePolicy
{
    public function viewAny(UserContract $user): bool
    {
        return $user->hasRole('super-admin'); // Use role-based auth
    }
}
```

### 2. Safe Functions Import
```php
use function Safe\json_decode;
use function Safe\file_get_contents;
```

### 3. Null Safety
```php
// ❌ ERRATO
$result = $model->method()->property;

// ✅ CORRETTO  
$result = $model->method()?->property ?? null;
```

### 4. Collection Methods
```php
// ❌ ERRATO
$collection->get(); // Missing parameters

// ✅ CORRETTO
$collection->get('key', 'default');
```

## 📋 Metodologia Sistematica

### Fase 1: Analisi Completa
1. Ottenere lista completa errori PHPStan
2. Categorizzare per priorità e modulo
3. Identificare pattern ripetuti

### Fase 2: Correzione Sistematica
1. **Priorità 1**: Fix immediato errori bloccanti
2. **Priorità 2**: Implementazione type safety
3. **Priorità 3**: Miglioramenti qualità

### Fase 3: Documentazione
1. Aggiornare documentazione modulo-specifica
2. Registrare pattern risolti
3. Creare esempi per futuri sviluppi

## 🎯 Obiettivi Finali

- [ ] Zero errori PHPStan level 10+ su tutti i moduli
- [ ] Documentazione aggiornata per ogni modulo
- [ ] Pattern comuni documentati e riutilizzabili
- [ ] Framework robusto per sviluppi futuri

## 🔗 Collegamenti Rapidi

- [Xot Architecture](architecture-best-practices.md)
- [Factory Best Practices](consolidated/phpstan/phpstan_factory_best_practices.md)
- [PHPStan Consolidated Guide](consolidated/phpstan/phpstan-consolidated.md)

---
*Documento di lavoro per correzione sistematica PHPStan - Framework Laraxot*