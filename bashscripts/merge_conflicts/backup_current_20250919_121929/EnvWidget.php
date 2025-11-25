<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
=======
>>>>>>> f1d4085 (.)
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Arr;
use Modules\Xot\Datas\EnvData;

/**
<<<<<<< HEAD
 * @property Schema $form
 */
class EnvWidget extends Widget implements HasForms, HasActions
=======
 * @property \Filament\Schemas\Schema $form
 */
class EnvWidget extends Widget implements HasForms, HasActions, HasActions
>>>>>>> f1d4085 (.)
{
    use InteractsWithActions;
    use InteractsWithForms;

    /** @var array<string, mixed>|null */
<<<<<<< HEAD
    public null|array $data = [];
=======
    public ?array $data = [];
>>>>>>> f1d4085 (.)

    public array $only = [];

    protected string $view = 'xot::filament.widgets.env';

    public function mount(): void
    {
        /** @var array<string, mixed> */
        $data = EnvData::make()->toArray();
        $this->data = $data;

        $this->form->fill($this->data);
    }

    public function form(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema->components($this->getFormSchema())->columns(1)->statePath('data');
=======
        return $schema
            ->components($this->getFormSchema())
            ->columns(1)
            ->statePath('data');
>>>>>>> f1d4085 (.)
    }

    public function submit(): void
    {
<<<<<<< HEAD
        if (!is_array($this->data)) {
=======
        if (! is_array($this->data)) {
>>>>>>> f1d4085 (.)
            return;
        }
        EnvData::make()->update($this->data);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
<<<<<<< HEAD

        /*
         * dddx([
         * 'data' => $this->data,
         * // 'data1' => $this->form->getState(),
         * ]);
         */
    }

    /**
     * @return array<Component>
=======
        /*
        dddx([
            'data' => $this->data,
            // 'data1' => $this->form->getState(),
        ]);
        */
    }

    /**
     * @return array<\Filament\Schemas\Components\Component>
>>>>>>> f1d4085 (.)
     */
    public function getFormSchema(): array
    {
        $all = [
            'app_url' => TextInput::make('app_url')
<<<<<<< HEAD
                ->placeholder('http://localhost')
                ->helperText('Required for file uploads and other internal configs')
                ->required(),
            'debugbar_enabled' => Toggle::make('debugbar_enabled')->helperText(
                'Enable/Disable debug mode to help debug errors',
            ),
=======

                ->placeholder('http://localhost')
                ->helperText('Required for file uploads and other internal configs')
                ->required(),
            'debugbar_enabled' => Toggle::make('debugbar_enabled')

                ->helperText('Enable/Disable debug mode to help debug errors'),
>>>>>>> f1d4085 (.)
            'google_maps_api_key' => TextInput::make('google_maps_api_key')
                ->placeholder('AIzaSyAuB_...')
                ->helperText('google maps api key'),
            'telegram_bot_token' => TextInput::make('telegram_bot_token')
                ->placeholder('AIzaSyAuB_...')
                ->helperText('telegram_bot_token'),
        ];

        /**
<<<<<<< HEAD
         * @var array<Component>
=======
         * @var array<\Filament\Schemas\Components\Component>
>>>>>>> f1d4085 (.)
         */
        $fields = Arr::only($all, $this->only);

        return $fields;
    }
}
