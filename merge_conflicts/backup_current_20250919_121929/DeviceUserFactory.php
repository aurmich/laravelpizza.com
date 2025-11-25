<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Device;
use Modules\User\Models\DeviceUser;
use Modules\User\Models\User;

/**
 * DeviceUser Factory
<<<<<<< HEAD
 *
 * Factory for creating DeviceUser model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating DeviceUser model instances for testing and seeding.
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<DeviceUser>
 */
class DeviceUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<DeviceUser>
     */
    protected $model = DeviceUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loginAt = $this->faker->optional(0.8)->dateTimeBetween('-1 year', 'now');
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        return [
            'device_id' => Device::factory(),
            'user_id' => User::factory(),
            'login_at' => $loginAt,
            'logout_at' => $loginAt && $this->faker->boolean(60)
                ? $this->faker->dateTimeBetween($loginAt, 'now')
                : null,
        ];
    }

    /**
     * Create a device-user relationship for a specific user.
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
     * Create a device-user relationship for a specific device.
     *
     * @param Device $device
     * @return static
     */
    public function forDevice(Device $device): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'device_id' => $device->id,
        ]);
    }

    /**
     * Indicate that the user is currently logged in.
     *
     * @return static
     */
    public function loggedIn(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'login_at' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'logout_at' => null,
        ]);
    }

    /**
     * Indicate that the user is logged out.
     *
     * @return static
     */
    public function loggedOut(): static
    {
        $loginAt = $this->faker->dateTimeBetween('-1 month', '-1 day');
<<<<<<< HEAD

        return $this->state(fn(array $_attributes): array => [
=======
        
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'login_at' => $loginAt,
            'logout_at' => $this->faker->dateTimeBetween($loginAt, 'now'),
        ]);
    }
}
