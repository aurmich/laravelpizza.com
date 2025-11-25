<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\User\Models\RoleHasPermission;

/**
 * RoleHasPermission Factory
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> fbc8f8e (.)
 * @extends Factory<RoleHasPermission>
 */
class RoleHasPermissionFactory extends Factory
{
    protected $model = RoleHasPermission::class;

    public function definition(): array
    {
        return [
<<<<<<< HEAD
            'permission_id' => fn() => Permission::create([
                'name' => fake()->unique()->slug(),
                'guard_name' => 'web',
            ])->id,
            'role_id' => fn() => Role::create([
                'name' => fake()->unique()->slug(),
                'guard_name' => 'web',
            ])->id,
=======
            'permission_id' => Permission::factory(),
            'role_id' => Role::factory(),
>>>>>>> fbc8f8e (.)
        ];
    }

    public function forPermission(Permission $permission): static
    {
        return $this->state(['permission_id' => $permission->id]);
    }

    public function forRole(Role $role): static
    {
        return $this->state(['role_id' => $role->id]);
    }
}
