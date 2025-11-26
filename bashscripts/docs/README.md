# Bashscripts Documentation

## 📚 Indice Documentazione

Questa cartella contiene la documentazione completa di tutti gli script operativi del progetto PTVX.

**📊 Ultimo aggiornamento**: Gennaio 2025 - Session 4/1/2025  
**📁 Totale documenti**: 10+ (script, patterns, strategies)  
**🎯 Coverage**: Git conflicts, file locking, docs consolidation

### 🔧 Git & Conflict Resolution

- **[git-conflicts-quick-reference.md](./git-conflicts-quick-reference.md)** ⚡  
  Cheat sheet rapida: comandi one-liner, opzioni, exit codes, quando usare/non usare automazione.

- **[git-conflict-resolution-guide.md](./git-conflict-resolution-guide.md)** 📖  
  Guida pratica completa: Quick start, casi d'uso, troubleshooting, API libreria per sviluppatori, FAQ dettagliate.

- **[git-conflict-resolution-analysis.md](./git-conflict-resolution-analysis.md)** 🔬  
  Analisi critica profonda: inventario 27 script, comparazione versioni, litigio filosofico, raccomandazioni architetturali, riflessioni meta.

- **[supermucca-v6-deep-analysis.md](./supermucca-v6-deep-analysis.md)** 🔬🐛  
  Analisi forensic linea-per-linea SuperMucca V6 (584 righe): 16 bug trovati (3 critici, 4 importanti, 9 enhancements), litigio tecnico su ogni aspetto.

- **[file-locking-pattern.md](./file-locking-pattern.md)** 🔒  
  Pattern lock file per prevenzione race condition: filosofia, religione, ZEN, implementazione atomica, edge cases, best practices.

- **[docs-consolidation-strategy.md](./docs-consolidation-strategy.md)** 📋  
  Strategia consolidamento 5200+ file docs → 300-400: analisi situazione, piano fase 1, quick wins, timeline.

- **[session-summary-2025-01-04.md](./session-summary-2025-01-04.md)** 📝  
  Riepilogo completo sessione 4 Gennaio: obiettivi, fix implementati, documentazione creata, metriche, lezioni apprese.

- **[MASTER-SESSION-2025-01-04.md](./MASTER-SESSION-2025-01-04.md)** 🎯👑  
  **DOCUMENTO MASTER** - Executive summary completo: 7 obiettivi completati, 50+ errori fixati, 20+ docs creati, filosofie applicate, metriche dettagliate, next steps. START HERE per overview completo.

### 🗂️ Organizzazione Repository

- **[bashscripts-location-policy.md](../../laravel/Modules/Xot/docs/bashscripts-location-policy.md)**  
  Policy vincolante sulla posizione degli script (SOLO in sottocartelle di `bashscripts/`).

- **[file-naming-case-sensitivity.md](../../laravel/Modules/Xot/docs/file-naming-case-sensitivity.md)**  
  Regole PSR-4 e case sensitivity per file PHP (UpperCamelCase obbligatorio).

## 🎯 Quick Start

### Scenario 1: Conflitti Git - Fix Rapido (COMUNE)

**Hai file con `<<<< HEAD`? Vuoi accettare sempre la tua versione locale?**

```bash
cd /var/www/_bases/base_ptvx_fila4_mono

# Step 1: Test sicuro
./bashscripts/git/conflict_resolution/resolve_conflicts_current_change_v6.sh --dry-run

# Step 2: Se OK, esegui
./bashscripts/git/conflict_resolution/resolve_conflicts_current_change_v6.sh

# Step 3: Commit
git add -A && git commit -m "fix: auto-resolve conflicts (current)"
```

**Documentazione**: 
- Quick: [git-conflicts-quick-reference.md](./git-conflicts-quick-reference.md) ⚡
- Completa: [git-conflict-resolution-guide.md](./git-conflict-resolution-guide.md) 📖

### Scenario 2: Conflitti Git - Script Custom/CI

**Devi integrare in pipeline o creare logica custom?**

```bash
#!/bin/bash
# Usa la libreria condivisa
source bashscripts/lib/git-conflict-resolver.sh

export GCR_BASE_DIR="/var/www/_bases/base_ptvx_fila4_mono"
gcr_resolve_batch "$GCR_BASE_DIR/laravel" "current" false
```

**Documentazione**: [git-conflict-resolution-guide.md § Libreria](./git-conflict-resolution-guide.md#-libreria-per-sviluppatori-avanzato)

### Scenario 3: File Duplicati Case-Sensitivity

**Hai file come `User.php` e `user.php` nella stessa directory?**

```bash
# Cleanup automatico
/var/www/_bases/base_ptvx_fila4_mono/bashscripts/fix/cleanup-case-duplicates.sh
```

**Documentazione**: [file-naming-case-sensitivity.md](../../laravel/Modules/Xot/docs/file-naming-case-sensitivity.md)

<<<<<<< HEAD
## 📂 Struttura Bashscripts
=======
### 5. Configurare il Database
Modificare il file `.env` con le credenziali del database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=progetto_data
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Eseguire le Migrazioni
```bash
php artisan migrate
```

### 7. Installare i Moduli
```bash
=======

>>>>>>> f71d08e230 (.)
# Installare Laravel Modules
composer require nwidart/laravel-modules

# Pubblicare la configurazione dei moduli
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

# Aggiungere il modulo Xot
git remote add -f xot https://github.com/crud-lab/xot.git
git subtree add --prefix Modules/Xot xot main --squash
```

### 8. Compilare gli Assets
```bash
npm run dev
```

### 9. Avviare il Server di Sviluppo
```bash
php artisan serve
```

## Struttura del Progetto

```
<nome-progetto>/
├── app/
├── config/
├── database/
├── Modules/
│   ├── Core/
│   ├── Patient/
│   ├── Dental/
│   └── Xot/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
└── docs/
    ├── roadmap/
    └── packages/
```

## Moduli Principali

### Core
- Gestione utenti e autenticazione
- Configurazione sistema
- Funzionalità base

### Patient
- Gestione pazienti
- Anamnesi
- Storico visite

### Dental
- Gestione trattamenti
- Calendario appuntamenti
- Documenti clinici

### Xot
- Framework base per i moduli
- Componenti riutilizzabili
- Funzionalità comuni

## Documentazione

La documentazione completa è disponibile nella directory `docs/`:
- [Roadmap del Progetto](docs/roadmap/README.md)
- [Documentazione dei Pacchetti](docs/packages/README.md)

## Sviluppo

### Comandi Utili
```bash
=======

>>>>>>> f71d08e230 (.)
# Creare un nuovo modulo
php artisan module:make NomeModulo

# Generare componenti per un modulo
php artisan module:make-controller NomeController NomeModulo
php artisan module:make-model NomeModel NomeModulo
php artisan module:make-migration create_table NomeModulo

# Eseguire i test
php artisan test

# Aggiornare le dipendenze
composer update
npm update
```

### Best Practices
- Seguire le convenzioni PSR-4 per l'autoloading
- Utilizzare i namespace corretti per i moduli
- Documentare le modifiche nel CHANGELOG.md
- Mantenere i test aggiornati
- Verificare la compatibilità cross-browser

## Licenza
Questo progetto è sotto licenza MIT. Vedere il file [LICENSE](LICENSE) per i dettagli. 




 b0f37c83 (.)

=======

 b7907077 (.)


 b1ca4c93 (Squashed 'bashscripts/' changes from c21599d..019cc70)
>>>>>>> 3a6821ae8 (aggiornamento cartella bashscripts)
=======
>>>>>>> f71d08e230 (.)
# 🚀 BashScripts Power Tools
 80ec88ee9 (.


### Versione Incoming

# 🚀 Toolkit di Automazione Git per Laraxot PTVX

[![PHPStan](https://img.shields.io/badge/PHPStan-Level%209-brightgreen.svg?style=for-the-badge&logo=php&logoColor=white)](../docs/phpstan/ANALISI_MODULI_PHPSTAN.md)


### Versione Incoming


---

# 🚀 Toolkit di Automazione Git

### Versione Incoming

# 🚀 Git Automation Toolkit

---


[![PHPStan](https://img.shields.io/badge/PHPStan-Level%209-brightgreen.svg?style=for-the-badge&logo=php&logoColor=white)](docs/phpstan/ANALISI_MODULI_PHPSTAN.md)

## System Requirements
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+
- Git

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/project.git
cd project
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Install Modules
```bash
=======

>>>>>>> f71d08e230 (.)
# Install Laravel Modules
composer require nwidart/laravel-modules

# Publish module configuration
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

# Add Xot module
git remote add -f xot https://github.com/crud-lab/xot.git
git subtree add --prefix Modules/Xot xot main --squash
```

### 8. Compile Assets
```bash
npm run dev
```

### 9. Start Development Server
```bash
php artisan serve
```

## Project Structure

```
project/
├── app/
├── config/
├── database/
├── Modules/
│   ├── Core/
│   ├── Module1/
│   ├── Module2/
│   └── Xot/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
└── docs/
    ├── roadmap/
    └── packages/
```

## Core Modules

### Core
- User management and authentication
- System configuration
- Base functionality

### Module1
- Module 1 specific features
- Data management
- User interface

### Module2
- Module 2 specific features
- Process management
- Integrations

### Xot
- Base framework for modules
- Reusable components
- Common functionality

## Documentation

Complete documentation is available in the `docs/` directory:
- [Project Roadmap](docs/roadmap/README.md)
- [Packages Documentation](docs/packages/README.md)

## Development

### Useful Commands
```bash
=======

>>>>>>> f71d08e230 (.)
# Create a new module
php artisan module:make ModuleName

# Generate module components
php artisan module:make-controller ControllerName ModuleName
php artisan module:make-model ModelName ModuleName
php artisan module:make-migration create_table ModuleName

# Run tests
php artisan test

# Update dependencies
composer update
npm update
```

### Best Practices
- Follow PSR-4 autoloading conventions
- Use proper namespaces for modules
- Document changes in CHANGELOG.md
- Keep tests updated
- Verify cross-browser compatibility

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com)
[![Bash](https://img.shields.io/badge/Bash-4EAA25?style=for-the-badge&logo=gnu-bash&logoColor=white)](https://www.gnu.org/software/bash/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)

> **⚠️ WARNING: This toolkit is designed for experienced developers working with complex Git repositories and monorepo structures.**

## 📋 Overview

This toolkit is a comprehensive suite of Bash scripts designed to automate and simplify the management of complex Git repositories, with a focus on monorepo structures and synchronization between organizations. It was developed to optimize the workflow of developers and reduce human errors in complex Git operations.

## 🎯 Key Features

### 🔄 Advanced Synchronization
- Automatic synchronization between Git organizations
- Intelligent submodule management
- Support for complex monorepo structures
- Automatic conflict resolution

### 🛠️ Maintenance Tools
- Automatic repository cleanup
- Advanced branch management
- Conflict resolution tools
- Automated backup

### 🔍 Checks and Validation
- MySQL database state verification
- Pre-commit checks
- Project structure validation
- PHP static code analysis

## 📁 Toolkit Structure
>>>>>>> 4b834e6 (.)

```
bashscripts/
├── analysis/           # Script analisi codice/moduli
├── backup/            # Script backup e sync
├── conflicts/         # (Legacy) Script gestione conflitti
├── docs/              # 📚 QUESTA CARTELLA - Documentazione
├── fix/               # Script correzione bug/problemi
├── git/               # Script gestione Git
│   └── conflict_resolution/  # ⭐ Script risoluzione conflitti (CANONICA)
├── maintenance/       # Script manutenzione/ottimizzazione
├── merge_conflicts/   # (Legacy) Script merge conflicts
├── phpstan/           # Script analisi statica PHPStan
├── testing/           # Script test automation
├── translations/      # Script gestione traduzioni
└── utils/             # Utility generiche
```

## 🏆 Tool Ecosystem: Script vs Libreria

### Due Approcci Complementari

#### 1. **Script Standalone** (End Users)

**Best**: `git/conflict_resolution/resolve_conflicts_current_change_v6.sh`

**Per chi**: Developer, team leads, operazioni quotidiane  
**Quando**: Quick fix, uso interattivo, conflitti current-only  
**Come**: Esegui direttamente via CLI con opzioni

**Features**:
- ✅ Gestione conflitti annidati con depth tracking
- ✅ Backup automatico validato
- ✅ Dry-run mode integrato
- ✅ Batch processing parallelo (4 core)
- ✅ Logging dettagliato con timestamp
- ✅ Performance ottimizzate
- ✅ Color output + emoji
- ✅ Help completo (`--help`)

#### 2. **Libreria Condivisa** (Developers)

**Best**: `lib/git-conflict-resolver.sh`

**Per chi**: DevOps, CI/CD engineers, sviluppatori script custom  
**Quando**: Automazione, pipeline, logica complessa custom  
**Come**: Import via `source` e usa funzioni API

**Features**:
- ✅ API modulare con 15+ funzioni
- ✅ Supporto BOTH strategies (incoming + current)
- ✅ Logging multi-livello (debug/info/warning/error/success)
- ✅ Riutilizzabile in infinite configurazioni
- ✅ Testabile e componibile
- ✅ Zero output se non richiesto (scriptable)
- ✅ Namespace pulito (prefix `gcr_`)

### Quando Usare Cosa?

| Scenario | Tool Consigliato | Rationale |
|----------|------------------|-----------|
| Fix manuale veloce | SuperMucca V6 Script | CLI ready, no coding |
| Conflitti current-only | SuperMucca V6 Script | Ottimizzato per questo |
| Conflitti incoming | Libreria | Script standalone non supporta |
| CI/CD pipeline | Libreria | Flessibilità configurazione |
| Script custom logic | Libreria | API componibili |
| 1000+ conflitti | SuperMucca V6 Script | Batch processing ottimizzato |
| Strategia dinamica | Libreria | Puoi decidere per-file |
| Learning/Tutorial | Libreria | Capire internals |

### PHPStan Analysis

**BEST**: `phpstan/analyze_modules.sh`

- Analisi multi-modulo
- Level 10 support
- Memory management
- Report dettagliati

### Documentation Management

**BEST**: `docs/fix_docs_naming_final.sh`

- Naming convention enforcement (lowercase)
- Backup automatico
- Validazione

## 📖 Convenzioni

### Naming Script

```bash
{action}_{scope}_{variant}_{version}.sh

# Esempi
resolve_git-conflicts_current-change_v6.sh
fix_docs_naming_final.sh
analyze_phpstan_modules.sh
```

### Posizionamento

**REGOLA ASSOLUTA**: Script `.sh` SOLO in sottocartelle di `bashscripts/`, MAI in root `laravel/` o root progetto.

```bash
# ✅ CORRETTO
bashscripts/fix/cleanup-case-duplicates.sh
bashscripts/git/conflict_resolution/resolve_conflicts_current_change_v6.sh

<<<<<<< HEAD
# ❌ ERRATO
laravel/cleanup.sh
/var/www/_bases/base_ptvx_fila4_mono/fix-something.sh
```
=======
 4bd5ca8f (.)
=======
>>>>>>> 4b834e6 (.)

### Documentazione Script

Ogni nuovo script DEVE avere:

<<<<<<< HEAD
1. **Header con metadata**:
=======
 b7907077 (.)

=======

>>>>>>> 1831d11e78 (.)
# 📣 Enhance Your App with the Fila3 Notify Module! 🚀

![GitHub issues](https://img.shields.io/github/issues/laraxot/module_notify_fila3)
![GitHub forks](https://img.shields.io/github/forks/laraxot/module_notify_fila3)
![GitHub stars](https://img.shields.io/github/stars/laraxot/module_notify_fila3)
![License](https://img.shields.io/badge/license-MIT-green)

Welcome to the **Fila3 Notify Module**! This powerful notification system is designed to streamline communication within your application. Whether you’re sending alerts, reminders, or updates, the Fila3 Notify Module has you covered with its versatile features and easy integration.

## 📦 What’s Inside?

The Fila3 Notify Module allows you to implement a robust notification system with minimal effort, featuring:

- **Real-time Notifications**: Send and receive notifications instantly to enhance user engagement.
- **Customizable Notification Types**: Tailor notifications to your needs, from alerts to success messages.
- **User-Specific Notifications**: Deliver targeted notifications to specific users based on their actions or preferences.
- **Persistent Notification Management**: Easily manage and store notifications for later access.

## 🌟 Key Features

- **Multi-format Support**: Create notifications with rich content, including text, images, and links.
- **Notification Queue**: Handle multiple notifications efficiently with a built-in queue system.
- **Event Listeners**: Integrate easily with your application’s events to trigger notifications automatically.
- **Custom Notification Channels**: Organize notifications into different channels to keep users informed about relevant updates.
- **Configurable Display Options**: Choose how and where notifications appear, from pop-ups to in-page alerts.
- **User Preferences Management**: Allow users to customize their notification settings for a personalized experience.
- **Integration with External APIs**: Seamlessly connect with third-party services to fetch or send notifications.

## 🚀 Why Choose Fila3 Notify?

- **Efficient & Lightweight**: Designed for high performance without slowing down your application.
- **Scalable Architecture**: Perfect for small applications and large-scale systems alike.
- **Active Community Support**: Join an engaged community of developers ready to assist and share insights.

## 🔧 Installation

Getting started with the Fila3 Notify Module is easy! Follow these steps to integrate it into your application:

1. Clone the repository:
>>>>>>> 4b834e6 (.)
   ```bash
   #!/bin/bash
   # =========================================================================
   # Script Name and Purpose
   # =========================================================================
   # Descrizione: Cosa fa lo script
   # Posizione: bashscripts/cartella/
   # Autore: Nome
   # Versione: X.Y
   # Data: YYYY-MM-DD
   # =========================================================================
   ```

2. **Documentazione esterna in `bashscripts/docs/`**

3. **Help integrato** (`--help`)

## 🚨 Problemi Comuni

### 1. Duplicazione Script

**Problema**: Stesso script in 3+ cartelle  
**Soluzione**: Identificare versione CANONICA, deprecare altre

**Docs**: [git-conflict-resolution-analysis.md](./git-conflict-resolution-analysis.md) § "Problemi Sistemici"

<<<<<<< HEAD
### 2. Path Hardcoded

**Problema**: Path assoluti non configurabili  
**Soluzione**: Usare `${VAR:-default}` con env var

```bash
# ✅ CORRETTO
readonly BASE_DIR="${BASE_DIR:-/var/www/_bases/base_ptvx_fila4_mono}"

# ❌ ERRATO
readonly BASE_DIR="/var/www/_bases/base_fixcity_fila4_mono"
=======
=======

>>>>>>> 1831d11e78 (.)
# Bash Scripts

**Policy di organizzazione:** Nessuno script `.sh` deve essere presente direttamente nella root di questa cartella. Tutti gli script devono essere categorizzati e inseriti in sottocartelle dedicate in base alla loro funzione (es. `utils/`, `git/`, `docs_update/`).

**Motivazione:**
- Migliora l’ordine e la manutenibilità del repository
- Facilita la ricerca e la categorizzazione degli script
- Riduce il rischio di errori e duplicazioni
- Rende più semplice aggiornare la documentazione e i riferimenti

**Sottocartelle principali:**
- `utils/` — Utility generiche, gestione conflitti, verifica asset, path, traduzioni
- `git/` — Script per operazioni git avanzate
- `docs_update/` — Script per aggiornamento/migrazione documentazione
- ...altre sottocartelle per categorie specifiche

Per dettagli e policy aggiornate consulta anche [docs/scripts.md](../docs/scripts.md)

## Struttura
La documentazione completa della struttura è disponibile in [docs/structure.md](docs/structure.md).

```
bashscripts/
├── git/              # Script per la gestione Git
│   ├── subtrees/     # Gestione subtrees
│   ├── submodules/   # Gestione submodules
│   └── maintenance/  # Manutenzione repository
├── setup/           # Script di configurazione e setup
├── maintenance/     # Script di manutenzione
├── utils/           # Utility varie
├── backup/          # Script di backup
└── testing/         # Script per i test
```

## Categorie

### 1. Git (`git/`)
Script per la gestione di Git, inclusi:
- Gestione dei subtree
- Sincronizzazione dei repository
- Risoluzione dei conflitti
- Gestione dei branch

### 2. Setup (`setup/`)
Script per la configurazione iniziale:
- Installazione delle dipendenze
- Configurazione dell'ambiente
- Setup del database
- Configurazione dei moduli

### 3. Maintenance (`maintenance/`)
Script per la manutenzione:
- Pulizia della cache
- Ottimizzazione del database
- Aggiornamento delle dipendenze
- Manutenzione dei file

### 4. Utils (`utils/`)
Utility varie:
- Script di supporto
- Funzioni comuni
- Helper per lo sviluppo

### 5. Backup (`backup/`)
Script per il backup:
- Backup del database
- Backup dei file
- Rotazione dei backup

### 6. Testing (`testing/`)
Script per i test:
- Esecuzione dei test
- Analisi del codice
- Verifica della qualità

## Utilizzo

### 1. Esecuzione degli Script
```bash
=======

>>>>>>> f71d08e230 (.)
# Rendere lo script eseguibile
chmod +x script.sh

# Eseguire lo script
./script.sh
>>>>>>> 4b834e6 (.)
```

### 3. Script Non Eseguibili

**Problema**: `Permission denied`  
**Soluzione**:
```bash
chmod +x bashscripts/categoria/script.sh
```

## 🔗 Collegamenti

### Documentazione Interna

- [Xot Module Docs](../../laravel/Modules/Xot/docs/)
- [Bashscripts Location Policy](../../laravel/Modules/Xot/docs/bashscripts-location-policy.md)
- [File Naming Rules](../../laravel/Modules/Xot/docs/file-naming-case-sensitivity.md)

### Documentazione Esterna

- [Git Conflict Markers](https://git-scm.com/docs/git-merge#_how_conflicts_are_presented)
- [PSR-4 Autoloading](https://www.php-fig.org/psr/psr-4/)
- [Bash Best Practices](https://google.github.io/styleguide/shellguide.html)

## 📝 Contribuire

### Aggiungere Nuovo Script

1. **Posizionamento**: Scegli sottocartella appropriata di `bashscripts/`
2. **Naming**: Segui convenzioni (`{action}_{scope}_{version}.sh`)
3. **Header**: Includi metadata completo
4. **Help**: Implementa `--help` flag
5. **Documentazione**: Crea/aggiorna file in `bashscripts/docs/`
6. **Testing**: Test manuale + dry-run mode se applicabile
7. **Review**: Code review prima di merge

### Aggiornare Documentazione

1. Identifica documento pertinente in `bashscripts/docs/`
2. Aggiungi sezione o crea nuovo file (lowercase)
3. Aggiorna questo README.md se nuovo documento
4. Crea backlink bidirezionali
5. Valida con checklist DRY+KISS

## 🎓 Best Practices

1. **DRY (Don't Repeat Yourself)**: No duplicazioni
2. **KISS (Keep It Simple, Stupid)**: Semplicità over complessità
3. **Safety First**: Backup, dry-run, validazione
4. **Documentation**: Commenti inline + docs esterna
5. **Testing**: Test prima di production
6. **Portability**: Env var invece di path hardcoded
7. **Idempotency**: Script riutilizzabile più volte senza side effect

## 📊 Statistiche Repository

- **Script totali**: 506+
- **Cartelle principali**: 50+
- **Script con duplicati**: ~100 (da pulire)
- **Script documentati**: 5+ (in crescita)
- **Versioni mantenute**: V6+ (deprecare V1-V5)

---

**Ultimo aggiornamento**: Gennaio 2025  
**Maintainer**: Sistema PTVX  
**Status**: In continuo miglioramento
