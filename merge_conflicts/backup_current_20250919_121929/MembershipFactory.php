<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Membership;
use Modules\User\Models\Team;
use Modules\User\Models\User;

/**
 * Membership Factory
<<<<<<< HEAD
 *
 * Factory for creating Membership model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating Membership model instances for testing and seeding.
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<Membership>
     */
    protected $model = Membership::class;

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
            'role' => $this->faker->randomElement(['admin', 'editor', 'member', 'viewer']),
            'customer_id' => $this->faker->optional(0.3)->uuid(),
        ];
    }

    /**
     * Create membership for a specific team.
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
     * Create membership for a specific user.
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
     * Set the role to editor.
     *
     * @return static
     */
    public function editor(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'role' => 'editor',
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
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'role' => 'member',
        ]);
    }

    /**
     * Set the role to viewer.
     *
     * @return static
     */
    public function viewer(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
            'role' => 'viewer',
        ]);
    }
}
=======
        return $this->state(fn (array $attributes): array => [
            'role' => 'viewer',
        ]);
    }
}
>>>>>>> fbc8f8e (.)
