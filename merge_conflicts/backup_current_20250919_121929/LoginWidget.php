<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form as FilamentForm;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form as FilamentForm;
use Filament\Notifications\Notification;
>>>>>>> fbc8f8e (.)
use Illuminate\Validation\ValidationException;
use Modules\Xot\Filament\Widgets\XotBaseWidget;

/**
 * LoginWidget: Widget di login conforme alle regole Windsurf/Xot.
 * - Estende XotBaseWidget
 * - Usa solo componenti Filament importati
 * - Validazione e sicurezza integrate
 * - Facilmente estendibile (2FA, captcha, login social)
 *
 * @property array<string, mixed>|null $data
 */
class LoginWidget extends XotBaseWidget
{
    /**
     * Blade view del widget nel modulo User.
     * IMPORTANTE: quando il widget viene usato con @livewire() direttamente nelle Blade,
     * il path deve essere senza il namespace del modulo (senza "user::").
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @see \Modules\User\docs\WIDGETS_STRUCTURE.md - Sezione B
     * @var view-string
     */
    /** @phpstan-ignore-next-line property.defaultValue */
    protected string $view = 'pub_theme::filament.widgets.auth.login';
<<<<<<< HEAD

=======
    
   
>>>>>>> fbc8f8e (.)
    /**
     * Inizializza il widget quando viene montato.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }
<<<<<<< HEAD

    /**
     * Get the form schema for the login form.
     *
     * @return array<int, Component>
     */
    #[Override]
=======
    
    /**
     * Get the form schema for the login form.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
>>>>>>> fbc8f8e (.)
    public function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->email()
                ->required()
                ->autofocus(),
            TextInput::make('password')
                ->password()
                ->required()
                ->revealable(),
<<<<<<< HEAD
            Toggle::make('remember')->visible(false),
=======
            Toggle::make('remember')
                ->visible(false),
>>>>>>> fbc8f8e (.)
        ];
    }

    /**
     * Get the form model.
     *
     * @return Model|null
     */
<<<<<<< HEAD
    #[Override]
    protected function getFormModel(): null|Model
    {
        return null;
    }

=======
    protected function getFormModel(): ?Model
    {
        return null;
    }
    
>>>>>>> fbc8f8e (.)
    /**
     * Get the form fill data.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function getFormFill(): array
    {
        return [
            'email' => old('email'),
            'remember' => true,
        ];
    }

<<<<<<< HEAD
=======


>>>>>>> fbc8f8e (.)
    /**
     * Handle login form submission.
     *
     * @return void
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function save(): void
    {
        try {
            $data = $this->form->getState();
<<<<<<< HEAD

            // Cast esplicito per type safety PHPStan
            $remember = (bool) ($data['remember'] ?? false);
            $attempt_data = Arr::only($data, ['email', 'password']);

=======
            
            // Cast esplicito per type safety PHPStan
            $remember = (bool) ($data['remember'] ?? false);
            $attempt_data =Arr::only($data,['email','password']);
            
>>>>>>> fbc8f8e (.)
            if (!Auth::attempt($attempt_data, $remember)) {
                throw ValidationException::withMessages([
                    'email' => [__('user::messages.credentials_incorrect')],
                ]);
            }

            session()->regenerate();
<<<<<<< HEAD

=======
            
>>>>>>> fbc8f8e (.)
            Notification::make()
                ->title(__('user::messages.login_success'))
                ->success()
                ->send();
<<<<<<< HEAD

            $this->redirect(route('home'));
=======
                
            $this->redirect(route('home'));
            
>>>>>>> fbc8f8e (.)
        } catch (ValidationException $e) {
            Notification::make()
                ->title(__('user::messages.validation_error'))
                ->body($e->getMessage())
                ->danger()
                ->send();
<<<<<<< HEAD

            $this->form->fill();
            $this->form->saveRelationships();
            //$this->form->callAfter();

            foreach ($e->errors() as $field => $messages) {
                // Semplificato: aggiungi sempre l'errore al campo specifico
                $this->addError($field, implode(' ', $messages));
            }
        } catch (Exception $e) {
            report($e);

=======
                
            $this->form->fill();
            $this->form->saveRelationships();
            //$this->form->callAfter();
            
            foreach ($e->errors() as $field => $messages) {
                $this->form->getComponent($field)?->getContainer()->getParentComponent()?->getStatePath()
                    ? $this->addError($field, implode(' ', $messages))
                    : $this->addError('email', implode(' ', $messages));
            }
            
        } catch (Exception $e) {
            report($e);
            
>>>>>>> fbc8f8e (.)
            Notification::make()
                ->title(__('user::messages.login_error'))
                ->body(__('user::messages.login_error'))
                ->danger()
                ->send();
<<<<<<< HEAD

            $this->form->fill();
            $this->form->saveRelationships();
            //$this->form->callAfter();

            $this->addError('email', __('user::messages.login_error'));
        }
    }
=======
                
            $this->form->fill();
            $this->form->saveRelationships();
            //$this->form->callAfter();
            
            $this->addError('email', __('user::messages.login_error'));
        }
    }
    

>>>>>>> fbc8f8e (.)
}
