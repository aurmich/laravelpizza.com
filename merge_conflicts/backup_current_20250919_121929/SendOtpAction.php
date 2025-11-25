<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\UserResource\Actions;

use Filament\Actions\Action;
use RuntimeException;
use Modules\User\Actions\Otp\SendOtpByUserAction;
use Modules\User\Models\User;
use Modules\Xot\Contracts\UserContract;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> fbc8f8e (.)

/**
 * Azione Filament per l'invio di un OTP all'utente.
 */
class SendOtpAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

<<<<<<< HEAD
        $this->tooltip(trans('user::otp.actions.send_otp'))
=======
        $this
            ->tooltip(trans('user::otp.actions.send_otp'))
>>>>>>> fbc8f8e (.)
            ->icon('heroicon-o-key')
            ->action(function (User $record) {
                // Sappiamo già che l'utente implementa UserContract perché il tipo User lo implementa
                $action = app(SendOtpByUserAction::class);
                if ($action === null) {
                    throw new RuntimeException('Impossibile istanziare SendOtpByUserAction');
                }
<<<<<<< HEAD
                // User model extends BaseUser which implements UserContract interface
                Assert::isInstanceOf($record, UserContract::class);
=======
>>>>>>> fbc8f8e (.)
                $action->execute($record);
            })
            ->requiresConfirmation()
            ->modalHeading(trans('user::otp.actions.send_otp'))
            ->modalSubheading(trans('user::otp.actions.confirm_otp'))
            ->modalButton(trans('user::otp.actions.yes_send_otp'));
    }

    /**
     * Ottieni il nome predefinito dell'azione.
     */
<<<<<<< HEAD
    public static function getDefaultName(): null|string
=======
    public static function getDefaultName(): ?string
>>>>>>> fbc8f8e (.)
    {
        return 'send_otp';
    }
}
