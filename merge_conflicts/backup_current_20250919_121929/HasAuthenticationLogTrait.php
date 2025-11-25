<?php

declare(strict_types=1);

namespace Modules\User\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Modules\User\Models\AuthenticationLog;

/**
 * Trait HasAuthenticationLogTrait.
 *
 * This trait provides functionality for logging authentication events for any model that uses it.
 * It includes methods for retrieving the latest authentication logs, login timestamps, IP addresses,
 * and other related information, including tracking consecutive login days.
 *
 * @property MorphMany<AuthenticationLog, $this> $authentications      The authentication logs related to the model.
 * @property MorphOne<AuthenticationLog, $this>  $latestAuthentication The most recent authentication log entry.
 * @property-read string|null $login_at The timestamp of the last login.
 * @property-read string|null $ip_address The IP address of the last login.
 * @property MorphMany<AuthenticationLog> $authentications
 * @property MorphOne<AuthenticationLog> $latestAuthentication
 * @property Carbon|null $login_at
 * @property string|null $ip_address
 */
trait HasAuthenticationLogTrait
{
    /**
     * Get all of the model's authentication logs.
     *
     * @return MorphMany<AuthenticationLog, $this>
     */
    public function authentications(): MorphMany
    {
<<<<<<< HEAD
        return $this->morphMany(AuthenticationLog::class, 'authenticatable')->latest('login_at');
=======
        return $this->morphMany(AuthenticationLog::class, 'authenticatable')
            ->latest('login_at');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Get the latest authentication attempt for the model.
     *
     * @return MorphOne<AuthenticationLog, $this>
     */
    public function latestAuthentication(): MorphOne
    {
<<<<<<< HEAD
        return $this->morphOne(AuthenticationLog::class, 'authenticatable')->latestOfMany('login_at');
=======
        return $this->morphOne(AuthenticationLog::class, 'authenticatable')
            ->latestOfMany('login_at');
>>>>>>> fbc8f8e (.)
    }

    /**
     * Specify how to notify about authentication logs.
     *
     * @return list<string> a list of notification channels
     */
    public function notifyAuthenticationLogVia(): array
    {
        return ['mail'];
    }

    /**
     * Get the timestamp of the most recent login attempt.
     *
     * @return ?Carbon the timestamp of the last login or null if none exists
     */
<<<<<<< HEAD
    public function lastLoginAt(): null|Carbon
=======
    public function lastLoginAt(): ?Carbon
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->first();
        return $auth !== null ? $auth->login_at : null;
    }

    /**
     * Get the timestamp of the most recent successful login attempt.
     *
     * @return ?Carbon the timestamp of the last successful login or null if none exists
     */
<<<<<<< HEAD
    public function lastSuccessfulLoginAt(): null|Carbon
=======
    public function lastSuccessfulLoginAt(): ?Carbon
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->where('login_successful', true)->first();
        return $auth !== null ? $auth->login_at : null;
    }

    /**
     * Get the IP address of the most recent login attempt.
     *
     * @return ?string the IP address of the last login or null if none exists
     */
<<<<<<< HEAD
    public function lastLoginIp(): null|string
=======
    public function lastLoginIp(): ?string
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->first();
        return $auth !== null ? $auth->ip_address : null;
    }

    /**
     * Get the IP address of the most recent successful login attempt.
     *
     * @return ?string the IP address of the last successful login or null if none exists
     */
<<<<<<< HEAD
    public function lastSuccessfulLoginIp(): null|string
=======
    public function lastSuccessfulLoginIp(): ?string
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->where('login_successful', true)->first();
        return $auth !== null ? $auth->ip_address : null;
    }

    /**
     * Get the timestamp of the second most recent login attempt (previous login).
     *
     * @return ?Carbon the timestamp of the previous login or null if less than two logins exist
     */
<<<<<<< HEAD
    public function previousLoginAt(): null|Carbon
=======
    public function previousLoginAt(): ?Carbon
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->skip(1)->first();
        return $auth !== null ? $auth->login_at : null;
    }

    /**
     * Get the IP address of the second most recent login attempt (previous login).
     *
     * @return ?string the IP address of the previous login or null if less than two logins exist
     */
<<<<<<< HEAD
    public function previousLoginIp(): null|string
=======
    public function previousLoginIp(): ?string
>>>>>>> fbc8f8e (.)
    {
        /** @var AuthenticationLog|null $auth */
        $auth = $this->authentications()->skip(1)->first();
        return $auth !== null ? $auth->ip_address : null;
    }

    /**
     * Calculate the number of consecutive days the user has logged in.
     *
     * @return int the number of consecutive days the user has logged in
     */
    public function consecutiveDaysLogin(): int
    {
        return once(function (): int {
            $date = Carbon::now();
            $days = 0;

            // Count the logins for the current day.
            $count = $this->authentications()->whereDate('login_at', $date)->count();

            while ($count > 0) {
                $date = $date->subDay();
                $count = $this->authentications()->whereDate('login_at', $date)->count();
                $days++;
            }

            return $days;
        });
    }
}
