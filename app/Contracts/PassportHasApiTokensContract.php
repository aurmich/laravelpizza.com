<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token;
use Laravel\Passport\TransientToken;

/**
 * @phpstan-require-extends Model
 */
interface PassportHasApiTokensContract
{
    /**
     * Get all of the user's registered OAuth clients.
     *
     * @return HasMany
     */
    public function clients();

    /**
     * Get all of the access tokens for the user.
     *
     * @return HasMany
     */
    public function tokens();

    /**
     * Get the current access token being used by the user.
     *
     * @return Token|TransientToken|null
     */
    public function token(): Token|TransientToken|null;

    /**
     * Determine if the current API token has a given scope.
     *
     * @return bool
     */
    public function tokenCan(string $scope);

    /**
     * Create a new personal access token for the user.
     *
     * @param  array<int, string>  $scopes
     */
    public function createToken(string $name, array $scopes = []): PersonalAccessTokenResult;

    /**
     * Set the current access token for the user.
     *
     * @return $this
     */
    public function withAccessToken(Token|TransientToken $accessToken);
}
