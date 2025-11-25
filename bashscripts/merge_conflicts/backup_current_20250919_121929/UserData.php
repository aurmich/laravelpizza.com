<?php

declare(strict_types=1);

namespace Modules\UI\Data;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
<<<<<<< HEAD
        public null|string $avatar,
        public null|string $role,
        public array $permissions,
        public array $settings,
    ) {}
}
=======
        public ?string $avatar,
        public ?string $role,
        public array $permissions,
        public array $settings
    ) {
    }
} 
>>>>>>> 727968c (.)
