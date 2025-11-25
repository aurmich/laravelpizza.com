<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\User\Filament\Actions\Profile;

use Filament\Actions\Action;
use Modules\Xot\Contracts\UserContract;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\User\Datas\PasswordData;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Datas\XotData;

/**
 * ---.
 */
class ChangeProfilePasswordAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel()
<<<<<<< HEAD
=======

>>>>>>> fbc8f8e (.)
            ->tooltip(__('user::user.actions.change_password'))
            ->icon('heroicon-o-key')
            ->action(static function (ProfileContract $record, array $data): void {
                $user = $record->user;
                $profile_data = Arr::except($record->toArray(), ['id']);
                if ($user === null) {
                    $user_class = XotData::make()->getUserClass();
                    /** @var UserContract */
                    $user = XotData::make()->getUserByEmail($record->email);
                }

                if ($user === null) {
                    $user = $record->user()->create($profile_data);
                }
                // @phpstan-ignore argument.type, method.notFound
                $user->profile()->save($record);
                $user->update([
                    'password' => Hash::make($data['new_password']),
                ]);
                Notification::make()->success()->title('Password changed successfully.');
            })
<<<<<<< HEAD
            ->schema([
                /*
                 * TextInput::make('new_password')
                 * ->password()
                 * ->required()
                 * ->rule(Password::default()),
                 */
                PasswordData::make()->getPasswordFormComponent('new_password'),
                TextInput::make('new_password_confirmation')
                    ->password()
                    ->rule('required', static fn($get): bool => (bool) $get('new_password'))
=======
            ->form([
                /*
                    TextInput::make('new_password')
                        ->password()
                        ->required()
                        ->rule(Password::default()),
                    */
                PasswordData::make()->getPasswordFormComponent('new_password'),
                TextInput::make('new_password_confirmation')
                    ->password()
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
