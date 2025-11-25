# Xot Module - Documentation Index

> **Documentazione Modulo Xot** - Core framework per Laraxot  
> **Versione**: 3.0  
> **Ultimo aggiornamento**: 2025-01-06  
> **PHPStan Level**: 10 ✅

---

## 📚 Quick Navigation

### 🚀 Getting Started
- [README](README.md) - Introduzione generale
- [Installation](01-getting-started/installation.md) - Guida installazione
- [Quick Start](01-getting-started/quick-start.md) - Inizio rapido
- [Configuration](01-getting-started/configuration.md) - Configurazione base

### 🏗️ Architecture
- [Overview](02-architecture/overview.md) - Architettura generale
- [Module System](02-architecture/module-system.md) - Sistema moduli
- [Service Providers](02-architecture/service-providers.md) - Provider pattern
- [Base Classes](02-architecture/base-classes.md) - Classi base XotBase*

### 💻 Development
- [Coding Standards](03-development/coding-standards.md) - Standard codice
- [PHPStan Guide](03-development/phpstan-guide.md) - PHPStan Level 10
- [Testing Strategy](03-development/testing-strategy.md) - Testing
- [Git Workflow](03-development/git-workflow.md) - Git conventions

### 🎨 Filament
- [Best Practices](04-filament/best-practices.md) - Best practices
- [Resources](04-filament/resources.md) - XotBaseResource
- [Widgets](04-filament/widgets.md) - Widget development
- [Actions](04-filament/actions.md) - Custom actions

### 🗄️ Database
- [Models](05-database/models.md) - Eloquent models
- [Migrations](05-database/migrations.md) - Migration guidelines
- [Relationships](05-database/relationships.md) - Relazioni
- [Eloquent Magic Properties](05-database/eloquent-magic-properties.md) - isset() vs property_exists()

### 🔧 Advanced
- [Traits](06-advanced/traits.md) - Custom traits
- [Actions](06-advanced/actions.md) - Action pattern
- [Events](06-advanced/events.md) - Event system
- [Queue & Jobs](06-advanced/queue-jobs.md) - Background processing

### 🌐 Integration
- [MCP Servers](07-integration/mcp-servers.md) - Model Context Protocol
- [External APIs](07-integration/external-apis.md) - API integration
- [Themes](07-integration/themes.md) - Theme system
- [Translation](07-integration/translation.md) - i18n/l10n

### 🐛 Troubleshooting
- [Common Issues](08-troubleshooting/common-issues.md) - Problemi comuni
- [Debug Guide](08-troubleshooting/debug-guide.md) - Debugging
- [Performance](08-troubleshooting/performance.md) - Ottimizzazione
- [Error Reference](08-troubleshooting/error-reference.md) - Riferimento errori

### 📖 Reference
- [API Reference](09-reference/api.md) - API documentation
- [Commands](09-reference/commands.md) - Artisan commands
- [Configuration Options](09-reference/configuration.md) - Config reference
- [Changelog](09-reference/CHANGELOG.md) - Change log

---

## 🎯 Regole Fondamentali

### PHPStan Level 10
- ✅ **MAI** abbassare il livello
- ✅ **MAI** usare baseline
- ✅ **SEMPRE** 0 errori

### Eloquent Magic Properties
- ❌ **MAI** `property_exists()` su Model
- ✅ **SEMPRE** `isset()` per magic properties
- ✅ **SEMPRE** `hasAttribute()` per check espliciti

### Git Workflow
- ✅ **SEMPRE** forward-only
- ❌ **MAI** `git reset --hard` su commit pushati
- ✅ **SEMPRE** `git revert` per rollback

### Base Classes
- ✅ **SEMPRE** estendere `XotBaseModel` non `Model`
- ✅ **SEMPRE** estendere `XotBaseResource` non `Resource`
- ✅ **SEMPRE** estendere `XotBaseServiceProvider`

---

## 📁 Struttura Documentazione

```
docs/
├── 00-INDEX.md                    # Questo file
├── README.md                      # Introduzione generale
│
├── 01-getting-started/            # Guida iniziale
│   ├── installation.md
│   ├── quick-start.md
│   ├── configuration.md
│   └── environment-setup.md
│
├── 02-architecture/               # Architettura
│   ├── overview.md
│   ├── module-system.md
│   ├── service-providers.md
│   ├── base-classes.md
│   └── design-patterns.md
│
├── 03-development/                # Sviluppo
│   ├── coding-standards.md
│   ├── phpstan-guide.md
│   ├── testing-strategy.md
│   ├── git-workflow.md
│   └── debugging.md
│
├── 04-filament/                   # Filament
│   ├── best-practices.md
│   ├── resources.md
│   ├── widgets.md
│   ├── actions.md
│   └── forms.md
│
├── 05-database/                   # Database
│   ├── models.md
│   ├── migrations.md
│   ├── relationships.md
│   ├── eloquent-magic-properties.md
│   └── query-optimization.md
│
├── 06-advanced/                   # Avanzato
│   ├── traits.md
│   ├── actions.md
│   ├── events.md
│   ├── queue-jobs.md
│   └── custom-commands.md
│
├── 07-integration/                # Integrazioni
│   ├── mcp-servers.md
│   ├── external-apis.md
│   ├── themes.md
│   └── translation.md
│
├── 08-troubleshooting/            # Risoluzione problemi
│   ├── common-issues.md
│   ├── debug-guide.md
│   ├── performance.md
│   └── error-reference.md
│
├── 09-reference/                  # Riferimenti
│   ├── api.md
│   ├── commands.md
│   ├── configuration.md
│   └── CHANGELOG.md
│
└── _archive/                      # File obsoleti
    └── [vecchi file per riferimento]
```

---

## 🔍 Ricerca Rapida

### Per Task
- **Setup progetto** → `01-getting-started/`
- **Creare Resource** → `04-filament/resources.md`
- **Creare Model** → `05-database/models.md`
- **Fix PHPStan** → `03-development/phpstan-guide.md`
- **Debug issue** → `08-troubleshooting/`

### Per Tipo
- **Best Practices** → `03-development/`, `04-filament/`
- **Esempi codice** → Ogni file ha sezione Examples
- **Troubleshooting** → `08-troubleshooting/`
- **API Reference** → `09-reference/`

---

## 📝 Convenzioni Documentazione

### Naming Files
- **Lowercase** con dash: `my-document.md`
- **NO** underscore: ~~`my_document.md`~~
- **NO** spazi: ~~`my document.md`~~
- **Prefisso numerico** per ordine: `01-`, `02-`, etc.

### Struttura File
```markdown
# Titolo

> **Breve descrizione**
> **Status**: ✅ Updated / ⚠️ WIP / 🔄 Review

## Quick Reference
[Tabella o lista quick access]

## Contenuto Principale
[Sezioni ben strutturate]

## Examples
[Esempi pratici]

## See Also
[Link correlati]

---
**Ultimo aggiornamento**: YYYY-MM-DD
**Status**: ✅ / ⚠️ / 🔄
```

### Markdown Best Practices
- ✅ Headers chiari e gerarchici
- ✅ Code blocks con syntax highlighting
- ✅ Emoji per visual clarity (ma con moderazione)
- ✅ Link relativi tra docs
- ✅ Esempi pratici sempre presenti
- ✅ Sezione "See Also" per correlazioni

---

## 🤝 Contribuire

Per aggiungere o modificare documentazione:

1. Seguire la struttura standard
2. Aggiornare questo INDEX.md se necessario
3. Mantenere link relativi
4. Includere esempi pratici
5. Aggiornare data ultima modifica
6. Verificare link non rotti

---

## 📧 Contatti

- **Issues**: GitHub Issues
- **Discussions**: GitHub Discussions
- **Community**: Discord Laraxot

---

**Modulo**: Xot  
**Framework**: Laraxot 3.0  
**Laravel**: 12.x  
**Filament**: 4.x  
**PHPStan**: Level 10 ✅  
**Status**: Production Ready
