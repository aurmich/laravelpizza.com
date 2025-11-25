<?php

declare(strict_types=1);

namespace Modules\User\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;

class AlwaysAskPasswordConfirmationAction extends Action
{
    protected function setUp(): void
    {
        $this->requiresConfirmation()
            ->modalHeading(__('filament-jet::jet.password_confirmation_modal.heading'))
<<<<<<< HEAD
            ->modalSubheading(__('filament-jet::jet.password_confirmation_modal.description'))
            ->schema([
                TextInput::make('current_password')
                    ->required()
                    ->password()
                    ->rule('current_password'),
            ]);
=======
            ->modalSubheading(
                __('filament-jet::jet.password_confirmation_modal.description')
            )
            ->schema(
                [
                    TextInput::make('current_password')

                        ->required()
                        ->password()
                        ->rule('current_password'),
                ]
            );
>>>>>>> fbc8f8e (.)
    }
}
