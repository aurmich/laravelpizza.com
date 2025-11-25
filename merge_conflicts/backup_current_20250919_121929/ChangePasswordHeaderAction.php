<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\User\Filament\Actions\Header;

use Filament\Actions\Action;
<<<<<<< HEAD
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\User\Datas\PasswordData;
use Modules\Xot\Contracts\UserContract;
=======
use Illuminate\Support\Facades\Hash;
use Modules\User\Datas\PasswordData;
use Modules\Xot\Contracts\UserContract;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rules\Password;
>>>>>>> fbc8f8e (.)

class ChangePasswordHeaderAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel()
            ->icon('heroicon-o-key')
            ->action(function (UserContract $record, array $data): void {
                $old_password = $record->getAttribute('password');
<<<<<<< HEAD
                $res = tap($record)->update([
=======
                $res=tap($record)->update([
>>>>>>> fbc8f8e (.)
                    'password' => Hash::make($data['new_password']),
                ]);

                Notification::make()
                    ->success()
                    ->title(__('user::notifications.password_changed_successfully.title'))
                    ->body(__('user::notifications.password_changed_successfully.message'));
            })
            ->schema([
                /*
<<<<<<< HEAD
                 * TextInput::make('new_password')
                 * ->password()
                 *
                 * ->placeholder(__('user::fields.new_password.placeholder'))
                 * ->required()
                 * ->rule(Password::default()),
                 */
                PasswordData::make()->getPasswordFormComponent('new_password'),
                TextInput::make('new_password_confirmation')
                    ->password()
                    ->placeholder(__('user::fields.confirm_password.placeholder'))
                    ->rule('required', static fn($get): bool => (bool) $get('new_password'))
=======
                    TextInput::make('new_password')
                        ->password()

                        ->placeholder(__('user::fields.new_password.placeholder'))
                        ->required()
                        ->rule(Password::default()),
                    */
                PasswordData::make()->getPasswordFormComponent('new_password'),
                TextInput::make('new_password_confirmation')
                    ->password()

                    ->placeholder(__('user::fields.confirm_password.placeholder'))
                    ->rule('required', static fn ($get): bool => (bool) $get('new_password'))
>>>>>>> fbc8f8e (.)
                    ->same('new_password'),
            ]);
    }

<<<<<<< HEAD
    public static function getDefaultName(): null|string
=======
    public static function getDefaultName(): ?string
>>>>>>> fbc8f8e (.)
    {
        return 'changePassword';
    }
}

/*
<<<<<<< HEAD
 * Action::make('changePassword')
 * ->action(function (UserContract $user, array $data): void {
 * $user->update([
 * 'password' => Hash::make($data['new_password']),
 * ]);
 * Notification::make()->success()->title('Password changed successfully.');
 * })
 * ->form([
 * TextInput::make('new_password')
 * ->password()
 * ->required()
 * ->rule(Password::default()),
 * TextInput::make('new_password_confirmation')
 * ->password()
 * ->rule('required', fn ($get): bool => (bool) $get('new_password'))
 * ->same('new_password'),
 * ])
 * ->icon('heroicon-o-key')
 * // ->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
 */
=======
Action::make('changePassword')
                    ->action(function (UserContract $user, array $data): void {
                        $user->update([
                            'password' => Hash::make($data['new_password']),
                        ]);
                        Notification::make()->success()->title('Password changed successfully.');
                    })
                    ->form([
                        TextInput::make('new_password')
                            ->password()
                            ->required()
                            ->rule(Password::default()),
                        TextInput::make('new_password_confirmation')
                            ->password()
                            ->rule('required', fn ($get): bool => (bool) $get('new_password'))
                            ->same('new_password'),
                    ])
                    ->icon('heroicon-o-key')
                // ->visible(fn (User $record): bool => $record->role_id === Role::ROLE_ADMINISTRATOR)
*/
>>>>>>> fbc8f8e (.)
