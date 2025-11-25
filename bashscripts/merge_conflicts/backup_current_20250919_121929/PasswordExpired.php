<?php

declare(strict_types=1);

namespace Modules\User\Filament\Pages\Auth;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Modules\Xot\Contracts\UserContract;
use Filament\Schemas\Components\Component;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Modules\User\Datas\PasswordData;
use Modules\User\Events\NewPasswordSet;
use Modules\User\Http\Response\PasswordResetResponse;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;
use Webmozart\Assert\Assert;

/**
 * @property \Filament\Schemas\Schema $form
 * @property \Filament\Schemas\Schema $editProfileForm
 * @property \Filament\Schemas\Schema $editPasswordForm
 */
class PasswordExpired extends Page implements HasForms
{
    use InteractsWithFormActions;
    use NavigationPageLabelTrait;

<<<<<<< HEAD
    public null|string $current_password = '';

    public null|string $password = '';

    public null|string $passwordConfirmation = '';
=======
    public ?string $current_password = '';

    public ?string $password = '';

    public ?string $passwordConfirmation = '';
>>>>>>> fbc8f8e (.)

    /**
     * @var view-string
     */
    protected string $view = 'user::filament.auth.pages.password-expired';

    protected static bool $shouldRegisterNavigation = false;

    public function getFormSchema(): array
    {
        return [
            $this->getCurrentPasswordFormComponent(),
            ...PasswordData::make()->getPasswordFormComponents('password'),
        ];
    }

    public function getResetPasswordFormAction(): Action
    {
<<<<<<< HEAD
        return Action::make('resetPassword')->submit('resetPassword');
=======
        return Action::make('resetPassword')
            ->submit('resetPassword');
>>>>>>> fbc8f8e (.)
    }

    public function hasLogo(): bool
    {
        return false;
    }

<<<<<<< HEAD
    public function resetPassword(): null|PasswordResetResponse
=======
    public function resetPassword(): ?PasswordResetResponse
>>>>>>> fbc8f8e (.)
    {
        $pwd = PasswordData::make();
        $data = $this->form->getState();
        Assert::string($current_password = Arr::get($data, 'current_password'));
        Assert::string($password = Arr::get($data, 'password'));
        $user = Auth::user();
        if ($user === null) {
            return null;
        }

        // check if current password is correct
<<<<<<< HEAD
        if ($user->password === null || !Hash::check($current_password, $user->password)) {
=======
        if ($user->password === null || ! Hash::check($current_password, $user->password)) {
>>>>>>> fbc8f8e (.)
            Notification::make()
                ->title(__('user::otp.notifications.wrong_password.title'))
                ->body(__('user::otp.notifications.wrong_password.body'))
                ->danger()
                ->send();

            return null;
        }

        // check if new password is different from the current password
        if ($user->password !== null && Hash::check($password, $user->password)) {
            Notification::make()
                ->title(__('user::otp.notifications.same_password.title'))
                ->body(__('user::otp.notifications.same_password.body'))
                ->danger()
                ->send();

            return null;
        }

        // check if both required columns exist in the database
<<<<<<< HEAD
        if (!Schema::hasColumn('users', 'password_expires_at')) {
=======
        if (! Schema::hasColumn('users', 'password_expires_at')) {
>>>>>>> fbc8f8e (.)
            Notification::make()
                ->title(__('user::otp.notifications.column_not_found.title'))
                ->body(__('user::otp.notifications.column_not_found.body', [
                    'column_name' => 'password_expires_at',
                    'password_column_name' => 'password',
                    'table_name' => 'users',
                ]))
                ->danger()
                ->send();

            return null;
        }

        // get password expiry date and time
        $passwordExpiryDateTime = now()->addDays($pwd->expires_in);

        // Verificare che l'utente esistante e che sia un modello Eloquent
        if (!($user instanceof Model)) {
            throw new InvalidArgumentException('L\'utente deve essere un modello Eloquent con il metodo update');
        }

        // set password expiry date and time
        $user->update([
            'password_expires_at' => $passwordExpiryDateTime,
            'is_otp' => false,
            'password' => Hash::make($password),
        ]);

        // Verificare che l'utente implementi l'interfaccia UserContract prima di passarlo all'evento
<<<<<<< HEAD
        if (!($user instanceof UserContract)) {
=======
        if (!$user instanceof UserContract) {
>>>>>>> fbc8f8e (.)
            throw new InvalidArgumentException('L\'utente deve implementare l\'interfaccia UserContract');
        }

        event(new NewPasswordSet($user));

        Notification::make()
            ->title(__('user::otp.notifications.password_reset.success'))
            ->success()
            ->send();

        return new PasswordResetResponse();
    }

    protected function getCurrentPasswordFormComponent(): Component
    {
        return TextInput::make('current_password')
            ->password()
            ->revealable()
            ->required()
            ->validationAttribute(static::trans('fields.current_password.validation_attribute'));
    }

    /**
     * @return array<Action|ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getResetPasswordFormAction(),
        ];
    }
}
