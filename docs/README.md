=======
# Laraxot PTVX - Documentazione Consolidata

## Panoramica

Il modulo **Xot** è il core framework di Laraxot PTVX. Fornisce:
- Classi base (`XotBase*`) per Resources, Widgets, Actions, Blocks
- Pattern architetturali condivisi (Accessors, Traits, Delegation)
- Strumenti comuni (XotData, MetatagData, Navigation, Trans)
- Automazioni git/bash (cartella `bashscripts/`)

Laraxot PTVX è un ecosistema modulare basato su **Laravel 12**, Filament 4, Livewire 3, PHPStan livello 10 e PHP 8.3.

## 🔧 Correzioni Recenti

### Fix Critici (Novembre 2025)

1. **Merge Conflict Cleanup**
   - Risolti 18 file con duplicazioni  dovute a merge automatici
   - Focus su `HasXotTable.php`, `XotBaseChartWidget.php`, `MetatagData.php`

2. **Script Git Conflicts**
   - `resolve_conflicts_current_change_v6.sh` aggiornato alla v6.1
   - Bug fixati: cleanup temp, stat detection, exit code robusto

3. **Code Quality Improvements**
   - Risolti errori di sintassi che bloccavano PHPStan analysis
   - Migliorato il punteggio PHP Insights (Code: 52.6%, Complexity: 93.1%, Architecture: 35.3%, Style: 60.2%)
   - Fissato GenerateFormByFileAction.php con missing braces e variabili indefiniti
   - Corretti file di test con funzioni malformed

4. **Documentazione**
   - Guide conflitti riscritta (v2.0) con approccio filosofico
   - Documenti di bugfix e analisi inseriti in docs/Xot

**Dettagli**: vedi [bugfix-hasxottable-duplicate-if.md](./bugfix-hasxottable-duplicate-if.md), [syntax-errors-mass-fix.md](./syntax-errors-mass-fix.md) e [QUALITY_IMPROVEMENTS_SUMMARY_2025_11_18.md](./QUALITY_IMPROVEMENTS_SUMMARY_2025_11_18.md)

---

## Architettura Modulare

### Principi Fondamentali
- **Modularità**: 36 moduli indipendenti
- **Coerenza**: Convenzioni namespace, file system uniforme
- **Estensibilità**: Classi base estendibili
- **Manutenibilità**: Strumenti comuni, automazioni

- **Modularità**: Ogni funzionalità è organizzata in moduli indipendenti
- **Coerenza**: Struttura uniforme e convenzioni standardizzate
- **Estensibilità**: Facile aggiunta di nuovi moduli e funzionalità
- **Manutenibilità**: Codice pulito e ben documentato

## Caratteristiche Tecniche

- **Laravel 11**: Framework PHP moderno e potente
- **Filament 3**: Server-Driven UI framework per Laravel
- **Livewire 3**: Full-stack framework per Laravel
- **PHPStan 3**: Static analysis tool (Livello 9/10)
- **Pest 3**: PHP testing framework

## Principi di Sviluppo

- **Namespace**: I namespace dei moduli NON devono includere il segmento `app`
- **Tipizzazione**: Utilizzo di `declare(strict_types=1);` e type hints rigorosi
- **PHPStan**: Compliance con PHPStan Livello 9/10
- **Testing**: Test rigorosi senza `RefreshDatabase`

## Documentazione

### Documenti Principali

#### Qualità del Codice
- **[Lo Zen degli Strumenti di Qualità](quality-tools-zen.md)** ⭐ NUOVO - Filosofia completa PHPStan, Larastan, Safe, Assert, PHPMD, PHP Insights
- **[Best Practices Eloquent](eloquent-properties-best-practices.md)** - Guida completa per proprietà Eloquent
- **[Report Rimozione property_exists](property-exists-removal-report-2025-01-05.md)** - Eliminazione completa di property_exists
- **[Code Quality Rules](code-quality.md)** - Regole PHPStan, PHPMD, PHPInsights

#### Framework e Convenzioni
- [Convenzioni Laraxot](conventions.md) - Regole e convenzioni per lo sviluppo
- [Laravel Framework](laravel-framework.md) - Documentazione completa del framework
- [Model Context Protocol](model-context-protocol.md) - Implementazione MCP
- [Cast Actions](cast-actions.md) - Azioni di cast sicure
- [Collegamenti](links.md) - Raccolta di link e riferimenti

### Moduli del Sistema

- **[User Module](../User/docs/README.md)** - Gestione utenti, autenticazione e autorizzazione
- **[UI Module](../UI/docs/README.md)** - Componenti UI e interfacce utente
- **[Performance Module](../Performance/docs/README.md)** - Sistema di valutazione e performance
- **[Lang Module](../Lang/docs/README.md)** - Gestione traduzioni e localizzazione
- **[Progressioni Module](../Progressioni/docs/README.md)** - Sistema di progressioni e schede

## Quick Start

### Installazione

1. Clonare il repository
2. Installare le dipendenze: `composer install`
3. Configurare l'ambiente: `cp .env.example .env`
4. Generare la chiave: `php artisan key:generate`
5. Eseguire le migrazioni: `php artisan migrate`
6. Avviare il server: `php artisan serve`

---

## Strumenti Principali

| Componente | Descrizione |
|------------|-------------|
| `XotData` | Accesso centralizzato a config e dati cross-modulo |
| `MetatagData` | Gestione SEO/meta per front-end |
| `HasXotTable` | Trait avanzato per Filament tables |
| `TransTrait` | Traduzioni dinamiche e prefissi |
| `XotBaseRouteServiceProvider` | Routing modulare |

---

## Testing & Qualità

- **PHPStan**: Livello 10 (config in `phpstan.neon`)
- **Pest**: Test business logic moduli core
- **Laravel Pint**: PSR-12 + convenzioni Laraxot
- **Automazioni**: script in `bashscripts/test/`

```bash
./vendor/bin/phpstan analyse Modules/Xot --level=max
./vendor/bin/pest Modules/Xot/tests
```

---

## Roadmap

1. Consolidamento documentazione (500 → 120 file)
2. Automatizzare script di merge (PSR-4 + syntax pre-commit)
3. Portare test coverage > 90%
4. Introdurre dashboard health check moduli

---

## Link Utili

- [CHANGELOG](./CHANGELOG.md)
- [Bugfix HasXotTable](./bugfix-hasxottable-duplicate-if.md)
- [Mass Syntax Fix](./syntax-errors-mass-fix.md)
- [Git Conflict Guide](../../../bashscripts/docs/git-conflict-resolution-guide.md)
- [Namespace Conventions](./namespace_conventions.md)
- [Testing Guidelines](./testing.md)

---

## Installation
```bash
composer require laraxot/xot
```

## Configuration
Configurazione automatica tramite service providers.

## Documentation Archive
=======
=======
I file di documentazione originali sono stati consolidati per seguire i principi DRY + KISS.
Per accedere alla documentazione dettagliata originale, vedere il backup in:
`docs-consolidation-backup-*/Xot-docs-original/`

## Principles
- **DRY**: Un solo punto di verità
- **KISS**: Semplicità e chiarezza
- **Type Safety**: Tipizzazione rigorosa
- **Documentation**: Documentazione essenziale

## Links
- [Root Documentation](../../../project_docs/)
=======
## Quick Links Legacy
=======
## Quick Links Legacy
- [Root Documentation](../../../docs/)
- [<main module> Module](../<main module>/docs/)
- [Original Documentation Backup](../../../docs-consolidation-backup-*/Xot-docs-original/)
=======
