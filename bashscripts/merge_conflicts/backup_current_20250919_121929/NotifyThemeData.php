<?php

declare(strict_types=1);

namespace Modules\Notify\Datas;

use Spatie\LaravelData\Data;

class NotifyThemeData extends Data
{
<<<<<<< HEAD
    public null|string $from_email = null; // from address

    public null|string $from = null; // from name
=======
    public ?string $from_email = null; // from address

    public ?string $from = null; // from name
>>>>>>> b19cd40 (.)

    public string $subject;

    public string $body_html;

    public array $view_params;
}
