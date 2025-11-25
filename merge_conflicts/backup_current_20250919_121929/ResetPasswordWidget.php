<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Http\RedirectResponse;
use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
=======
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
>>>>>>> fbc8f8e (.)
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * Reset password widget for user password reset functionality.
 *
 * Handles password reset functionality with token validation,
 * proper security measures, and user feedback. Follows Laraxot
 * architectural patterns and security best practices.
 *
<<<<<<< HEAD
 * @property Schema $form Form container from XotBaseWidget
=======
 * @property \Filament\Schemas\Schema $form Form container from XotBaseWidget
>>>>>>> fbc8f8e (.)
 */
class ResetPasswordWidget extends XotBaseWidget
{
    /**
     * The view for this widget.
     *
     * @var view-string
     */
    protected string $view = 'user::widgets.auth.reset-password-widget';

    /**
     * Get the form schema for password reset.
     *
     * Uses string keys for Filament form compatibility and follows
     * the pattern established in widget documentation.
     *
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> fbc8f8e (.)
    public function getFormSchema(): array
    {
        return [
            'email' => TextInput::make('email')
                ->email()
                ->required()
                ->autocomplete('email'),
            'password' => TextInput::make('password')
                ->password()
                ->required()
                ->minLength(8)
                ->same('password_confirmation')
                ->autocomplete('new-password'),
            'password_confirmation' => TextInput::make('password_confirmation')
                ->password()
                ->required()
                ->autocomplete('new-password'),
        ];
    }

    /**
     * Mount the widget and initialize the form.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Configure the form for this widget.
     *
<<<<<<< HEAD
     * @param Schema $schema
     * @return Schema
     */
    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema($this->getFormSchema())->columns(1),
        ])->statePath('data');
=======
     * @param \Filament\Schemas\Schema $schema
     * @return \Filament\Schemas\Schema
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema($this->getFormSchema())
                    ->columns(1),
            ])
            ->statePath('data');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Handle password reset with proper security and error handling.
     *
     * Implements Laravel's password reset functionality with explicit
     * type casting for security and proper error feedback.
     *
     * @return RedirectResponse|void
     */
    public function resetPassword()
    {
        $data = $this->form->getState();

<<<<<<< HEAD
        $reset_data = Arr::only($data, ['email', 'password', 'password_confirmation', 'token']);
        $status = Password::reset($reset_data, function (\Illuminate\Contracts\Auth\Authenticatable $user, string $password): void {
            /** @var \Illuminate\Database\Eloquent\Model&\Illuminate\Contracts\Auth\Authenticatable $user */
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        });
=======
        $reset_data =Arr::only($data,['email','password','password_confirmation','token']);
        $status = Password::reset( $reset_data,
            function ($user, $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );
>>>>>>> fbc8f8e (.)

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __($status));
            return redirect()->route('login');
        } else {
            /** @phpstan-ignore-next-line */
            $this->addError('email', __($status));
        }
    }
}
