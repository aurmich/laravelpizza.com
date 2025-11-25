<?php

declare(strict_types=1);

namespace Modules\Lang\View\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Xot\Actions\GetViewAction;

/**
 * Undocumented class.
 */
class Flag extends Component
{
<<<<<<< HEAD
    public function __construct(
        public string $name,
    ) {}
=======
    public function __construct(public string $name)
    {
    }
>>>>>>> 8b0b6ac (.)

    public function render(): Renderable
    {
        $view = app(GetViewAction::class)->execute();
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
