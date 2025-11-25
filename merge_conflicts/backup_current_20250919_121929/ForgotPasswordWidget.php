<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets\Auth;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput as FormsTextInput;
use Illuminate\Support\Facades\Password;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * @property Schema $form
=======
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Filament\Forms\Components\TextInput as FormsTextInput;

/**
 * @property \Filament\Schemas\Schema $form
>>>>>>> fbc8f8e (.)
 */
class ForgotPasswordWidget extends XotBaseWidget
{
    protected string $view = 'user::widgets.auth.forgot-password-widget';

    /**
     * Get the form schema for this widget.
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
                ->maxLength(255),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ])
                ->columns(1),
        ])->statePath('data');
=======
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
>>>>>>> fbc8f8e (.)
    }

    public function sendResetLink(): void
    {
        $data = $this->form->getState();

<<<<<<< HEAD
        $status = Password::sendResetLink(['email' => $data['email']]);
=======
        $status = Password::sendResetLink(
            ['email' => $data['email']]
        );
>>>>>>> fbc8f8e (.)

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
        } else {
            $this->addError('email', __($status));
        }
    }
}
