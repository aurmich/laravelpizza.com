# Regole Critiche per Laravel Pizza Meetups

## ⚠️ REGOLE FONDAMENTALI - LEGGERE SEMPRE

### 1. ARCHITETTURA FRONTEND (CRITICAL!)

**NO Controller. NO Routes in web.php. NO Routes in api.php.**

**USARE SOLO:**
- ✅ **Laravel Folio** - File-based routing
- ✅ **Livewire Volt** - Single-file components
- ✅ **Filament** - Admin panel

**Struttura Corretta:**
```
Modules/Meetup/resources/views/pages/
├── index.blade.php              → route('/')
├── events/
│   ├── index.blade.php          → route('events.index')
│   ├── [event:slug].blade.php   → route('events.show', $slug)
│   └── create.blade.php         → route('events.create')
├── dashboard.blade.php          → route('dashboard')
└── profile/
    ├── [user:id].blade.php      → route('profile.show', $id)
    └── edit.blade.php           → route('profile.edit')
```

**Esempio Volt Component:**
```php
<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed};

name('events.index');

state(['search' => '', 'category' => null]);

$events = computed(function () {
    return Event::query()
        ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
        ->when($this->category, fn($q) => $q->where('category_id', $this->category))
        ->upcoming()
        ->paginate(12);
});

?>

<x-app-layout>
    @volt('events.index')
    <div>
        <input wire:model.live="search" type="search" placeholder="Search...">
        
        @foreach($this->events as $event)
            <livewire:event-card :event="$event" :key="$event->id" />
        @endforeach
    </div>
    @endvolt
</x-app-layout>
```

**❌ MAI FARE:**
```php
// ❌ NO Controller
class EventController extends Controller { }

// ❌ NO Routes in web.php
Route::get('/events', [EventController::class, 'index']);

// ❌ NO Routes in api.php  
Route::apiResource('events', EventApiController::class);
```

### 2. PRINCIPI ARCHITETTURALI (SEMPRE!)

**DRY** (Don't Repeat Yourself)
- Non duplicare codice
- Usa Actions, Services, Traits

**KISS** (Keep It Simple, Stupid)
- Soluzioni semplici > complesse
- Evita over-engineering

**SOLID**
- Single Responsibility
- Open/Closed
- Liskov Substitution
- Interface Segregation
- Dependency Inversion

**Robust**
- Gestione errori
- Validazione input
- Type safety (PHP 8.2+)
- PHPStan Level 10

**Laraxot Patterns**
- Modular architecture (nwidart/laravel-modules)
- Action pattern (Spatie)
- Base classes inheritance
- Event Sourcing

### 3. NAMING CONVENTIONS FILES .md

**✅ CORRETTO:**
```
README.md                    ← Maiuscolo OK
CHANGELOG.md                 ← Maiuscolo OK
project-purpose.md           ← lowercase con trattini
complete-roadmap-2025.md     ← lowercase con trattini
api-endpoints.md             ← lowercase
```

**❌ SBAGLIATO:**
```
PROJECT-PURPOSE.md           ← NO maiuscole
ERROR-ANALYSIS.md            ← NO maiuscole
COMPLETE-ROADMAP-2025.md     ← NO maiuscole
API-Endpoints.md             ← NO CamelCase
```

**Eccezioni UNICHE:**
- `README.md` - Standard universale
- `CHANGELOG.md` - Standard universale

### 4. ORGANIZZAZIONE DOCUMENTAZIONE

**✅ File .md vanno SOLO in cartelle docs/ ESISTENTI:**
```
Modules/Meetup/docs/          ← Usa questa
Themes/Meetup/docs/           ← Usa questa
```

**❌ NON creare nuove cartelle docs/:**
```
Modules/Meetup/docs/new-folder/  ← NO!
Modules/Meetup/documentation/    ← NO!
```

### 5. SCOPO PROGETTO (DA RICORDARE!)

**Laravel Pizza Meetups è:**
- ✅ Piattaforma community per sviluppatori Laravel
- ✅ Sistema gestione eventi/meetup tech
- ✅ Chat community + profili utente
- ✅ "Pizza" = metafora per meetup

**Laravel Pizza Meetups NON è:**
- ❌ Pizzeria online
- ❌ E-commerce food delivery
- ❌ Sito per ordinare pizza
- ❌ Menu digitale ristorante

**IMPORTANTE**: Se vedi codice che sembra un sistema di vendita pizza, è SBAGLIATO!

### 6. FOLIO + VOLT: BEST PRACTICES

**Resources da studiare:**
- [Nuno Maduro Todo App](https://nunomaduro.com/todo_application_with_laravel_folio_and_volt)
- [Genesis Starter Kit](https://github.com/thedevdojo/genesis)
- [Dummy Store Example](https://github.com/benjamincrozat/dummy-store)
- [Jason Beggs Podcast Player](https://jasonlbeggs.com/blog/livewire-volt-and-folio)
- [Multi-Step Form Tutorial](https://neon.com/guides/laravel-volt-folio-multi-step-form)

**Pattern da seguire:**
```php
// ✅ Folio page con Volt
<?php
use function Laravel\Folio\{name, middleware};
use function Livewire\Volt\{state, mount, computed};

name('dashboard');
middleware(['auth']);

state(['user' => fn() => auth()->user()]);

$stats = computed(function () {
    return [
        'events' => $this->user->registrations()->count(),
        'messages' => $this->user->messages()->count(),
    ];
});

?>

<x-app-layout>
    @volt('dashboard')
    <div>
        <h1>Welcome {{ $user->name }}</h1>
        <div>Events: {{ $this->stats['events'] }}</div>
    </div>
    @endvolt
</x-app-layout>
```

### 7. FILAMENT ADMIN (Backend Only!)

**✅ Filament è per ADMIN:**
```
app/Filament/
├── Resources/
│   ├── EventResource.php
│   └── UserResource.php
├── Widgets/
│   └── EventsOverview.php
└── Pages/
    └── Dashboard.php
```

**Frontend pubblico = FOLIO + VOLT**

### 8. DATABASE & MODELS

**Sempre:**
- Migrations con timestamps
- Soft deletes dove appropriato
- Foreign keys con cascade
- Indexes per performance
- UUIDs per public IDs

**Models:**
```php
use HasUuids, SoftDeletes, HasFactory;

protected $fillable = [...];
protected $casts = [...];
protected $hidden = ['password'];
protected $appends = ['full_name'];
```

### 9. ACTIONS PATTERN

**Spatie Actions per business logic:**
```php
// app/Actions/Event/CreateEventAction.php
class CreateEventAction
{
    public function execute(array $data): Event
    {
        return DB::transaction(function () use ($data) {
            $event = Event::create($data);
            
            activity('event')
                ->performedOn($event)
                ->causedBy(auth()->user())
                ->log('Event created');
                
            return $event;
        });
    }
}

// Uso in Volt:
$createEvent = function() {
    $event = app(CreateEventAction::class)->execute($this->form);
    $this->redirect(route('events.show', $event));
};
```

### 10. TESTING

**Obbligatorio:**
- PHPStan Level 10
- Laravel Pint (PSR-12)
- Feature tests per user flows
- Unit tests per Actions
- Coverage > 70%

```bash
./vendor/bin/phpstan analyze
./vendor/bin/pint
php artisan test --parallel
```

---

## Quick Reference

**Quando creo una nuova pagina:**
1. ✅ Crea file in `resources/views/pages/`
2. ✅ Usa Folio naming convention
3. ✅ Aggiungi `@volt` directive se serve stato
4. ❌ NON creare Controller
5. ❌ NON aggiungere rotte in web.php

**Quando creo documentazione:**
1. ✅ Usa cartelle docs/ esistenti
2. ✅ Nome file lowercase (tranne README.md, CHANGELOG.md)
3. ✅ Usa trattini, non underscore
4. ❌ NON creare nuove cartelle docs/

**Quando scrivo codice:**
1. ✅ DRY + KISS + SOLID
2. ✅ Type hints ovunque
3. ✅ PHPStan Level 10 compliant
4. ✅ Action pattern per business logic
5. ❌ NO query in views (usa computed)

---

**Version**: 1.0
**Last Updated**: 28 Novembre 2025
**Status**: 🔒 CRITICAL RULES - ALWAYS FOLLOW
