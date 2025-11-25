<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
=======
>>>>>>> f1d4085 (.)
use Filament\Schemas\Schema;
use Exception;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget as FilamentWidget;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Xot\Filament\Traits\TransTrait;
use Webmozart\Assert\Assert;

/**
 * Classe base astratta per tutti i widget Filament.
 * Fornisce funzionalità comuni e standardizzate per la gestione dei widget.
 *
 * @property bool                      $shouldRender Indica se il widget deve essere renderizzato
 * @property string                    $title        Titolo del widget
 * @property string                    $icon         Icona del widget
 * @property array<string, mixed>|null $data         Dati del form
<<<<<<< HEAD
 * @property Schema $form
=======
 * @property \Filament\Schemas\Schema $form
>>>>>>> f1d4085 (.)
 */
abstract class XotBaseWidget extends FilamentWidget implements HasForms, HasActions
{
    use TransTrait;
<<<<<<< HEAD
    // use InteractsWithPageFilters; // Rimosso per evitare conflitto con InteractsWithForms in Filament v4
=======
    use InteractsWithPageFilters;
>>>>>>> f1d4085 (.)
    // use InteractsWithPageTable;
    use InteractsWithForms;
    use InteractsWithActions;

    public string $title = '';
    public string $icon = '';
    protected int|string|array $columnSpan = 'full';

    /**
     * Lista degli eventi ascoltati dal widget.
     *
     * @var array<string, string>
     */
    public array $listener = [
<<<<<<< HEAD
        // 'filters-updated' => 'filtersUpdated', // Rimosso per compatibilità Filament v4
=======
        'filters-updated' => 'filtersUpdated',
>>>>>>> f1d4085 (.)
    ];

    /**
     * Dati del form.
     *
     * @var array<string, mixed>
     */
<<<<<<< HEAD
    public null|array $data = [];

    /*
     * public function __construct()
     * {
     * //parent::__construct();//Cannot call constructor
     * $view = app(GetViewByClassAction::class)->execute(static::class);
     * if(view()->exists($view)){
     * $this->view = $view;
     * }
     * }
     */
    /*
     * public function mount(): void
     * {
     * $this->form->fill();
     * }
     */
=======
    public ?array $data = [];

    /*
    public function __construct()
    {
        //parent::__construct();//Cannot call constructor
        $view = app(GetViewByClassAction::class)->execute(static::class);
        if(view()->exists($view)){
            $this->view = $view;
        }
    }
    */
    /*
    public function mount(): void
    {
        $this->form->fill();
    }
    */
>>>>>>> f1d4085 (.)
    /**
     * Ottiene lo schema del form.
     * Deve essere implementato nelle classi figlie.
     *
<<<<<<< HEAD
     * @return array<int|string, Component>
=======
     * @return array<int|string, \Filament\Schemas\Components\Component>
>>>>>>> f1d4085 (.)
     */
    abstract public function getFormSchema(): array;

    /**
     * Configura il form del widget.
     *
<<<<<<< HEAD
     * @param Schema $schema Il form da configurare
     *
     * @return Schema Il form configurato
=======
     * @param \Filament\Schemas\Schema $schema Il form da configurare
     *
     * @return \Filament\Schemas\Schema Il form configurato
>>>>>>> f1d4085 (.)
     */
    public function form(Schema $schema): Schema
    {
        $schema = $schema->components($this->getFormSchema());
        $schema->statePath('data');
        $data = $this->getFormFill();

<<<<<<< HEAD
        $model = $this->getFormModel();
        if ($model !== null) {
            // Ensure model is compatible with Schema::model()
            if (is_string($model)) {
                if (class_exists($model) && is_subclass_of($model, Model::class)) {
                    /** @var class-string<Model> $model */
                    $schema->model($model);
                }
            } else {
                // $model is an instance of Model
                $schema->model($model);
            }
        }
        if (!empty($data)) {
=======
        $schema->model($this->getFormModel());
        if (! empty($data)) {
>>>>>>> f1d4085 (.)
            // $form->fill($data);
            // $this->data=$data;
        }

        return $schema;
    }

    public function getFormFill(): array
    {
        $model = $this->getFormModel();
<<<<<<< HEAD
        if (null === $model) {
=======
        if (null == $model) {
>>>>>>> f1d4085 (.)
            return [];
        }
        if (is_string($model)) {
            Assert::isInstanceOf($model = app($model), Model::class);
        }

        // Se il modello ha un ID, significa che è stato trovato nel database
        if ($model->exists) {
            try {
                // dddx($model->getArrayableRelations());
                $res = $model->toArray();

                if (method_exists($model, 'getDataDefaults')) {
<<<<<<< HEAD
                    /** @var array<string, mixed> $defaults */
                    $defaults = $model->getDataDefaults();
                    $merge1 = array_merge($defaults, $res);
                    $merge1 = Arr::map($merge1, function ($value, string|int $key) use ($defaults) {
                        if (null === $value) {
=======
                    $defaults = $model->getDataDefaults();
                    $merge1 = array_merge($defaults, $res);
                    $merge1 = Arr::map($merge1, function ($value, $key) use ($defaults) {
                        if (null == $value) {
>>>>>>> f1d4085 (.)
                            $value = Arr::get($defaults, $key, null);
                        }

                        return $value;
                    });
                    $res = $merge1;
                }

                return $res;
<<<<<<< HEAD

=======
>>>>>>> f1d4085 (.)
                // dddx($model->with('studio')->relationsToArray());
            } catch (Exception $e) {
                // Se toArray() fallisce (problemi con enum), usa getAttributes()
                // Log::warning("Errore in toArray() per modello {$this->model}: " . $e->getMessage());
                $attributes = $model->getAttributes();

                // Gestisci specificamente gli enum se presenti
                // if (isset($attributes['type']) && $model->type instanceof \BackedEnum) {
                //    $attributes['type'] = $model->type->value;
                // }

                return $attributes;
            }
        }

        // Se è un nuovo modello, restituisci solo i campi fillable con valori null
        $fillable = $model->getFillable();
        $appends = $model->getAppends();
        $attributes = $model->attributesToArray();

        $fields = array_merge($fillable, $appends);
        $fields = array_fill_keys($fields, null);
        $fields = array_merge($fields, $attributes);
        if (method_exists($model, 'getDataDefaults')) {
<<<<<<< HEAD
            /** @var array<string, mixed> $defaults */
=======
>>>>>>> f1d4085 (.)
            $defaults = $model->getDataDefaults();
            $fields = array_merge($fields, $defaults);
        }

        return $fields;
    }

    /**
     * Ottiene le azioni del form.
     *
     * @return array<int|string, Action>
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    /**
     * Ottiene il modello per il form.
     * Può essere sovrascritto nelle classi figlie per fornire un modello specifico.
     */
    protected function getFormModel(): Model|string|null
    {
        return null;
    }

    /**
     * Salva i dati del form.
     * Override nelle classi figlie se necessario.
     */
    public function save(): void
    {
        // Implementare nelle classi figlie
    }

    /**
     * Eseguito quando i filtri vengono aggiornati.
<<<<<<< HEAD
     * Rimosso per compatibilità Filament v4 - da reimplementare se necessario
     */
    // public function filtersUpdated(): void
    // {
    //     $this->reset('data');
    // }
=======
     */
    public function filtersUpdated(): void
    {
        $this->reset('data');
    }
>>>>>>> f1d4085 (.)

    public static function getNavigationLabel(): string
    {
        /*
<<<<<<< HEAD
         * return (string) (static::$navigationLabel ?? (string) str(static::getLabel())
         * ->headline());
         */
=======
        return (string) (static::$navigationLabel ?? (string) str(static::getLabel())
            ->headline());
        */
>>>>>>> f1d4085 (.)
        return static::transFunc(__FUNCTION__);
    }

    protected function getStepByName(string $name): Step
    {
<<<<<<< HEAD
        $schema = Str::of($name)
            ->snake()
            ->studly()
            ->prepend('get')
            ->append('Schema')
            ->toString();

        /** @var array<\Illuminate\Contracts\Support\Htmlable|string> $schemaComponents */
        $schemaComponents = $this->$schema();
        return Step::make($name)->schema($schemaComponents);
=======
        $schema = Str::of($name)->snake()->studly()->prepend('get')->append('Schema')->toString();

        return Step::make($name)
            ->schema($this->$schema());
>>>>>>> f1d4085 (.)
    }

    public function getWizardSubmitAction(): Action
    {
<<<<<<< HEAD
        /** @var view-string $submit_view */
        $submit_view = 'pub_theme::filament.wizard.submit-button';

        if (!view()->exists($submit_view)) {
            throw new Exception("View {$submit_view} does not exist");
        }
        return Action::make('submit')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->view((string) $submit_view);
=======
        $submit_view = 'pub_theme::filament.wizard.submit-button';

        // if(!view()->exists($submit_view)){
        //    throw new \Exception("View {$submit_view} does not exist");
        // }
        return Action::make('submit')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->view($submit_view);
>>>>>>> f1d4085 (.)
    }
}
