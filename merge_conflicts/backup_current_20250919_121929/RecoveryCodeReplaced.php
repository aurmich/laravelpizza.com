<?php

declare(strict_types=1);

namespace Modules\User\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class RecoveryCodeReplaced
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
<<<<<<< HEAD
    public function __construct(
        public Authenticatable $user,
        public string $code,
    ) {}
=======
    public function __construct(public Authenticatable $user, public string $code) {}
>>>>>>> fbc8f8e (.)
}
