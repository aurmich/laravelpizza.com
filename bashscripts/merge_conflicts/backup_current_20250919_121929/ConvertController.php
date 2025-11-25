<?php

declare(strict_types=1);

namespace Modules\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ConvertController extends Controller
{
    /**
     * Show the profile for the given user.
     */
<<<<<<< HEAD
    public function __invoke(string|int $_id): View
=======
    public function __invoke(string|int $id): View
>>>>>>> 0a466ed (.)
    {
        /**
         * @phpstan-var view-string
         */
        $view = 'media::convert';
        $view_params = [];

        return view($view, $view_params);
    }
}
