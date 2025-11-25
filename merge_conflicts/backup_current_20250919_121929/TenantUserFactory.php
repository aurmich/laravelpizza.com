<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< HEAD
use Modules\User\Models\Tenant;
use Modules\User\Models\TenantUser;
=======
use Modules\User\Models\TenantUser;
use Modules\User\Models\Tenant;
>>>>>>> fbc8f8e (.)
use Modules\User\Models\User;

/**
 * TenantUser Factory
<<<<<<< HEAD
 *
 * Factory for creating TenantUser model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating TenantUser model instances for testing and seeding.
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<TenantUser>
 */
class TenantUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<TenantUser>
     */
    protected $model = TenantUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Create tenant-user relationship for a specific tenant.
     *
     * @param Tenant $tenant
     * @return static
     */
    public function forTenant(Tenant $tenant): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> fbc8f8e (.)
            'tenant_id' => $tenant->id,
        ]);
    }

    /**
     * Create tenant-user relationship for a specific user.
     *
     * @param User $user
     * @return static
     */
    public function forUser(User $user): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
            'user_id' => $user->id,
        ]);
    }
}
=======
        return $this->state(fn (array $attributes): array => [
            'user_id' => $user->id,
        ]);
    }
}
>>>>>>> fbc8f8e (.)
