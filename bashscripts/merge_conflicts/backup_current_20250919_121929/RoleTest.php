<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\Role;
use Modules\User\Models\Team;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_role_with_minimal_data(): void
    {
        $role = Role::factory()->create([
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);
    }

    public function test_can_create_role_with_all_fields(): void
    {
        $team = Team::factory()->create();
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        $roleData = [
            'name' => 'Full Role',
            'guard_name' => 'web',
            'team_id' => $team->id,
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
        ];

        $role = Role::factory()->create($roleData);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'Full Role',
            'guard_name' => 'web',
            'team_id' => $team->id,
            'uuid' => '550e8400-e29b-41d4-a716-446655440000',
        ]);
    }

    public function test_role_has_connection_attribute(): void
    {
        $role = new Role();

<<<<<<< HEAD
        static::assertSame('user', $role->connection);
=======
        $this->assertEquals('user', $role->connection);
>>>>>>> fbc8f8e (.)
    }

    public function test_role_has_key_type_attribute(): void
    {
        $role = new Role();

<<<<<<< HEAD
        static::assertSame('string', $role->keyType);
=======
        $this->assertEquals('string', $role->keyType);
>>>>>>> fbc8f8e (.)
    }

    public function test_role_constants_are_defined(): void
    {
<<<<<<< HEAD
        static::assertSame(1, Role::ROLE_ADMINISTRATOR);
        static::assertSame(2, Role::ROLE_OWNER);
        static::assertSame(3, Role::ROLE_USER);
=======
        $this->assertEquals(1, Role::ROLE_ADMINISTRATOR);
        $this->assertEquals(2, Role::ROLE_OWNER);
        $this->assertEquals(3, Role::ROLE_USER);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_role_by_name(): void
    {
        $role = Role::factory()->create(['name' => 'Unique Role Name']);

        $foundRole = Role::where('name', 'Unique Role Name')->first();

<<<<<<< HEAD
        static::assertNotNull($foundRole);
        static::assertSame($role->id, $foundRole->id);
=======
        $this->assertNotNull($foundRole);
        $this->assertEquals($role->id, $foundRole->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_role_by_guard_name(): void
    {
        Role::factory()->create(['guard_name' => 'web']);
        Role::factory()->create(['guard_name' => 'api']);
        Role::factory()->create(['guard_name' => 'web']);

        $webRoles = Role::where('guard_name', 'web')->get();

<<<<<<< HEAD
        static::assertCount(2, $webRoles);
        static::assertTrue($webRoles->every(fn($role) => $role->guard_name === 'web'));
=======
        $this->assertCount(2, $webRoles);
        $this->assertTrue($webRoles->every(fn ($role) => $role->guard_name === 'web'));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_role_by_team_id(): void
    {
        $team = Team::factory()->create();
        $role = Role::factory()->create(['team_id' => $team->id]);

        $foundRole = Role::where('team_id', $team->id)->first();

<<<<<<< HEAD
        static::assertNotNull($foundRole);
        static::assertSame($role->id, $foundRole->id);
=======
        $this->assertNotNull($foundRole);
        $this->assertEquals($role->id, $foundRole->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_role_by_uuid(): void
    {
        $uuid = '550e8400-e29b-41d4-a716-446655440000';
        $role = Role::factory()->create(['uuid' => $uuid]);

        $foundRole = Role::where('uuid', $uuid)->first();

<<<<<<< HEAD
        static::assertNotNull($foundRole);
        static::assertSame($role->id, $foundRole->id);
=======
        $this->assertNotNull($foundRole);
        $this->assertEquals($role->id, $foundRole->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_roles_by_name_pattern(): void
    {
        Role::factory()->create(['name' => 'Admin Role']);
        Role::factory()->create(['name' => 'User Role']);
        Role::factory()->create(['name' => 'Manager Role']);

        $adminRoles = Role::where('name', 'like', '%Role%')->get();

<<<<<<< HEAD
        static::assertCount(3, $adminRoles);
        static::assertTrue($adminRoles->every(fn($role) => str_contains($role->name, 'Role')));
=======
        $this->assertCount(3, $adminRoles);
        $this->assertTrue($adminRoles->every(fn ($role) => str_contains($role->name, 'Role')));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_update_role(): void
    {
        $role = Role::factory()->create(['name' => 'Old Name']);

        $role->update(['name' => 'New Name']);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'New Name',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $role = Role::factory()->create([
            'name' => 'Test Role',
            'guard_name' => 'web',
            'team_id' => null,
            'uuid' => null,
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'team_id' => null,
            'uuid' => null,
        ]);
    }

    public function test_can_find_roles_by_multiple_criteria(): void
    {
        $team = Team::factory()->create();
        Role::factory()->create([
            'name' => 'Admin Role',
            'guard_name' => 'web',
            'team_id' => $team->id,
        ]);

        Role::factory()->create([
            'name' => 'User Role',
            'guard_name' => 'api',
            'team_id' => $team->id,
        ]);

<<<<<<< HEAD
        $roles = Role::where('team_id', $team->id)->where('guard_name', 'web')->get();

        static::assertCount(1, $roles);
        static::assertSame('Admin Role', $roles->first()->name);
        static::assertSame('web', $roles->first()->guard_name);
=======
        $roles = Role::where('team_id', $team->id)
            ->where('guard_name', 'web')
            ->get();

        $this->assertCount(1, $roles);
        $this->assertEquals('Admin Role', $roles->first()->name);
        $this->assertEquals('web', $roles->first()->guard_name);
>>>>>>> fbc8f8e (.)
    }

    public function test_role_has_permissions_relationship(): void
    {
        $role = Role::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($role, 'permissions'));
=======
        $this->assertTrue(method_exists($role, 'permissions'));
>>>>>>> fbc8f8e (.)
    }

    public function test_role_has_team_relationship(): void
    {
        $role = Role::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($role, 'team'));
=======
        $this->assertTrue(method_exists($role, 'team'));
>>>>>>> fbc8f8e (.)
    }

    public function test_role_has_users_relationship(): void
    {
        $role = Role::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($role, 'users'));
=======
        $this->assertTrue(method_exists($role, 'users'));
>>>>>>> fbc8f8e (.)
    }

    public function test_role_can_use_permission_scopes(): void
    {
        $role = Role::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($role, 'permission'));
        static::assertTrue(method_exists($role, 'withoutPermission'));
=======
        $this->assertTrue(method_exists($role, 'permission'));
        $this->assertTrue(method_exists($role, 'withoutPermission'));
>>>>>>> fbc8f8e (.)
    }

    public function test_role_can_use_role_scopes(): void
    {
        $role = Role::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($role, 'role'));
        static::assertTrue(method_exists($role, 'withoutRole'));
    }
}
=======
        $this->assertTrue(method_exists($role, 'role'));
        $this->assertTrue(method_exists($role, 'withoutRole'));
    }
}







>>>>>>> fbc8f8e (.)
