<?php

declare(strict_types=1);

namespace Modules\Xot\Traits;

<<<<<<< HEAD
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
=======
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
>>>>>>> f1d4085 (.)

trait HasCsrfToken
{
    /**
     * CSRF token for the current request.
     *
     * @var string
     */
    public string $_token;

    /**
     * Mount the component and set the CSRF token.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->_token = App::make('session')->token();
    }

    /**
     * Get the CSRF token.
     *
     * @return string
     */
    public function getCsrfToken(): string
    {
        return $this->_token;
    }

    /**
     * Verify if the CSRF token is valid.
     *
     * @return bool
     */
    public function verifyCsrfToken(): bool
    {
        return Session::token() === $this->_token;
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> f1d4085 (.)
