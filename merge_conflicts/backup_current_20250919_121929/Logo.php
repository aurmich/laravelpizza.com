<?php

declare(strict_types=1);

namespace Modules\User\Filament\Clusters\Appearance\Pages;

use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Filament\Clusters\Appearance;

/**
<<<<<<< HEAD
 * @property Schema $form
=======
 * @property \Filament\Schemas\Schema $form
>>>>>>> fbc8f8e (.)
 */
class Logo extends Page implements HasForms
{
    use InteractsWithForms;

<<<<<<< HEAD
    public null|array $logoData = [];
=======
    public ?array $logoData = [];
>>>>>>> fbc8f8e (.)

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'user::filament.clusters.appearance.pages.logo';

<<<<<<< HEAD
    protected static null|string $cluster = Appearance::class;

    protected static null|int $navigationSort = 1;
=======
    protected static ?string $cluster = Appearance::class;

    protected static ?int $navigationSort = 1;
>>>>>>> fbc8f8e (.)

    public function mount(): void
    {
        $this->fillForms();
    }

    // protected function getForms(): array
    // {
    //    return [
    //        'editLogoForm',
    //    ];
    // }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Forms\Components\Section::make('Profile Information')
                // ->description('Update your account\'s profile information and email address.')
                // ->schema([
                FileUpload::make('logo'),
                FileUpload::make('logo_dark'),
                TextInput::make('logo_height')->numeric()->default(32),
                // ])->columns(2),
<<<<<<< HEAD
            ])
            ->columns(2)
=======
            ])->columns(2)
>>>>>>> fbc8f8e (.)
            // ->model($this->getUser())
            ->statePath('logoData');
    }

    public function updateLogo(): void
    {
        try {
            $data = $this->form->getState();
            dddx($data);
<<<<<<< HEAD

=======
>>>>>>> fbc8f8e (.)
            // $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            dddx($exception->getMessage());

            return;
        }
    }

    protected function fillForms(): void
    {
        // $data = $this->getUser()->attributesToArray();
        $data = [];

        $this->form->fill($data);
    }

    protected function getUpdateLogoFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('updateLogoAction')->submit('editLogoForm'),
=======
            Action::make('updateLogoAction')

                ->submit('editLogoForm'),
>>>>>>> fbc8f8e (.)
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }
}
