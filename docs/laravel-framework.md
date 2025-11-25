# Laravel Framework

## Introduzione

Laravel è un framework PHP moderno e potente che fornisce una base solida per lo sviluppo di applicazioni web. Nel contesto del progetto Laraxot, Laravel viene utilizzato come framework principale, con particolare attenzione alla compatibilità con PHPStan livello 9.

## Caratteristiche Principali

### 1. Architettura MVC
- **Model**: Gestione dei dati e logica di business
- **View**: Presentazione dei dati all'utente
- **Controller**: Logica di controllo e coordinamento

### 2. Eloquent ORM
- Mappatura oggetto-relazionale intuitiva
- Relazioni tra modelli
- Query builder fluente
- Migrazioni database

### 3. Sistema di Routing
- Routing dichiarativo
- Middleware per la gestione delle richieste
- Route model binding
- Route groups e middleware groups

### 4. Sistema di Autenticazione
- Autenticazione utenti
- Autorizzazione e permessi
- Middleware di protezione
- Gestione sessioni

## Integrazione con Laraxot

### Struttura Modulare
Laravel viene esteso attraverso il sistema modulare di Laraxot:

```
Modules/
├── Xot/           # Core framework
├── User/          # Gestione utenti
├── UI/            # Componenti UI
└── [Altri moduli] # Moduli specifici
```

### Service Providers
Ogni modulo estende `XotBaseServiceProvider`:

```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Providers;

use Modules\Xot\Providers\XotBaseServiceProvider;

class NomeModuloServiceProvider extends XotBaseServiceProvider
{
    public string $name = 'NomeModulo';
    protected string $module_dir = __DIR__;
    protected string $module_ns = __NAMESPACE__;
}
```

### Namespace e Autoloading
- Namespace senza segmento `app`
- Autoloading PSR-4
- Struttura directory coerente

## Best Practices per PHPStan Livello 9

### 1. Tipizzazione Rigorosa
```php
/**
 * @var list<string>
 */
protected $fillable = ['name', 'email'];

/**
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
```

### 2. Relazioni Eloquent
```php
/**
 * @return BelongsTo<User, static>
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

/**
 * @return HasMany<Post, static>
 */
public function posts(): HasMany
{
    return $this->hasMany(Post::class);
}
```

### 3. Gestione Errori
```php
/**
 * @return string
 */
public function getName(): string
{
    $name = $this->name;
    if ($name === null) {
        throw new \RuntimeException('Name is required');
    }
    return $name;
}
```

## Componenti Filament

### Resources
Estendere sempre `XotBaseResource`:

```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Filament\Resources;

use Modules\Xot\Filament\Resources\XotBaseResource;

class NomeResource extends XotBaseResource
{
    protected static ?string $model = NomeModel::class;
    
    public static function getFormSchema(): array
    {
        return [
            // Schema del form
        ];
    }
}
```

### Pages
Estendere sempre le classi XotBase:

```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Filament\Resources\NomeResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateNome extends XotBaseCreateRecord
{
    protected static string $resource = NomeResource::class;
}
```

## Data Objects e Actions

### Spatie Laravel Data
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Datas;

use Spatie\LaravelData\Data;

class NomeData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?int $id = null,
    ) {
    }
}
```

### Spatie QueueableActions
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Actions;

use Modules\NomeModulo\Datas\NomeData;
use Spatie\QueueableAction\QueueableAction;

class CreateNomeAction
{
    use QueueableAction;
    
    public function execute(NomeData $data): NomeModel
    {
        return NomeModel::create($data->toArray());
    }
}
```

## Testing

### Struttura Test
```
tests/
├── Feature/        # Test di integrazione
├── Unit/          # Test unitari
└── TestCase.php   # Classe base
```

### Esempio Test
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Tests\Feature;

use Tests\TestCase;
use Modules\NomeModulo\Models\NomeModel;

class NomeModelTest extends TestCase
{
    public function test_can_create_model(): void
    {
        $model = NomeModel::factory()->create([
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);
        
        $this->assertInstanceOf(NomeModel::class, $model);
        $this->assertEquals('Test Name', $model->name);
    }
}
```

## Configurazione

### File di Configurazione
```php
<?php

declare(strict_types=1);

return [
    'name' => env('APP_NAME', 'Laraxot'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
];
```

### Environment Variables
```env
APP_NAME=Laraxot
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraxot
DB_USERNAME=root
DB_PASSWORD=
```

## Middleware

### Middleware Personalizzati
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NomeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Logica del middleware
        
        return $next($request);
    }
}
```

### Registrazione Middleware
```php
// In Kernel.php
protected $middlewareGroups = [
    'web' => [
        // Middleware web
    ],
    'api' => [
        // Middleware API
    ],
];
```

## Eventi e Listener

### Eventi
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NomeEvent
{
    use Dispatchable, SerializesModels;
    
    public function __construct(
        public mixed $data
    ) {
    }
}
```

### Listener
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Listeners;

use Modules\NomeModulo\Events\NomeEvent;

class NomeListener
{
    public function handle(NomeEvent $event): void
    {
        // Logica del listener
    }
}
```

## Jobs e Queue

### Job
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NomeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(
        public mixed $data
    ) {
    }
    
    public function handle(): void
    {
        // Logica del job
    }
}
```

## Notifiche

### Notifica
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NomeNotification extends Notification
{
    use Queueable;
    
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nome Notifica')
            ->line('Contenuto della notifica');
    }
}
```

## Validazione

### Form Request
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NomeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }
}
```

## Cache

### Cache Tags
```php
use Illuminate\Support\Facades\Cache;

// Memorizza con tag
Cache::tags(['users', 'profiles'])->put('user.1', $user, 3600);

// Pulisce per tag
Cache::tags(['users'])->flush();
```

## Logging

### Log Personalizzati
```php
use Illuminate\Support\Facades\Log;

Log::channel('custom')->info('Messaggio personalizzato', [
    'user_id' => 1,
    'action' => 'login',
]);
```

## File Storage

### Storage Disks
```php
use Illuminate\Support\Facades\Storage;

// Salva file
Storage::disk('public')->put('file.txt', $content);

// Recupera file
$content = Storage::disk('public')->get('file.txt');
```

## Database

### Migrazioni
```php
<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class extends XotBaseMigration
{
    public function up(): void
    {
        if ($this->hasTable('nome_tabella')) {
            return;
        }
        
        Schema::create('nome_tabella', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
};
```

### Seeders
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\NomeModulo\Models\NomeModel;

class NomeSeeder extends Seeder
{
    public function run(): void
    {
        NomeModel::factory(10)->create();
    }
}
```

## API Resources

### Resource
```php
<?php

declare(strict_types=1);

namespace Modules\NomeModulo\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
        ];
    }
}
```

## Rate Limiting

### Rate Limiter
```php
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('api', function (Request $request) {
    return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
});
```

## Task Scheduling

### Console Kernel
```php
protected function schedule(Schedule $schedule): void
{
    $schedule->command('inspire')->hourly();
    $schedule->job(new NomeJob)->daily();
}
```

## Performance

### Query Optimization
```php
// Eager loading
$users = User::with('posts')->get();

// Query specifiche
$users = User::select('id', 'name')->get();

// Chunking per grandi dataset
User::chunk(100, function ($users) {
    foreach ($users as $user) {
        // Processa utente
    }
});
```

### Caching
```php
// Cache di query
$users = Cache::remember('users', 3600, function () {
    return User::all();
});
```

## Sicurezza

### CSRF Protection
```php
// In Blade templates
@csrf

// In form requests
public function rules(): array
{
    return [
        '_token' => ['required'],
    ];
}
```

### XSS Protection
```php
// Escape automatico in Blade
{{ $user->name }}

// Escape manuale
{!! e($user->name) !!}
```

## Debugging

### Debug Bar
```php
use Barryvdh\Debugbar\Facades\Debugbar;

Debugbar::info('Informazione di debug');
Debugbar::error('Errore di debug');
```

### Logging
```php
use Illuminate\Support\Facades\Log;

Log::debug('Messaggio di debug', ['data' => $data]);
Log::info('Messaggio informativo');
Log::warning('Messaggio di avvertimento');
Log::error('Messaggio di errore');
```

## Best Practices

### 1. Struttura del Codice
- Usare `declare(strict_types=1);`
- Tipizzazione rigorosa
- Documentazione PHPDoc completa
- Seguire PSR-12

### 2. Performance
- Eager loading per relazioni
- Caching per query costose
- Chunking per grandi dataset
- Ottimizzazione delle query

### 3. Sicurezza
- Validazione input
- Sanitizzazione output
- Protezione CSRF
- Gestione sicura delle password

### 4. Testing
- Test unitari per logica di business
- Test di integrazione per API
- Test di feature per UI
- Coverage del codice

### 5. Manutenibilità
- Codice pulito e leggibile
- Separazione delle responsabilità
- Uso di design patterns
- Documentazione aggiornata

---

**Data Creazione**: 27 Gennaio 2025  
**Stato**: Consolidato da docs/ root  
**Priorità**: ALTA (Framework principale)
