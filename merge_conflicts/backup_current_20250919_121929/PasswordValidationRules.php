<?php

declare(strict_types=1);

namespace Modules\User\Traits;

use Illuminate\Contracts\Validation\Rule;
use Modules\User\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, (Rule|array|string)>
     */
    protected function passwordRules(): array
    {
<<<<<<< HEAD
        return ['required', 'string', new Password(), 'confirmed'];
=======
        return ['required', 'string', new Password, 'confirmed'];
>>>>>>> fbc8f8e (.)
    }
}
