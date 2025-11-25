# Correzioni PHPStan nel Modulo User

## Team.php
### Problema 1: Metodo Mancante
Il modello `Team` implementava l'interfaccia `TeamContract` ma mancava l'implementazione del metodo `addUser`.

### Soluzione 1
È stato aggiunto il metodo `addUser` che permette di aggiungere un utente al team con un ruolo specifico.

### Problema 2: Incompatibilità di Metodi
Sono stati rilevati problemi di compatibilità tra i metodi del modello `Team` e quelli definiti nell'interfaccia `TeamContract`:
- `hasUser()`
- `addUser()`
- `removeUser()`
- `userHasPermission()`
- `getPermissionsFor()`

### Soluzione 2
È necessario allineare le firme dei metodi con quelle definite nell'interfaccia. Le modifiche richieste sono:
1. Utilizzare solo i metodi garantiti dalle interfacce `UserContract` e `ModelContract`
2. Assicurarsi che i tipi di ritorno corrispondano esattamente
3. Assicurarsi che i parametri corrispondano esattamente

### Problema 3: Accesso alle Proprietà
Il modello `Team` accede direttamente a proprietà che potrebbero non essere disponibili attraverso l'interfaccia `UserContract`.

### Soluzione 3
È necessario:
1. Utilizzare il metodo `getKey()` invece di accedere direttamente a `id`
2. Utilizzare i metodi delle relazioni invece di accedere direttamente alle proprietà
3. Implementare controlli di tipo più robusti

### Collegamenti Bidirezionali
- [Documentazione Generale PHPStan](/docs/phpstan/PHPSTAN_LEVEL10_LINEE_GUIDA.md)
- [Contratti del Modulo User](/docs/modules/user/contracts.md)
- [Best Practices per i Modelli](/docs/modules/user/models.md)
- [Interfacce e Contratti](/docs/modules/xot/contracts.md) 

## Collegamenti tra versioni di phpstan_fixes.md
* [phpstan_fixes.md](../../../Xot/docs/phpstan_fixes.md)
* [phpstan_fixes.md](../../../User/docs/phpstan_fixes.md)
* [phpstan_fixes.md](../../../User/docs/fixes/phpstan_fixes.md)
* [phpstan_fixes.md](../../../Activity/docs/phpstan_fixes.md)

---

## 17 Novembre 2025 — Allineamento Factory e Trait Profilo

### 1. `Permission::newFactory()` compatibile con `BaseModel`
- **File**: `Modules/User/app/Models/Permission.php`
- **Errore PHPStan**: override diretto di `factory()` generava conflitto con `BaseModel::factory($count = null, $state = [])`
- **Fix**: eliminato l'override di `factory()` e implementato `protected static function newFactory(): PermissionFactory`, mantenendo la risoluzione personalizzata senza toccare la firma pubblica del trait `HasFactory`.

### 2. `BaseUser` vs `UserContract`
- **Files**: `Modules/User/app/Models/BaseUser.php`
- **Problemi risolti**:
  1. `createToken()` ora espone la firma prevista dal contratto ma la responsabilità del tipo degli argomenti è demandata all'interfaccia aggiornata (`$name` non tipizzato), evitando conflitti con `HasApiTokens` e mantenendo il ritorno `PersonalAccessTokenResult`. Il metodo del trait è stato aliasato come `passportCreateToken`.
  2. `removeRole()` ora implementa la firma `Spatie\Permission\Contracts\Role|string|int` e restituisce `static`, come richiesto dal contratto. Il metodo del trait Spatie viene richiamato tramite alias (`spatieRemoveRole`).

### 3. Hardening di `IsProfileTrait`
- **File**: `Modules/User/app/Models/Traits/IsProfileTrait.php`
- **Fix principali**:
  - Accesso sicuro agli attributi dell'utente tramite `getAttribute()` con controlli di tipo espliciti (`Assert::isInstanceOf($user, User::class)`).
  - Gli accessor `getFullNameAttribute`, `getFirstNameAttribute`, `getLastNameAttribute`, `userName()` e il toggle dei ruoli lavorano ora solo con stringhe valide, prevenendo gli `property.notFound` e `return.type` individuati da PHPStan.

### Business Logic
Queste correzioni garantiscono che:
- le factory dei modelli User rispettino il contratto comune definito da `XotBaseModel`;
- il contratto `UserContract` rimanga la single source of truth per API token e gestione ruoli;
- i profili utente possano recuperare i dati dell'utente associato senza violare l'encapsulamento di Eloquent.

### Collegamenti
- [BaseUser Refactoring](./baseuser-refactoring-completed.md)
- [Contratti User](../contracts/user-contract.md)
- [Linee Guida PHPStan Level 10](../../../Xot/docs/phpstan-contract-conflicts-resolution.md)

