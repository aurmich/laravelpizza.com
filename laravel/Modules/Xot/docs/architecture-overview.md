# Architettura del Sistema - Panoramica

## Architettura Modulare Laravel

Questo progetto utilizza un'architettura modulare basata su `nwidart/laravel-modules` con un modulo core "Xot" che fornisce le funzionalità fondamentali a tutti gli altri moduli.

## Moduli Principali

### 🏗️ Xot - Modulo Core
**Priorità: 2** - Modulo fondamentale del sistema

**Funzionalità principali:**
- `BaseModel`: Classe base per tutti i modelli Eloquent
- `XotBaseServiceProvider`: Provider di servizi base ereditato da tutti i moduli
- `ProfileContract`: Interfaccia per la gestione dei profili utente
- Azioni riutilizzabili per la logica di business
- Data Transfer Objects tipizzati
- Comandi Artisan per la gestione del sistema
- Componenti Filament base

**Dipendenti:** Tutti i moduli dipendono da Xot

### 📋 TechPlanner - Modulo Principale
**Priorità: 0** - Modulo business principale

**Funzionalità:** Gestione e pianificazione tecnica delle attività
**Dipendenze:** Xot per strutture base

### 👥 User - Gestione Utenti
**Priorità: 0** - Autenticazione e autorizzazione

**Funzionalità:**
- Gestione utenti, ruoli e permessi
- Autenticazione e autorizzazione
- Implementa ProfileContract da Xot

**Dipendenze:** Xot (BaseModel, ProfileContract)

### 🎨 UI - Componenti Frontend
**Funzionalità:** Componenti frontend, temi e styling
**Dipendenze:** Xot

### 📁 Media - Gestione File
**Funzionalità:** Upload, gestione e ottimizzazione file
**Dipendenze:** Xot

### 🔔 Notify - Sistema Notifiche
**Funzionalità:** Notifiche email, SMS, Telegram
**Dipendenze:** Xot

### 🌐 Lang - Supporto Multilingua
**Funzionalità:** Traduzioni e localizzazione
**Dipendenze:** Xot

## Struttura dei Moduli

Ogni modulo segue questa struttura standard:
```
ModuleName/
├── app/
│   ├── Actions/           # Logica business riutilizzabile
│   ├── Contracts/         # Interfacce
│   ├── Datas/            # DTO e strutture dati
│   ├── Models/           # Modelli Eloquent
│   ├── Providers/        # Service Providers
│   └── ...
├── database/
│   ├── factories/        # Factory per i modelli
│   ├── migrations/       # Migrazioni database
│   └── seeders/         # Data seeders
├── resources/
│   ├── views/           # Template Blade
│   └── lang/            # File di traduzione
├── routes/              # Route web e API
├── tests/               # Test suite
└── config/              # Configurazione modulo
```

## Tecnologie e Stack

- **PHP 8.2+** con Laravel 12
- **Filament PHP** per admin panels
- **Livewire 3** con Flux e Volt
- **Vite** per asset building
- **Tailwind CSS 4** per styling
- **MySQL/PostgreSQL/SQLite** database
- **Redis** per caching e code

## Workflow di Sviluppo

1. **Analisi PHPStan**: Esecuzione analisi statiche (livelli 1-10)
2. **Correzione Batch**: Correzione gruppi di errori simili
3. **Documentazione**: Aggiornamento documentazione modulo-specifica
4. **Testing**: Verifica funzionalità e test
5. **Commit**: Commit atomici per gruppi di correzioni

## Convenzioni di Codice

- PHPStan livello 9 con configurazione personalizzata
- Laravel Pint per formattazione codice PHP
- ESLint e Prettier per JavaScript
- SQLite in-memory per testing
- Commit messages chiari e descrittivi

## File di Configurazione Importanti

- `config/modules.php` - Configurazione moduli e path
- `modules_statuses.json` - Moduli abilitati/disabilitati
- `phpstan.neon` - Configurazione PHPStan
- `phpunit.xml` - Configurazione PHPUnit
- `vite.config.js` - Configurazione Vite

Questa architettura modulare permette uno sviluppo scalabile e mantenibile, con il modulo Xot come foundation solida per tutte le funzionalità del sistema.