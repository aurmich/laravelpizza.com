# Prototipo Standardizzato .gitignore per Moduli Laraxot

## Struttura Standardizzata

Questo documento definisce il prototipo standardizzato per i file `.gitignore` di tutti i moduli Laraxot, basato sull'analisi dei pattern esistenti e sulle best practices del progetto.

### Prototipo Completo

```gitignore
# Dependencies and packages
/vendor/
/node_modules/
/docs/vendor/

# Lock files and cache
*.lock
*.cache
*.phar
*.jar
package-lock.json
yarn-error.log
npm-debug.log
composer.lock
.phpunit.result.cache
.php-cs-fixer.cache

# Log files
*.log
error_log

# Build directories
/build/
/build
build/

# Laravel specific
bootstrap/compiled.php
app/storage/
public/storage
public/hot
public_html/storage
public_html/hot
storage/*.key
.env

# Database directories
database/Factories_
database/Factories_old
database/Migrations_old

# Local configurations
Homestead.yaml
Homestead.json
/.vagrant

# IDE specific
/.idea
.phpintel

# Git specific
.git-blame-ignore-revs
.git-rewrite/
.git-rewrite

# Temporary and system files
*.tmp
*.swp
*.swo
*.stackdump
*.exe
*:Zone.Identifier
.DS_Store
*.old
*.old1
*.backup
*.backup.*
*.bak
*.new

# Documentation and cache
docs/phpstan/
docs/cache/
cache/

# Development tools
.windsurf/
.cursor/
```

## Sezioni e Organizzazione

### 1. Dependencies and packages
- `/vendor/` - Dipendenze Composer
- `/node_modules/` - Dipendenze NPM/Yarn
- `/docs/vendor/` - Dipendenze specifiche per documentazione

### 2. Lock files and cache
- `*.lock` - File di lock generici
- `*.cache` - File di cache generici
- `*.phar` - Archivi PHP
- `*.jar` - Archivi Java (se presenti)
- `package-lock.json` - Lock file NPM
- `yarn-error.log` - Log errori Yarn
- `npm-debug.log` - Log debug NPM
- `composer.lock` - Lock file Composer
- `.phpunit.result.cache` - Cache PHPUnit
- `.php-cs-fixer.cache` - Cache PHP CS Fixer

### 3. Log files
- `*.log` - File di log generici
- `error_log` - Log errori specifici

### 4. Build directories
- `/build/` - Directory di build
- `/build` - Directory di build (senza slash finale)
- `build/` - Directory di build relativa

### 5. Laravel specific
- `bootstrap/compiled.php` - File compilato Laravel
- `app/storage/` - Storage applicazione
- `public/storage` - Storage pubblico
- `public/hot` - Hot reload Laravel
- `public_html/storage` - Storage public_html
- `public_html/hot` - Hot reload public_html
- `storage/*.key` - Chiavi di storage
- `.env` - File ambiente

### 6. Database directories
- `database/Factories_` - Directory factories temporanee
- `database/Factories_old` - Directory factories vecchie
- `database/Migrations_old` - Directory migrazioni vecchie

### 7. Local configurations
- `Homestead.yaml` - Configurazione Homestead
- `Homestead.json` - Configurazione Homestead JSON
- `/.vagrant` - Directory Vagrant

### 8. IDE specific
- `/.idea` - Directory IntelliJ IDEA
- `.phpintel` - File PHP Intel

### 9. Git specific
- `.git-blame-ignore-revs` - File ignore blame Git
- `.git-rewrite/` - Directory rewrite Git
- `.git-rewrite` - File rewrite Git

### 10. Temporary and system files
- `*.tmp` - File temporanei
- `*.swp` - File swap Vim
- `*.swo` - File swap Vim
- `*.stackdump` - Dump stack
- `*.exe` - File eseguibili
- `*:Zone.Identifier` - **IDENTIFICATORE ZONE WINDOWS** (CRITICO)
- `.DS_Store` - File sistema macOS
- `*.old` - File vecchi
- `*.old1` - File vecchi numerati
- `*.backup` - File backup
- `*.backup.*` - File backup con estensione
- `*.bak` - File backup
- `*.new` - File nuovi temporanei

### 11. Documentation and cache
- `docs/phpstan/` - Documentazione PHPStan
- `docs/cache/` - Cache documentazione
- `cache/` - Cache generica

### 12. Development tools
- `.windsurf/` - Directory Windsurf
- `.cursor/` - Directory Cursor

## Regole di Implementazione

### 1. Ordine Obbligatorio
Le sezioni devono essere sempre nell'ordine specificato nel prototipo.

### 2. Spaziatura
- Una riga vuota tra ogni sezione
- Nessuna riga vuota all'inizio del file
- Una riga vuota alla fine del file

### 3. Commenti
- Ogni sezione deve iniziare con un commento descrittivo
- I commenti devono essere in inglese per coerenza

### 4. Pattern Specifici
- `*:Zone.Identifier` è **OBBLIGATORIO** in tutti i moduli
- I pattern devono essere specifici e non generici quando possibile
- Evitare pattern troppo ampi che potrebbero escludere file necessari

## Controlli di Qualità

### Verifica Presenza Pattern Critici
```bash
# Verifica presenza Zone.Identifier
grep -r "*:Zone.Identifier" laravel/Modules/*/.gitignore

# Verifica presenza vendor
grep -r "/vendor/" laravel/Modules/*/.gitignore

# Verifica presenza node_modules
grep -r "/node_modules/" laravel/Modules/*/.gitignore
```

### Verifica Ordine Sezioni
Ogni file `.gitignore` deve rispettare l'ordine delle sezioni definito nel prototipo.

## Aggiornamento Moduli

### Processo di Standardizzazione
1. **Analisi**: Verificare il contenuto attuale del `.gitignore`
2. **Confronto**: Confrontare con il prototipo standardizzato
3. **Aggiornamento**: Aggiungere pattern mancanti
4. **Ordinamento**: Riorganizzare secondo l'ordine standardizzato
5. **Verifica**: Controllare che tutti i pattern critici siano presenti

### Pattern Critici da Verificare
- `*:Zone.Identifier` (OBBLIGATORIO)
- `/vendor/`
- `/node_modules/`
- `*.log`
- `*.cache`
- `*.lock`
- `.env`
- `docs/phpstan/`
- `database/Factories_`
- `database/Factories_old`
- `database/Migrations_old`

## Note di Implementazione

### Compatibilità
Il prototipo è compatibile con:
- Laravel 11
- PHP 8.4+
- Composer 2.x
- NPM/Yarn
- Git
- IDE comuni (PHPStorm, VSCode, Cursor, Windsurf)

### Personalizzazioni Modulo
I moduli possono aggiungere pattern specifici alla fine del file, mantenendo l'ordine standardizzato per le sezioni comuni.

### Manutenzione
- Aggiornare il prototipo quando vengono identificati nuovi pattern comuni
- Documentare eventuali eccezioni specifiche per moduli
- Mantenere la coerenza tra tutti i moduli del progetto

## Stato Implementazione

### Completamento Standardizzazione
- **Data Completamento**: 16 Settembre 2025
- **Data Aggiornamento Database**: 16 Settembre 2025
- **Moduli Totali**: 34
- **Moduli Conformi**: 34 (100%)
- **Stato**: ✅ COMPLETATO - Tutti i moduli seguono il prototipo standardizzato

### Moduli Aggiornati
Tutti i 34 moduli del progetto sono ora conformi al prototipo standardizzato:
- Activity, Badge, CertFisc, ContoAnnuale, DbForge, Europa, Gdpr, Inail
- Incentivi, IndennitaCondizioniLavoro, IndennitaResponsabilita, Job, Lang
- Legge104, Legge109, Media, Mensa, MobilitaVolontaria, Notify, Pdnd
- Performance, Prenotazioni, PresenzeAssenze, Progressioni, Ptv
- Questionari, Rating, Setting, Sigma, Sindacati, Tenant, UI, User, Xot

### Verifiche Implementate
- ✅ Pattern `*:Zone.Identifier` presente in tutti i moduli
- ✅ Sezione "Development tools" (.windsurf/, .cursor/) completa
- ✅ Sezione "IDE specific" (/.idea, .phpintel) completa
- ✅ Pattern `error_log` presente nella sezione log files
- ✅ Sezione "Database directories" (database/Factories_, database/Factories_old, database/Migrations_old) completa
- ✅ Ordine delle sezioni conforme al prototipo
- ✅ Struttura e spaziatura standardizzata

### Script di Manutenzione
Creati script automatici per la manutenzione:
- `update_gitignore.sh` - Aggiornamento batch dei .gitignore
- `fix_remaining_gitignore.sh` - Correzione moduli non conformi
- Verifiche automatiche di conformità integrate

---

**Data Creazione**: 3 Gennaio 2025  
**Data Completamento**: 16 Settembre 2025  
**Data Aggiornamento Database**: 16 Settembre 2025  
**Stato**: ✅ IMPLEMENTATO - Standardizzazione Completata  
**Priorità**: COMPLETATA (Standardizzazione Moduli Laraxot)
