<?php

declare(strict_types=1);

/**
 * @see Jeffgreco13\FilamentBreezy\Pages
 * @see https://www.filamentcomponents.com/blog/how-to-create-a-custom-profile-page-with-filamentphp
 */

namespace Modules\User\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\EditProfile;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\User\Datas\PasswordData;

/**
 * @property \Filament\Schemas\Schema $form
 * @property \Filament\Schemas\Schema $editProfileForm
 * @property \Filament\Schemas\Schema $editPasswordForm
 */
class MyProfilePage extends Page implements HasForms
{
    // class MyProfilePage extends EditProfile
    use InteractsWithForms;

<<<<<<< HEAD
    public null|array $profileData = [];

    public null|array $passwordData = [];
=======
    public ?array $profileData = [];

    public ?array $passwordData = [];
>>>>>>> fbc8f8e (.)

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'user::filament.pages.my-profile';

    protected static bool $shouldRegisterNavigation = false;

    // public static function getSlug(): string
    // {
    //     return filament('filament-breezy')->slug();
    // }

    public static function getNavigationLabel(): string
    {
        return __('user::profile.profile');
    }

    public function mount(): void
    {
        $this->fillForms();
    }

    public function editProfileForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Information')
                    ->aside()
                    ->description('Update your account\'s profile information and email address.')
                    ->schema([
<<<<<<< HEAD
                        TextInput::make('name')->required(),
=======
                        TextInput::make('name')
                            ->required(),
>>>>>>> fbc8f8e (.)
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                    ]),
            ])
            ->model($this->getUser())
            ->statePath('profileData');
    }

    public function editPasswordForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Update Password')
                    ->aside()
                    ->description('Ensure your account is using long, random password to stay secure.')
                    ->schema([
                        TextInput::make('Current password')
                            ->password()
                            ->required()
                            ->currentPassword(),
<<<<<<< HEAD
                        PasswordData::make()
                            ->getPasswordFormComponent('new_password')
                            ->dehydrateStateUsing(fn (string $value): string => Hash::make($value))
                            ->live(debounce: 500),
                        // ->same('passwordConfirmation')
                        /*
                         * Forms\Components\TextInput::make('password')
                         * ->password()
                         * ->required()
                         * ->rule(Password::default())
                         * ->autocomplete('new-password')
                         * ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                         * ->live(debounce: 500)
                         * ->same('passwordConfirmation'),
                         */
=======
                        PasswordData::make()->getPasswordFormComponent('new_password')
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                        // ->same('passwordConfirmation')
                        ,
                        /*
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                            ->live(debounce: 500)
                            ->same('passwordConfirmation'),
                        */
>>>>>>> fbc8f8e (.)
                        TextInput::make('passwordConfirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->same('new_password'),
                    ]),
            ])
            ->model($this->getUser())
            ->statePath('passwordData');
    }

    public function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

<<<<<<< HEAD
        if (!($user instanceof Model)) {
            throw new Exception(
                'The authenticated user object must be an Eloquent model to allow the profile page to update it.',
            );
=======
        if (! $user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
>>>>>>> fbc8f8e (.)
        }

        return $user;
    }

    public function getTitle(): string
    {
        return __('user::profile.my_profile');
    }

    public function getHeading(): string
    {
        return __('user::profile.my_profile');
    }

<<<<<<< HEAD
    public function getSubheading(): null|string
=======
    public function getSubheading(): ?string
>>>>>>> fbc8f8e (.)
    {
        return __('user::profile.subheading') ?? null;
    }

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return filament('filament-breezy')->shouldRegisterNavigation('myProfile');
    // }

    // public static function getNavigationGroup(): ?string
    // {
    //     return filament('filament-breezy')->getNavigationGroup('myProfile');
    // }

    // public function getRegisteredMyProfileComponents(): array
    // {
    //     return filament('filament-breezy')->getRegisteredMyProfileComponents();
    // }
    public function getFormSchema(): array
    {
        return [
<<<<<<< HEAD
            TextInput::make('name')->autofocus()->required(),
            TextInput::make('email')->required(),
        ];

=======
            TextInput::make('name')
                ->autofocus()
                ->required(),
            TextInput::make('email')
                ->required(),
        ];
>>>>>>> fbc8f8e (.)
        // Nota: i seguenti commenti sono stati rimossi perché non sono applicabili al metodo getFormSchema()
        // ->statePath('data')
        // ->model(auth()->user());
    }

    public function updateProfile(): void
    {
        try {
            $data = $this->editProfileForm->getState();

            $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }

        $this->sendSuccessNotification();
    }

    public function updatePassword(): void
    {
        try {
            $data = $this->editPasswordForm->getState();

            $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }

        if (request()->hasSession() && array_key_exists('password', $data)) {
<<<<<<< HEAD
            request()
                ->session()
                ->put([
                    'password_hash_' . Filament::getAuthGuard() => $data['password'],
                ]);
=======
            request()->session()->put([
                'password_hash_'.Filament::getAuthGuard() => $data['password'],
            
            ]);
>>>>>>> fbc8f8e (.)
        }

        $this->editPasswordForm->fill();

        $this->sendSuccessNotification();
    }

    protected function getForms(): array
    {
        return [
            'editProfileForm',
            'editPasswordForm',
        ];
    }

    protected function fillForms(): void
    {
        $data = $this->getUser()->attributesToArray();

        $this->editProfileForm->fill($data);
        $this->editPasswordForm->fill();
    }

    protected function getFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('Update')->color('primary')->submit('Update'),
=======
            Action::make('Update')
                ->color('primary')
                ->submit('Update'),
>>>>>>> fbc8f8e (.)
        ];
    }

    /*
<<<<<<< HEAD
     * public function update()
     * {
     * auth()->user()->update(
     * $this->form->getState()
     * );
     *
     * Notification::make()
     * ->title('Profile updated!')
     * ->success()
     * ->send();
     * }
     */
=======
    public function update()
    {
        auth()->user()->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Profile updated!')
            ->success()
            ->send();
    }
    */
>>>>>>> fbc8f8e (.)

    protected function getUpdateProfileFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('updateProfileAction')->submit('editProfileForm'),
=======
            Action::make('updateProfileAction')

                ->submit('editProfileForm'),
>>>>>>> fbc8f8e (.)
        ];
    }

    protected function getUpdatePasswordFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('updatePasswordAction')->submit('editPasswordForm'),
=======
            Action::make('updatePasswordAction')

                ->submit('editPasswordForm'),
>>>>>>> fbc8f8e (.)
        ];
    }

    // ...

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    private function sendSuccessNotification(): void
    {
        Notification::make()
            ->success()
            ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
            ->send();
    }
}
