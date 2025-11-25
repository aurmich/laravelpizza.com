<?php

declare(strict_types=1);

namespace Modules\User\Http\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Modules\Xot\Actions\File\ViewCopyAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Webmozart\Assert\Assert;

class Verify extends Component
{
    public function resend(): void
    {
<<<<<<< HEAD
        Assert::notNull($user = Auth::user(), '[' . __LINE__ . '][' . class_basename($this) . ']');
=======
        Assert::notNull($user = Auth::user(), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> fbc8f8e (.)
        if ($user->hasVerifiedEmail()) {
            redirect(route('home'));
        }

        $user->sendEmailVerificationNotification();

        $this->dispatch('resent');

        session()->flash('resent');
    }

    public function render(): View|Factory
    {
<<<<<<< HEAD
        app(ViewCopyAction::class)
            ->execute('user::livewire.auth.verify', 'pub_theme::livewire.auth.verify');
=======
        app(ViewCopyAction::class)->execute('user::livewire.auth.verify', 'pub_theme::livewire.auth.verify');
>>>>>>> fbc8f8e (.)
        app(ViewCopyAction::class)->execute('user::layouts.auth', 'pub_theme::layouts.auth');
        app(ViewCopyAction::class)->execute('user::layouts.base', 'pub_theme::layouts.base');
        /**
         * @phpstan-var view-string
         */
        $view = 'pub_theme::livewire.auth.verify';

<<<<<<< HEAD
        return view($view)->extends('pub_theme::layouts.auth');
=======
        return view($view)
            ->extends('pub_theme::layouts.auth');
>>>>>>> fbc8f8e (.)
    }
}
