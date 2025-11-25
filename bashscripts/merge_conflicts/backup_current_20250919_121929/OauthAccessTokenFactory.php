<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\OauthAccessToken;
use Modules\User\Models\OauthClient;
use Modules\User\Models\User;

/**
 * OauthAccessToken Factory
<<<<<<< HEAD
 *
 * Factory for creating OauthAccessToken model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating OauthAccessToken model instances for testing and seeding.
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<OauthAccessToken>
 */
class OauthAccessTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<OauthAccessToken>
     */
    protected $model = OauthAccessToken::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'client_id' => OauthClient::factory(),
            'name' => $this->faker->optional()->words(2, true),
<<<<<<< HEAD
            'scopes' => $this->faker->optional()->randomElements(
                [
                    'read',
                    'write',
                    'admin',
                    'user',
                ],
                $this->faker->numberBetween(1, 3),
            ),
=======
            'scopes' => $this->faker->optional()->randomElements([
                'read', 'write', 'admin', 'user'
            ], $this->faker->numberBetween(1, 3)),
>>>>>>> fbc8f8e (.)
            'revoked' => $this->faker->boolean(10), // 10% revoked
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }

    /**
     * Create a revoked token.
     *
     * @return static
     */
    public function revoked(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'revoked' => true,
        ]);
    }

    /**
     * Create an active token.
     *
     * @return static
     */
    public function active(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'revoked' => false,
            'expires_at' => $this->faker->dateTimeBetween('+1 day', '+1 year'),
        ]);
    }

    /**
     * Create token for a specific user.
     *
     * @param User $user
     * @return static
     */
    public function forUser(User $user): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create token for a specific client.
     *
     * @param OauthClient $client
     * @return static
     */
    public function forClient(OauthClient $client): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'client_id' => $client->id,
        ]);
    }

    /**
     * Create token with specific scopes.
     *
     * @param array<string> $scopes
     * @return static
     */
    public function withScopes(array $scopes): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
            'scopes' => $scopes,
        ]);
    }
}
=======
        return $this->state(fn (array $attributes): array => [
            'scopes' => $scopes,
        ]);
    }
}
>>>>>>> fbc8f8e (.)
