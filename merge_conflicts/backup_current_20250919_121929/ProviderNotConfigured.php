<?php

declare(strict_types=1);

namespace Modules\User\Exceptions;

use LogicException;

final class ProviderNotConfigured extends LogicException
{
    public static function make(string $provider): static
    {
<<<<<<< HEAD
        return new self('Provider "' .
            $provider .
            '" is not configured. tips: add ' .
            $provider .
            ' to config/services.php');
=======
        return new self('Provider "'.$provider.'" is not configured. tips: add '.$provider.' to config/services.php');
>>>>>>> fbc8f8e (.)
    }
}
