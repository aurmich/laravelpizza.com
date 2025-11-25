<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Pages;

use LogicException;
use Filament\Schemas\Schema;
use RuntimeException;
use Illuminate\Auth\Access\AuthorizationException;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page as FilamentPage;
<<<<<<< HEAD
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Xot\Actions\View\GetViewByClassAction;
use Modules\Xot\Filament\Traits\TransTrait;
use Webmozart\Assert\Assert;
=======
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\Authenticatable;
use Modules\Xot\Actions\View\GetViewByClassAction;
use Modules\Xot\Filament\Traits\TransTrait;
>>>>>>> f1d4085 (.)

/**
 * Classe base astratta per tutte le pagine Filament non legate a risorse specifiche.
 * Fornisce funzionalità comuni e standardizzate per la gestione delle pagine.
 *
 * Implementa:
 * - Sistema di traduzioni integrato
 * - Gestione autorizzazioni
 * - Integrazione con form
 * - Rilevamento intelligente modello
 * - Metodi helper comuni
 *
 * @property ?string              $model Il modello associato alla pagina
 * @property array<string, mixed> $data  I dati del form
 *
 * @see \Modules\Xot\docs\xotbasepage_implementation.md Documentazione completa
 */
abstract class XotBasePage extends FilamentPage implements HasForms
{
    use TransTrait;
    use InteractsWithForms;

<<<<<<< HEAD
=======
    
>>>>>>> f1d4085 (.)
    /**
     * Vista predefinita per la pagina.
     * Deve essere sovrascritta nelle classi figlie.
     */
    protected string $view = '';

    /**
     * Modello associato alla pagina.
     * Se non specificato, verrà dedotto automaticamente dal nome della classe.
     *
     * @var class-string<Model>|null
     */
<<<<<<< HEAD
    public static null|string $model = null;
=======
    public static ?string $model = null;
>>>>>>> f1d4085 (.)

    /**
     * Dati del form.
     * Contiene i dati del form durante la gestione della pagina.
     *
     * @var array<string, mixed>
     */
    public array $data = [];

    /**
     * Cache timeout per operazioni di cache (in secondi).
     */
    protected static int $cacheTimeout = 3600;

    /**
     * Ottiene il nome del modulo dalla classe.
     * Estrae il nome del modulo dal namespace della classe.
     *
     * @return string Il nome del modulo (es. 'SaluteOra', 'User', ecc.)
     */
    public static function getModuleName(): string
    {
        $namespace = static::class;
        $moduleName = Str::between($namespace, 'Modules\\', '\\Filament');

        if ('' === $moduleName) {
            throw new LogicException(sprintf('Cannot extract module name from class %s', static::class));
        }

        return $moduleName;
    }

    /**
     * Ottiene la chiave di traduzione per un dato key.
     * Genera un percorso di traduzione standardizzato basato sul modulo e sul nome della classe.
     *
     * @param string $key La chiave di traduzione specifica
     * @param array<string, bool|float|int|string> $replace Parametri di sostituzione per la traduzione
     * @param string|null $locale Locale da utilizzare (null = locale corrente)
     * @param bool $useFallback Se true, utilizza la chiave come fallback se la traduzione non esiste
     *
     * @return string La stringa tradotta o la chiave originale se non trovata
     */
<<<<<<< HEAD
    public static function trans(
        string $key,
        array $replace = [],
        null|string $locale = null,
        bool $useFallback = true,
    ): string {
        $moduleNameLow = Str::lower(static::getModuleName());
        $p = Str::after(static::class, 'Filament\\Pages\\');
        $p_arr = explode('\\', $p);
        $slug = collect($p_arr)->map(Str::kebab(...))->implode('.');

        $translationKey = $moduleNameLow . '::' . $slug . '.' . $key;
=======
    public static function trans(string $key, array $replace = [], ?string $locale = null, bool $useFallback = true): string
    {
        $moduleNameLow = Str::lower(static::getModuleName());
        $p = Str::after(static::class, 'Filament\\Pages\\');
        $p_arr = explode('\\', $p);
        $slug = collect($p_arr)->map(static fn (string $item): string => Str::kebab($item))->implode('.');

        $translationKey = $moduleNameLow.'::'.$slug.'.'.$key;
>>>>>>> f1d4085 (.)
        $translation = __($translationKey, $replace, $locale);

        if ($translation === $translationKey && App::environment('local', 'development', 'testing')) {
            Log::warning("Traduzione mancante: {$translationKey}");

            return $useFallback ? $key : $translationKey;
        }

        return (string) $translation;
    }

    /**
     * Ottiene l'etichetta plurale del modello.
     *
     * @return string L'etichetta plurale del modello
     */
    public static function getPluralModelLabel(): string
    {
        return static::trans('plural_label');
    }

    /**
     * Ottiene il gruppo di navigazione.
     *
     * @return string Il gruppo di navigazione
     */
    public static function getNavigationGroup(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    /**
     * Ottiene il modello associato alla pagina.
     * Se non specificato esplicitamente, tenta di dedurlo dal nome della classe.
     *
     * @return class-string<Model> Il namespace completo della classe del modello
     */
    public function getModel(): string
    {
        /** @phpstan-ignore property.staticAccess */
        if (static::$model !== null) {
            /** @var class-string<Model> $model */
            /** @phpstan-ignore property.staticAccess */
            $model = static::$model;

            return $model;
        }

        $moduleName = static::getModuleName();
        $className = class_basename(static::class);

        // Rimuove suffissi comuni per ottenere il nome del modello
        $modelName = Str::of($className)
            ->before('Resource')
            ->before('Page')
            ->before('Dashboard')
            ->before('Report')
            ->trim()
            ->toString();

        if ('' === $modelName) {
            throw new LogicException(sprintf('Cannot determine model name from class %s', static::class));
        }

<<<<<<< HEAD
        $modelNamespace = 'Modules\\' . $moduleName . '\\Models\\' . $modelName;

        // Verifica che la classe del modello esista
        if (!class_exists($modelNamespace)) {
=======
        $modelNamespace = 'Modules\\'.$moduleName.'\\Models\\'.$modelName;

        // Verifica che la classe del modello esista
        if (! class_exists($modelNamespace)) {
>>>>>>> f1d4085 (.)
            throw new LogicException("Model class {$modelNamespace} does not exist");
        }
        Assert::classExists($modelNamespace);
        Assert::isInstanceOf($modelNamespace, Model::class);
        /* @var class-string<Model> $modelNamespace */
        return $modelNamespace;
    }

    /**
     * Configura il form della pagina.
     * Imposta lo schema e il percorso dello stato per il form.
     *
     * @param \Filament\Schemas\Schema $schema Il form da configurare
     *
     * @return \Filament\Schemas\Schema Il form configurato
     */
    public function form(Schema $schema): Schema
    {
        $schema = $schema->components($this->getFormSchema());

        $schema->statePath('data');
<<<<<<< HEAD

=======
        
>>>>>>> f1d4085 (.)
        $debounce = $this->getAutosaveDebounce();
        if (null !== $debounce && method_exists($schema, 'autosaveDebounce')) {
            $schema->autosaveDebounce($debounce);
        }

        return $schema;
    }

    /**
     * Ottiene il tempo di debounce per l'autosave in millisecondi.
     * Sovrascrivere nelle classi figlie per modificare questo valore.
     *
     * @return int|null Il tempo di debounce in millisecondi o null per disabilitare l'autosave
     */
<<<<<<< HEAD
    protected function getAutosaveDebounce(): null|int
=======
    protected function getAutosaveDebounce(): ?int
>>>>>>> f1d4085 (.)
    {
        return null; // Disabilitato per default
    }

<<<<<<< HEAD
=======
    
    

>>>>>>> f1d4085 (.)
    /**
     * Ottiene l'utente autenticato.
     * Verifica che l'utente sia un'istanza di Model per permettere aggiornamenti.
     *
     * @throws RuntimeException Se l'utente non è autenticato o non è un'istanza di Model
     *
     * @return Authenticatable&Model L'utente autenticato
     */
    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

        if (null === $user) {
            throw new RuntimeException('Nessun utente autenticato trovato.');
        }

<<<<<<< HEAD
        if (!($user instanceof Model)) {
            throw new RuntimeException(
                'L\'utente autenticato deve essere un modello Eloquent per permettere aggiornamenti.',
            );
=======
        if (! $user instanceof Model) {
            throw new RuntimeException('L\'utente autenticato deve essere un modello Eloquent per permettere aggiornamenti.');
>>>>>>> f1d4085 (.)
        }

        /* @var Authenticatable&Model $user */
        return $user;
    }

    /**
     * Verifica se l'utente ha l'accesso alla pagina.
     * Utilizza il sistema di autorizzazioni per controllare l'accesso.
     *
     * @throws AuthorizationException Se l'utente non è autorizzato
     */
    protected function authorizeAccess(): void
    {
        $this->authorize('view', static::class);
    }

    /**
     * Verifica se l'utente ha un permesso specifico.
     * Utile per controlli granulari all'interno delle pagine.
     *
     * @param string $permission Il permesso da verificare
     *
     * @return bool True se l'utente ha il permesso, false altrimenti
     */
    protected function hasPermissionTo(string $permission): bool
    {
        $user = $this->getUser();

<<<<<<< HEAD
        //@phpstan-ignore-next-line
        if (!method_exists($user, 'hasPermissionTo')) {
            throw new RuntimeException('Il modello utente deve implementare il metodo hasPermissionTo');
        }

        // Use method_exists to safely call hasPermissionTo
=======
        // Verifiamo che il metodo hasPermissionTo esista sull'utente
        //if (!method_exists($user, 'hasPermissionTo')) {
        //    throw new \RuntimeException('Il modello utente deve implementare il metodo hasPermissionTo');
        //}

>>>>>>> f1d4085 (.)
        return $user->hasPermissionTo($permission);
    }

    /**
     * Ottiene la vista associata alla pagina.
     *
     * @return string Il percorso della vista
     */
    public function getView(): string
    {
<<<<<<< HEAD
        if ('' === $this->view) {
=======
        if ('' === static::$view) {
>>>>>>> f1d4085 (.)
            $view = app(GetViewByClassAction::class)->execute(static::class);
            if (view()->exists($view)) {
                return (string) $view;
            }

            // Se non troviamo una vista, lanciamo un'eccezione
<<<<<<< HEAD
            throw new RuntimeException('Nessuna vista trovata per la classe: ' . static::class);
        }

        return $this->view;
=======
            throw new RuntimeException('Nessuna vista trovata per la classe: '.static::class);
        }

        return static::$view;
>>>>>>> f1d4085 (.)
    }

    /**
     * Risolve il percorso della vista.
     *
     * @throws RuntimeException Se la vista non esiste
     *
     * @return string Il percorso della vista
     */
    protected function resolveViewPath(): string
    {
        $view = $this->getView();
        if (view()->exists($view)) {
            return $view;
        }

<<<<<<< HEAD
        throw new RuntimeException("View [{$view}] not found for page: " . static::class);
=======
        throw new RuntimeException("View [{$view}] not found for page: ".static::class);
>>>>>>> f1d4085 (.)
    }

    /**
     * Ottiene una query builder per il modello associato alla pagina.
     *
     * @throws LogicException Se il modello non è definito
     *
     * @return Builder<Model>
     */
    protected function getQuery(): Builder
    {
        $modelClass = $this->getModel();

<<<<<<< HEAD
        if (!class_exists($modelClass)) {
=======
        if (! class_exists($modelClass)) {
>>>>>>> f1d4085 (.)
            throw new LogicException("Model class {$modelClass} does not exist");
        }

        /** @var class-string<Model> $modelClass */
        $instance = new $modelClass();
<<<<<<< HEAD
        if (!($instance instanceof Model)) {
=======
        if (! $instance instanceof Model) {
>>>>>>> f1d4085 (.)
            throw new LogicException("Class {$modelClass} must extend Eloquent Model");
        }

        /** @var Builder<Model> $query */
        $query = $modelClass::query();

        return $query;
    }

    /**
     * Invalida la cache per il modello specificato.
     *
     * @param class-string<Model>|null $modelClass
     */
<<<<<<< HEAD
    protected function invalidateCache(null|string $modelClass = null, int|string|null $id = null): void
=======
    protected function invalidateCache(?string $modelClass = null, int|string|null $id = null): void
>>>>>>> f1d4085 (.)
    {
        // Implementazione custom se necessaria
        // Per ora lasciamo vuoto, può essere implementato nelle classi figlie
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }
}
