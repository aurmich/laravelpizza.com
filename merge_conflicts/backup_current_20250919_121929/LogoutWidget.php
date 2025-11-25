<?php

declare(strict_types=1);

namespace Modules\User\Filament\Widgets;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Schemas\Components\View;
use RuntimeException;
use Exception;
use Filament\Actions\Action;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Xot\Filament\Widgets\XotBaseWidget;
use Throwable;

/**
 * Provides a widget for user logout functionality within Filament admin panels.
 *
 * This widget handles the user logout process including session invalidation,
 * event dispatching, and proper redirection with localization support.
 *
 * @method void mount() Initialize the widget and form state.
<<<<<<< HEAD
 * @method array<string, Component> getFormSchema() Define the form schema for the logout confirmation.
=======
 * @method array<string, \Filament\Schemas\Components\Component> getFormSchema() Define the form schema for the logout confirmation.
>>>>>>> fbc8f8e (.)
 * @method void logout() Handle the user logout process.
 * @method array<string, Action> getFormActions() Define the form actions (logout and cancel buttons).
 * @method array<string, string> getViewData() Get additional data to pass to the view.
 *
 * @property array<string, mixed>|null $data Widget data array managed by XotBaseWidget.
 * @property bool $isLoggingOut Flag indicating if logout is in progress.
 */
class LogoutWidget extends XotBaseWidget
{
    /**
     * The view that should be used to render the widget.
<<<<<<< HEAD
     *
     * IMPORTANT: When using @livewire() directly in Blade templates,
     * the path should be without the module namespace.
     *
     * @var string
     *
     * @phpstan-ignore property.phpDocType
=======
     * 
     * IMPORTANT: When using @livewire() directly in Blade templates,
     * the path should be without the module namespace.
     * 
     * @var string
     * 
     * @phpstan-ignore property.phpDocType 
>>>>>>> fbc8f8e (.)
     */
    protected string $view = 'user::widgets.logout';

    /**
     * Widget data array.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * CRITICAL: This property is managed by XotBaseWidget.
     * Do not remove or redeclare it.
     *
     * @var array<string, mixed>|null
     */
<<<<<<< HEAD
    public null|array $data = [];
=======
    public ?array $data = [];
>>>>>>> fbc8f8e (.)

    /**
     * Indicates if the logout process is in progress.
     *
     * @var bool
     */
    public bool $isLoggingOut = false;

    /**
     * Mount the widget and initialize the form.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @return void
     */
    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * Get the form schema for the logout confirmation.
     *
     * This method implements the abstract method from XotBaseWidget.
     * Do not override the form() method as it's declared as final.
     *
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
    public function getFormSchema(): array
    {
        $view = 'filament.widgets.auth.logout-message';
        //@phpstan-ignore-next-line
        if (!view()->exists($view)) {
            throw new Exception('View ' . $view . ' not found');
        }
        return [
            'message' => View::make($view)->columnSpanFull(),
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public function getFormSchema(): array
    {
        $view='filament.widgets.auth.logout-message';
        //@phpstan-ignore-next-line
        if(!view()->exists($view)){
            throw new Exception('View '.$view.' not found');
        }
        return [
            'message' => View::make($view)
                ->columnSpanFull(),
>>>>>>> fbc8f8e (.)
        ];
    }

    /**
     * Handle the user logout process.
     *
     * This method performs the following actions:
     * 1. Validates the current user session
     * 2. Dispatches pre-logout events
     * 3. Performs the actual logout
     * 4. Invalidates the session
     * 5. Dispatches post-logout events
     * 6. Logs the operation
     * 7. Handles redirection with proper localization
     *
     * @return void
     *
     * @throws RuntimeException If the logout process fails
     */
    public function logout(): void
    {
        try {
            $this->isLoggingOut = true;

            // Get the authenticated user before logging out
            $user = $this->getAuthenticatedUser();
            if ($user === null) {
                $this->handleNoUserScenario();
                return;
            }

            $this->dispatchPreLogoutEvent($user);
            $this->performLogout();
            $this->dispatchPostLogoutEvent();
            $this->logLogoutSuccess($user);
            $this->redirectAfterLogout();
        } catch (Throwable $e) {
            $this->handleLogoutError($e);
        }
    }

    /**
     * Get the form actions for the widget.
     *
     * @return array<string, Action>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> fbc8f8e (.)
    public function getFormActions(): array
    {
        return [
            'logout' => $this->getLogoutAction(),
            'cancel' => $this->getCancelAction(),
        ];
    }

    /**
     * Get the logout action configuration.
     *
     * @return Action
     */
    protected function getLogoutAction(): Action
    {
        return Action::make('logout')
            ->translateLabel()
            ->color('danger')
            ->size('lg')
            ->extraAttributes(['class' => 'w-full justify-center'])
<<<<<<< HEAD
            ->action($this->logout(...));
=======
            ->action(fn () => $this->logout());
>>>>>>> fbc8f8e (.)
    }

    /**
     * Get the cancel action configuration.
     *
     * @return Action
     */
    protected function getCancelAction(): Action
    {
        return Action::make('cancel')
            ->translateLabel()
            ->color('gray')
            ->size('lg')
            ->extraAttributes(['class' => 'w-full justify-center mt-2'])
            ->url($this->getLocalizedHomeUrl());
    }

    /**
     * Get localized home URL based on current locale.
     *
     * @return string
     */
    protected function getLocalizedHomeUrl(): string
    {
        $locale = App::getLocale();
        return '/' . ltrim($locale, '/');
    }

    /**
     * Get the authenticated user instance.
     *
     * @return Authenticatable|null
     */
<<<<<<< HEAD
    protected function getAuthenticatedUser(): null|Authenticatable
=======
    protected function getAuthenticatedUser(): ?Authenticatable
>>>>>>> fbc8f8e (.)
    {
        return Auth::user();
    }

    /**
     * Handle scenario when no user is authenticated.
     *
     * @return void
     */
    protected function handleNoUserScenario(): void
    {
        $this->isLoggingOut = false;
        Log::warning('Logout attempted with no authenticated user');
    }

    /**
     * Dispatch pre-logout events.
     *
     * @param Authenticatable $user
     * @return void
     */
    protected function dispatchPreLogoutEvent(Authenticatable $user): void
    {
        Event::dispatch('auth.logout.attempting', [$user]);
    }

    /**
     * Perform the actual logout operations.
     *
     * @return void
     */
    protected function performLogout(): void
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
    }

    /**
     * Dispatch post-logout events.
     *
     * @return void
     */
    protected function dispatchPostLogoutEvent(): void
    {
        Event::dispatch('auth.logout.successful');
    }

    /**
     * Log successful logout operation.
     *
     * @param Authenticatable $user
     * @return void
     */
    protected function logLogoutSuccess(Authenticatable $user): void
    {
        Log::info('User logged out', [
            'user_id' => $user->getAuthIdentifier(),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Handle redirect after successful logout.
     *
     * @return void
     */
    protected function redirectAfterLogout(): void
    {
<<<<<<< HEAD
        $redirect = redirect($this->getLocalizedHomeUrl())->with('success', __('user::auth.logout_success'));

        $redirect->send();
        exit();
=======
        $redirect = redirect($this->getLocalizedHomeUrl())
            ->with('success', __('user::auth.logout_success'));
            
        $redirect->send();
        exit;
>>>>>>> fbc8f8e (.)
    }

    /**
     * Handle any errors that occur during logout.
     *
     * @param Throwable $e
     * @return void
     *
     * @throws RuntimeException
     */
    protected function handleLogoutError(Throwable $e): void
    {
        Log::error('Logout error: ' . $e->getMessage(), [
            'exception' => get_class($e),
            'trace' => $e->getTraceAsString(),
        ]);

        $this->isLoggingOut = false;
        Session::flash('error', __('user::auth.logout_error'));
    }

    /**
     * Get view data for the widget.
     *
     * @return array{
     *     title: string,
     *     description: string
     * }
     */
    protected function getViewData(): array
    {
        return [
            'title' => __('user::auth.logout_title'),
            'description' => __('user::auth.logout_confirmation'),
        ];
    }
}
