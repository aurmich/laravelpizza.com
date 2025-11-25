# Guida PHPStan - README

## 📖 Panoramica

Questo documento è la **guida completa e definitiva** per l'analisi e correzione sistematica degli errori PHPStan nel progetto Laraxot.

**File principale**: `phpstan1.txt` (1629 righe)

## 🎯 Obiettivo

Raggiungere **0 errori PHPStan** su tutti i moduli del progetto, mantenendo:
- ✅ Type safety al 100%
- ✅ Coerenza architettonica
- ✅ Documentazione aggiornata
- ✅ Qualità del codice > 90%

## 🚀 Quick Start

### 1. Analisi Iniziale
```bash
cd laravel
./vendor/bin/phpstan analyse Modules --memory-limit=-1
```

### 2. Scegli un Modulo
Inizia da moduli con **meno errori** (< 50):
```bash
./vendor/bin/phpstan analyse Modules/Blog --memory-limit=-1
```

### 3. Studia la Documentazione
```bash
cat Modules/Blog/docs/README.md
cat Modules/Blog/docs/architecture.md
```

### 4. Correggi Errori
Segui i pattern documentati in `phpstan1.txt`:
- Usa **SafeArrayCastAction** per cast sicuri
- Usa **Webmozart Assert** per validazioni
- Aggiungi **PHPDoc** con generics
- Estendi **XotBase** classes

### 5. Verifica
```bash
./vendor/bin/phpstan analyse Modules/Blog --memory-limit=-1
composer dump-autoload
php artisan config:clear
```

### 6. Aggiorna Documentazione
```bash
# Aggiorna docs del modulo
vim Modules/Blog/docs/phpstan-fixes.md
```

## 📚 Struttura Guida

### Sezioni Principali

1. **Quick Reference** - Comandi essenziali
2. **Indice** - Navigazione rapida
3. **Contesto e Obiettivi** - Filosofia del progetto
4. **Workflow Sistematico** - Processo step-by-step
5. **Strumenti Integrati** - PHPStan, Rector, Psalm, PHP Insights
6. **Regole Architetturali** - Pattern obbligatori
7. **Filament v4** - Risorse per lo studio
8. **Patterns di Correzione** - 14 pattern comuni
9. **Errori Risolti** - 8 errori reali con soluzioni
10. **Cast Actions** - Azioni centralizzate
11. **Sessioni Correzione** - Risultati storici
12. **Workflow Operativo** - 4 fasi operative
13. **Checklist** - Pre/Post correzione
14. **Pattern/Anti-Pattern** - Cosa fare e non fare
15. **Metriche** - KPI e obiettivi
16. **Troubleshooting** - Errori comuni
17. **Esempi Pratici** - 5 esempi end-to-end
18. **Script Automazione** - 3 script bash
19. **FAQ** - 8 domande frequenti
20. **Glossario** - Termini tecnici
21. **Risorse** - Link utili

## 🛠️ Strumenti Richiesti

### Installati nel Progetto
- ✅ PHPStan (analisi statica)
- ✅ Rector (refactoring automatico)
- ⚠️ Psalm (da verificare)
- ⚠️ PHP Insights (da verificare)

### Librerie Utilizzate
- ✅ Webmozart Assert
- ✅ TheCodingMachine Safe
- ✅ Spatie Laravel Queueable Actions
- ✅ Spatie Laravel Data

## 📋 Checklist Pre-Correzione

Prima di correggere un errore:
- [ ] Ho letto la documentazione del modulo?
- [ ] Ho compreso la causa radice?
- [ ] Ho valutato l'impatto architetturale?
- [ ] La soluzione rispetta i pattern esistenti?
- [ ] Uso classi XotBase quando necessario?
- [ ] Uso Cast Actions centralizzate?
- [ ] Aggiornerò la documentazione?

## ✅ Checklist Post-Correzione

Dopo aver corretto errori:
- [ ] PHPStan non segnala nuovi errori?
- [ ] Il numero totale di errori è diminuito?
- [ ] L'autoload funziona?
- [ ] L'applicazione si avvia?
- [ ] La documentazione è aggiornata?
- [ ] I test passano?

## 🎯 Metriche di Successo

### Obiettivi per Sessione
- **Errori corretti**: Minimo 50
- **Moduli completati**: Minimo 1
- **Tempo massimo**: 60 minuti per modulo
- **Documentazione**: 100% aggiornata

### KPI di Qualità
- **Errori PHPStan**: 0 (obiettivo finale)
- **Type Coverage**: > 95%
- **Documentazione**: 100% aggiornata
- **Test Coverage**: > 80%
- **PHP Insights Score**: > 90%

## 🔧 Pattern Comuni

### ✅ Pattern Corretti

#### 1. Cast Sicuri
```php
use Modules\Xot\Actions\Cast\SafeArrayCastAction;

$data = SafeArrayCastAction::cast($input);
```

#### 2. Type Narrowing
```php
use Webmozart\Assert\Assert;

if (method_exists($object, 'method')) {
    Assert::methodExists($object, 'method');
    $object->method();
}
```

#### 3. PHPDoc Generics
```php
/**
 * @return HasMany<Post>
 */
public function posts(): HasMany
{
    return $this->hasMany(Post::class);
}
```

#### 4. XotBase Extension
```php
use Modules\Xot\Filament\Resources\XotBaseResource;

class UserResource extends XotBaseResource
{
    // NON definire getTableColumns()
}
```

### ❌ Anti-Pattern da Evitare

#### 1. Ignorare Errori
```php
// ❌ SBAGLIATO
/** @phpstan-ignore-next-line */
$value = $data['key'];
```

#### 2. Modificare Configurazione
```php
// ❌ SBAGLIATO - NON modificare phpstan.neon
parameters:
    ignoreErrors:
        - '#Cannot access property#'
```

#### 3. Cast Non Sicuri
```php
// ❌ SBAGLIATO
$array = (array) $data;
```

## 📊 Progresso Storico

### Sessione Gennaio 2025
- **Errori iniziali**: 1218
- **Errori finali**: 1086
- **Errori corretti**: 132 (10.8%)
- **Moduli completati**: User, Xot, Fixcity (parziale)

### Modulo Blog
- **Errori iniziali**: 15
- **Errori finali**: 0
- **Tempo**: ~40 minuti
- **Pattern applicati**: SafeArrayCastAction, PHPDoc, Factory typing

## 🚨 Errori Comuni e Soluzioni

### 1. "Cannot access offset on mixed"
**Soluzione**:
```php
$data = SafeArrayCastAction::cast($data);
$value = $data['key'] ?? null;
```

### 2. "Method not found on mixed"
**Soluzione**:
```php
if (method_exists($object, 'method')) {
    Assert::methodExists($object, 'method');
    $object->method();
}
```

### 3. "Return type mismatch"
**Soluzione**:
```php
/**
 * @return array<string, mixed>
 */
public function getData(): array {
    Assert::isArray($this->data);
    return $this->data;
}
```

### 4. "Class not found"
**Soluzione**:
```bash
composer dump-autoload
php artisan config:clear
```

## 🔗 Risorse Utili

### Documentazione Framework
- [Laravel 12 Docs](https://laravel.com/docs/12.x)
- [Filament 4 Docs](https://filamentphp.com/docs/4.x)
- [PHPStan Docs](https://phpstan.org/user-guide/getting-started)
- [Webmozart Assert](https://github.com/webmozarts/assert)
- [TheCodingMachine Safe](https://github.com/thecodingmachine/safe)

### Documentazione Progetto
- Moduli: `Modules/{ModuleName}/docs/`
- Temi: `Themes/{ThemeName}/docs/`
- Regole: `.windsurf/rules/`
- Memorie: `.cursor/memories/`

## 📝 Script di Automazione

### Analisi per Modulo
```bash
# File: laravel/scripts/phpstan-by-module.sh
for module in Modules/*; do
    ./vendor/bin/phpstan analyse "$module" --memory-limit=-1
done
```

### Verifica Post-Correzione
```bash
# File: laravel/scripts/verify-fixes.sh
./vendor/bin/phpstan analyse Modules --memory-limit=-1
composer dump-autoload
php artisan config:clear
php artisan cache:clear
php artisan about
```

### Backup Prima Correzioni
```bash
# File: laravel/scripts/backup-before-fixes.sh
BACKUP_DIR="/tmp/phpstan-backups/$(date +%Y%m%d_%H%M%S)"
mkdir -p "$BACKUP_DIR"
cp -r Modules "$BACKUP_DIR/"
./vendor/bin/phpstan analyse Modules > "$BACKUP_DIR/phpstan-before.txt"
```

## ❓ FAQ

**Q: Posso modificare phpstan.neon?**  
A: ❌ NO. Gli errori vanno sempre corretti, mai ignorati.

**Q: Quanto tempo ci vuole?**  
A: Modulo piccolo: 30-60min, Medio: 1-3h, Grande: 3-8h

**Q: Posso usare @phpstan-ignore?**  
A: ❌ NO. Usa Assert, Cast Actions, o implementa il metodo.

**Q: PHPStan o Rector prima?**  
A: Rector prima (modernizzazione), poi PHPStan (type safety).

**Q: Posso saltare la documentazione?**  
A: ❌ NO. Aggiorna sempre la documentazione del modulo.

## 🎓 Filosofia del Progetto

### Principi Fondamentali
1. **Zero compromessi**: Tutti gli errori vanno corretti
2. **Documentazione first**: Studia prima, correggi dopo
3. **Type safety**: Usa Assert e Cast Actions
4. **Modularità**: Un modulo alla volta
5. **Verifica continua**: PHPStan dopo ogni batch

### Mantra
> "DRY + KISS + SOLID + Robust + Laravel 12 + Filament 4 + PHP 8.3 + Laraxot"

### Regole d'Oro
- **Le cartelle docs sono la Bibbia**: Studia, rispetta, aggiorna
- **Non avrai altro path all'infuori del relativo**: Portabilità totale
- **Poteri della Supermucca**: Massima confidenza, zero compromessi

## 📞 Supporto

Per domande o problemi:
1. Consulta la guida completa: `phpstan1.txt`
2. Leggi il changelog: `CHANGELOG_phpstan1.md`
3. Studia la documentazione del modulo
4. Cerca pattern simili nel codebase
5. Consulta esempi pratici nella guida

---

**Versione**: 2.0  
**Data**: 2025-01-03  
**Autore**: Sistema di Correzione PHPStan Laraxot  
**Licenza**: Uso interno progetto
