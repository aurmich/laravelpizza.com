<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Team;
use Modules\User\Models\TeamUser;
use Modules\User\Models\User;

/**
 * TeamUser Factory
<<<<<<< HEAD
 *
 * Factory for creating TeamUser model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating TeamUser model instances for testing and seeding.
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<TeamUser>
 */
class TeamUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<TeamUser>
     */
    protected $model = TeamUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['owner', 'admin', 'editor', 'member']),
        ];
    }

    /**
     * Create team-user relationship for a specific team.
     *
     * @param Team $team
     * @return static
     */
    public function forTeam(Team $team): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'team_id' => $team->id,
        ]);
    }

    /**
     * Create team-user relationship for a specific user.
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
     * Set the role to owner.
     *
     * @return static
     */
    public function owner(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'role' => 'owner',
        ]);
    }

    /**
     * Set the role to admin.
     *
     * @return static
     */
    public function admin(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'role' => 'admin',
        ]);
    }

    /**
     * Set the role to member.
     *
     * @return static
     */
    public function member(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
            'role' => 'member',
        ]);
    }
}
=======
        return $this->state(fn (array $attributes): array => [
            'role' => 'member',
        ]);
    }
}
>>>>>>> fbc8f8e (.)
