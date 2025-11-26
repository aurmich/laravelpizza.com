# Assistente AI - Documentazione Base PTVX

## Caratteristiche Principali
- Basato su Claude 3.5 Sonnet
- Comunicazione primaria in italiano
- Specializzato in programmazione Laravel/PHP
- Formattazione risposte in markdown
- Ubicazione progetto: F:\var\www\_bases\base_ptvx\

## Capacità
- Analisi e modifica di codice esistente
- Creazione di nuovi file e componenti
- Gestione della documentazione
- Supporto multilingua (default: italiano)
- Implementazione best practices Laravel/Filament
- Integrazione con Spatie packages
- Debug e risoluzione problemi
- Refactoring del codice

## Struttura del Progetto
### Directory Principali
- /docs - Documentazione del progetto
- /laravel - Applicazione Laravel
  - /app - Core dell'applicazione
  - /Modules - Moduli Laravel
    - Ogni modulo segue la struttura standard Laravel
  - /config - Configurazioni
  - /resources - Assets e views
  - /routes - Definizioni delle rotte

## Best Practices
### Architettura
- Utilizzo di Spatie Laravel Data per Data Transfer Objects
- Preferenza per Spatie QueueableActions invece dei Services
- Aderenza alla filosofia Laravel con Laraxot
- Modularizzazione del codice attraverso Laravel Modules

### Filament Framework
- Estensione di XotBaseResource per le risorse
- Implementazione corretta dei form schema
- Gestione standardizzata delle liste e delle tabelle
- Routing consistente nelle pagine Filament

### Gestione del Codice
- Mantenimento del codice storico (commentato)
- Versionamento dei file (.old)
- Tipizzazione stretta del codice
- Documentazione inline in italiano

## Gestione Documentazione
### Struttura Docs
- /docs
  - project_notes.md - Note tecniche e best practices
  - assistant.md - Documentazione dell'assistente
  - getting-started/ - Guide di installazione e setup

### Principi di Documentazione
- Aggiornamento continuo e incrementale
- Mantenimento della coerenza con il codice
- Documentazione bilingue quando necessario
- Esempi di codice pratici e testati

## Convenzioni di Codice
### Naming
- CamelCase per le classi
- snake_case per le variabili e i metodi
- UPPERCASE per le costanti
- Prefisso "Xot" per le classi base del framework

### File Structure
- Un concetto per file
- Namespace allineati con la struttura delle directory
- Separazione chiara tra interfacce e implementazioni
- Organizzazione modulare del codice

## Workflow di Sviluppo
1. Analisi dei requisiti
2. Verifica della documentazione esistente
3. Implementazione seguendo le best practices
4. Testing e validazione
5. Aggiornamento della documentazione
6. Commit e versionamento

## Troubleshooting
- Consultare /docs/errors.txt per errori comuni
- Verificare i log in storage/logs
- Utilizzare il debugger di Laravel
- Controllare la configurazione dei moduli

## Sicurezza
- Validazione input attraverso Form Requests
- Sanitizzazione output
- Gestione corretta delle autorizzazioni
- Implementazione dei middleware di sicurezza

## Performance
- Utilizzo di cache quando appropriato
- Ottimizzazione delle query database
- Lazy loading delle relazioni
- Minimizzazione degli assets

## Manutenzione
- Backup regolare dei dati
- Aggiornamento delle dipendenze
- Pulizia dei file temporanei
- Monitoraggio dei log
