# Modulo User - Documentazione

## Panoramica

Il modulo User gestisce il sistema completo di autenticazione, autorizzazione e gestione utenti per l'applicazione Laraxot PTVX. Implementa un'architettura multi-tipo con supporto per team, tenant e ruoli avanzati.

## Business Logic

### Sistema Multi-Tipo Utenti
Il modulo supporta diversi tipi di utenti con logiche specifiche:
- **Doctor**: Professionisti sanitari con specializzazioni
- **Patient**: Utenti del sistema sanitario
- **Admin**: Amministratori con permessi granulari

### Autenticazione Avanzata
- Autenticazione multi-tipo con validazione specifica
- Sistema di ruoli e permessi basato su Spatie Laravel Permission
- Gestione team e collaborazioni
- Supporto multi-tenant per isolamento studi medici

## Componenti Principali

### Modelli
- **User**: Modello base con Single Table Inheritance (STI)
- **Team**: Gestione team di lavoro
- **Tenant**: Supporto multi-tenancy

### Filament Resources
- **UserResource**: CRUD completo utenti
- **RoleResource**: Gestione ruoli e permessi
- **TeamResource**: Gestione team
- **TenantResource**: Gestione tenant

### Widget e Pagine
- **LoginWidget**: Form di login multi-tipo
- **UserStatsWidget**: Statistiche utenti
- **SecurityAlertsWidget**: Allerte sicurezza
- **EditProfile**: Pagina modifica profilo utente
- **PasswordResetConfirmWidget**: Widget conferma reset password

## 🔧 Correzioni Recenti (2025-11-04)

### Merge Conflicts Risolti
- ✅ **EditProfile.php**: Rimossi marker Git (`=======`, `>>>>>>>`)
- ✅ **PasswordResetConfirmWidget.php**: 
  - Rimossi 10 import duplicati
  - Corrette 5 proprietà duplicate
  - Fixato metodo `confirmPasswordReset()` con if duplicati
  - Corretta logica auto-login dopo reset password

### Pattern Corretti
```php
// ❌ PRIMA (merge conflict)
if ($this->currentState !== 'form') {
if ('form' !== $this->currentState) {
    return;
}

// ✅ DOPO
if ($this->currentState !== 'form') {
    return;
}
```

### File Locking Applicato
Tutti i file del modulo User ora seguono il **File Locking Pattern**:
- Prima di modificare: `touch file.php.lock`
- Se lock esiste: SKIPPA
- Dopo modifica: `rm file.php.lock`

**Riferimento:** [File Locking Pattern](../../Xot/docs/file-locking-pattern.md)

## Architettura Tecnica

### Pattern Implementati
- **Single Table Inheritance**: Per tipi utente diversi
- **Repository Pattern**: Per accesso dati
- **Service Layer**: Per logica business
- **Event-Driven**: Per notifiche e audit

### Integrazione con Altri Moduli
- **Activity**: Tracciamento completo modifiche
- **Lang**: Sistema traduzioni completo
- **Xot**: Estensione classi base

## Configurazione

### File di Configurazione
- `config/user.php`: Configurazioni principali
- Variabili ambiente per sicurezza e performance

### Traduzioni
Struttura completa in:
- `lang/it/`: Italiano (principale)
- `lang/en/`: Inglese
- `lang/de/`: Tedesco

## Testing

### Test Coverage
- Unit test per logica business
- Feature test per flussi completi
- Test autenticazione e autorizzazione

### Comandi Test
```bash
php artisan test --filter=User
php artisan test --filter=AuthenticationTest
php artisan test --filter=RolePermissionTest
```

## Collegamenti

### Documentazione Interna
- [Troubleshooting Login Component](./troubleshooting-login-component.md)
- [Filament Filters and Widgets](./filament-filters-and-widgets.md)

### Documentazione Moduli Correlati
- [Modulo Xot Service Provider Architecture](../xot/docs/service-provider-architecture.md)
- [Modulo Lang Translation System](../lang/docs/README.md)

### Documentazione Esterna
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Multi-Tenancy](https://tenancyforlaravel.com/)

*Ultimo aggiornamento: Sistema di documentazione automatica*

