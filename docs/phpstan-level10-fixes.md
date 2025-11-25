# Correzioni PHPStan Livello 10 - Modulo User

Questo documento traccia gli errori PHPStan di livello 10 identificati nel modulo User e le relative soluzioni implementate.

## Stato Aggiornato (18 novembre 2025)

| Aspetto | Dettagli |
| --- | --- |
| Comando eseguito | `./vendor/bin/phpstan analyse Modules/User --level=10` |
| Esito | ✅ **Nessun errore** |
| Note | L'analisi completa del modulo User passa al livello 10 senza necessità di ulteriori fix. Manteniamo comunque questa pagina come registro delle correzioni effettuate e delle future regressioni da monitorare. Per allineare il presentation layer, monitorare anche le [linee guida PHPStan del tema Zero](../../../Themes/Zero/docs/phpstan-dry-kiss-theme-guidelines.md). |

### Azioni consigliate

1. Continuare a rieseguire PHPStan livello 10 dopo ogni refactor sostanziale del modulo.
2. Riutilizzare i pattern documentati sotto in caso di regressioni.
3. Collegare da altri moduli eventuali dipendenze verso i servizi User per tracciare gli impatti.

## Errori Identificati e Correzioni Effettuate

### 1. Uso del tipo mixed in CheckOtpExpiredRule.php

```php
public function validate(string $attribute, mixed $value, \Closure $fail): void
```

**Problema**: Utilizzo del tipo `mixed` senza ulteriori specifiche sul tipo effettivo del valore. Inoltre, il metodo `message()` non aveva un tipo di ritorno esplicito.

**Soluzione**:
1. Aggiunta di documentazione PHPDoc per specificare che `$value` è un `string|int`:
   ```php
   /**
    * @param string $attribute L'attributo che viene validato
    * @param string|int $value Il valore dell'attributo
    * @param \Closure(string): void $fail La closure da chiamare in caso di fallimento
    */
   public function validate(string $attribute, mixed $value, \Closure $fail): void
   ```

2. Aggiunto tipo di ritorno esplicito per il metodo `message()`:
   ```php
   /**
    * @return string Il messaggio di errore
    */
   public function message(): string
   ```

### 2. Problemi di tipizzazione in ModelContract.php

**Problema**: Mancanza di annotazioni PHPDoc complete per i parametri e valori di ritorno dei metodi dell'interfaccia.

**Soluzione**:
1. Aggiunta di annotazioni PHPDoc complete per tutti i metodi:
   ```php
   /**
    * Fill the model with an array of attributes. Force mass assignment.
    *
    * @param array<string, mixed> $attributes Gli attributi da assegnare al modello
    * @return static Il modello stesso
    */
   public function forceFill(array $attributes);
   ```

2. Specificazione corretta dei tipi di array:
   ```php
   /**
    * Convert the model instance to an array.
    *
    * @return array<string, mixed> Il modello convertito in array
    */
   public function toArray();
   ```

3. Miglioramento della documentazione generale dell'interfaccia:
   ```php
   /**
    * Interfaccia ModelContract che deve essere implementata dai modelli.
    *
    * @phpstan-require-extends Model
    *
    * @mixin \Eloquent
    */
   interface ModelContract
   ```

### 3. Miglioramenti in PasswordData.php

**Problema**: Mancanza di annotazioni PHPDoc per metodi e proprietà, e utilizzo implicito di tipi mixed.

**Soluzione**:
1. Aggiunta di annotazioni PHPDoc complete per tutti i metodi:
   ```php
   /**
    * Crea un'istanza della classe PasswordData.
    *
    * @return self
    */
   public static function make(): self
   ```

2. Specificazione corretta dei tipi di array e parametri:
   ```php
   /**
    * Converte l'oggetto in un array.
    *
    * @return array<string, int|bool|string|null>
    */
   public function toArray(): array
   ```

3. Aggiunta di annotazioni di tipo per variabili locali:
   ```php
   /** @var array<string, mixed> $data */
   $data = TenantService::getConfig('password');
   ```

### 4. Correzioni in Filament/Pages/Password.php

**Problema**: Mancanza di annotazioni PHPDoc per metodi e proprietà, e utilizzo di tipi non specifici.

**Soluzione**:
1. Aggiunta di annotazioni PHPDoc complete per tutti i metodi e proprietà:
   ```php
   /**
    * Dati del form per la gestione delle password.
    *
    * @var array<string, mixed>|null
    */
   public ?array $formData = [];
   ```

2. Specificazione corretta dei tipi per parametri e valori di ritorno:
   ```php
   /**
    * Restituisce le azioni per il form di aggiornamento.
    *
    * @return array<Action>
    */
   protected function getUpdateFormActions(): array
   ```

3. Aggiunta di annotazioni di tipo per variabili locali:
   ```php
   /** @var array<string, mixed> $data */
   $data = $this->form->getState();
   ```

### 5. Miglioramenti in Http/Livewire/Auth/Login.php

**Problema**: Mancanza di annotazioni PHPDoc per metodi e proprietà, e utilizzo di tipi non specifici.

**Soluzione**:
1. Documentazione migliorata per la classe e le proprietà:
   ```php
   /**
    * Componente Livewire per la gestione del login.
    *
    * @property ComponentContainer $form
    */
   class Login extends Component implements HasForms
   ```

2. Specificazione corretta dei tipi per proprietà:
   ```php
   /**
    * Regole di validazione.
    *
    * @var array<string, array<string|object>>
    */
   protected $rules = [
       'email' => ['required', 'email'],
       'password' => ['required'],
       'remember' => ['boolean'],
   ];
   ```

3. Tipizzazione esplicita dei valori di ritorno e annotazioni per variabili:
   ```php
   /**
    * Esegue l'autenticazione dell'utente.
    *
    * @return RedirectResponse|void
    */
   public function authenticate()
   {
       /** @var array{email: string, password: string, remember?: bool} $data */
       $data = $this->validate();
   ```

### 6. Metodo `authentications()` non trovato in Listeners

**Problema**: I Listener come `FailedLoginListener`, `LoginListener`, `LogoutListener`, e `OtherDeviceLogoutListener` tentano di richiamare il metodo `authentications()` su un oggetto di tipo `Illuminate\Contracts\Auth\Authenticatable`, ma questo metodo non è definito nell'interfaccia `Authenticatable`.

```php
// In FailedLoginListener.php
$log = $event->user->authentications()->create([...]);
```

**Soluzione**:
1. Creazione di un'interfaccia `HasAuthentications` che definisce il metodo `authentications()` e la relazione tra User e Authentication:

```php
namespace Modules\User\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasAuthentications
{
    /**
     * Ottiene tutti i log di autenticazione associati all'utente.
     *
     * @return MorphMany
     */
    public function authentications(): MorphMany;
}
```

2. Assicurarsi che il modello User implementi questa interfaccia:

```php
use Modules\User\Contracts\HasAuthentications;

class User extends BaseUser implements HasAuthentications
{
    // ...
}
```

3. Aggiunta di type casting nei Listener per verificare che l'utente implementi l'interfaccia `HasAuthentications`:

```php
public function handle(Failed $event): void
{
    if ($event->user instanceof HasAuthentications) {
        $ip = $this->request->ip();
        $userAgent = $this->request->userAgent();
        $location = [];

        $log = $event->user->authentications()->create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'login_at' => now(),
            'login_successful' => false,
            'location' => $location,
        ]);
    }
}
```

**Benefici**:
- Tipo corretto definito con un'interfaccia dedicata
- Controllo esplicito del tipo prima di chiamare il metodo
- Separazione delle responsabilità chiara tramite interfacce
- Evitato l'uso di `mixed` o suppression di errori

**Pattern applicato**: _Interface Segregation_ - Creazione di interfacce specifiche per comportamenti specifici, anziché interfacce generiche troppo ampie.

## Principi Applicati

1. **Specificazione dei tipi**: Evitato l'uso del tipo `mixed` quando possibile, o almeno documentato i tipi effettivi attraverso PHPDoc.
2. **Tipi di array specificati**: Utilizzata la notazione generica per specificare i tipi di chiavi e valori degli array.
3. **Tipi di ritorno espliciti**: Aggiunti tipi di ritorno espliciti per tutti i metodi.
4. **Documentazione migliorata**: Aggiunta documentazione PHPDoc completa per classi, proprietà e metodi.
5. **Annotazioni per variabili locali**: Utilizzate le annotazioni `@var` per specificare i tipi delle variabili locali quando PHPStan non può inferirli correttamente.

### 7. Correzioni in Filament Widgets e Relation Managers

**Problema**: Utilizzo di metodi su oggetti di tipo mixed senza type guards appropriati in:
- `TeamsRelationManager.php` - chiamate a `getOwnerRecord()` e accesso a proprietà
- `EditUserWidget.php` - chiamate dinamiche a factory e action methods
- `UsersChartWidget.php` - accesso a proprietà `$pageFilters` non definite

**Soluzione**:
1. **Type Guards per RelationManager**:
```php
// In TeamsRelationManager.php
$user = $livewire->getOwnerRecord();
if (! $user instanceof User) {
    return false; // o return; per void
}
```

2. **Type Guards per Widgets**:
```php
// In EditUserWidget.php
if (is_object($query) && method_exists($query, 'first')) {
    $user = $query->first();
    if ($user instanceof Model) {
        return $user;
    }
}
```

3. **Documentazione per Proprietà Magiche**:
```php
/**
 * PHPStan Level 10: Magic property from InteractsWithPageFilters trait
 * @property array<string, mixed>|null $pageFilters
 */
class UsersChartWidget extends ChartWidget
```

### 8. Correzioni in Database Seeders

**Problema**: Chiamata a metodo `create()` su factory di tipo mixed in `UserMassSeeder.php`.

**Soluzione**:
```php
// In UserMassSeeder.php
if (method_exists($profileFactory, 'create')) {
    $profileFactory->create([
        'user_id' => $user->id,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at,
    ]);
}
```

## Nuovi bloccanti rilevati (phpstan analyse Modules – 15 Nov 2025)

| File | Errore | Piano |
| --- | --- | --- |
| `app/Models/Permission.php` | `unexpected T_PUBLIC` e `:` → classe corrotta | Ripristinare dichiarazioni proprietà/relazioni seguendo `./roles-permissions.md` |
| `database/migrations/2023_01_01_000004_create_team_user_table.php` | `unexpected T_PROTECTED/T_PUBLIC` | Rimuovere metodi incollati da classe, riportare a migrazione standard (vedi `./database/migrations-guide.md`) |
| `database/migrations/2023_01_01_000006_create_teams_table.php` | come sopra | Idem |
| `database/migrations/2023_01_22_000007_create_permissions_table.php` | `}` extra | Chiudere classi correttamente |
| `database/migrations/2025_05_16_221811_add_owner_id_to_teams_table.php` | `}` extra | Verificare rollback |
| `database/seeders/UserMassSeeder.php` | Token `->` errati, metodi privati fuori classe | Ricostruire seeder coerente con `./database-population.md` |

### Workflow documentato
1. Creare lock sui file (`touch database/seeders/UserMassSeeder.php.lock`).
2. Confrontare con business logic in `./business-logic-analysis.md`.
3. Applicare fix rispettando `declare(strict_types=1);`, tipizzazione e pattern DRY.
4. Eseguire `./vendor/bin/phpstan analyse Modules/User --level=10`.
5. Annotare i fix in questo documento e nel `CHANGELOG.md` del modulo.

## Risultati Finali (aggiornamento)

- **Stato attuale**: ⚠️ **Non ancora compliant** – presenti 6 file con errori sintattici.
- **Obiettivo**: ripristinare struttura file, rieseguire PHPStan livello 10 entro sprint attuale.
- **Principi da applicare**: type hints rigorosi, DTO documentati, rispetto `Eloquent magic` (`isset()`).

## Considerazioni Future

1. Continua l'utilizzo di queste pratiche in tutto il modulo User e in altri moduli.
2. Considera l'uso di generics (come `@template`) per migliorare ulteriormente la tipizzazione delle classi che gestiscono diverse tipologie di dati.
3. Mantieni aggiornata la documentazione quando vengono modificati metodi o proprietà.
4. Utilizza strumenti di analisi automatica come PHPStan regolarmente per verificare che il codice rimanga conforme.

---

**Ultimo aggiornamento**: 2025-11-15
**Stato**: ⚠️ PHPStan Level 10 con bloccanti aperti
**Ultima esecuzione**: `./vendor/bin/phpstan analyse Modules --level=10` (output incluso nel report principale)