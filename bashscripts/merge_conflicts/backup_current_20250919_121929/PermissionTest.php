<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_permission_with_minimal_data(): void
    {
        $permission = Permission::factory()->create([
            'name' => 'test.permission',
            'guard_name' => 'web',
        ]);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'test.permission',
            'guard_name' => 'web',
        ]);
    }

    public function test_can_create_permission_with_all_fields(): void
    {
        $permissionData = [
            'name' => 'full.permission',
            'guard_name' => 'web',
            'created_by' => 'user123',
            'updated_by' => 'user456',
        ];

        $permission = Permission::factory()->create($permissionData);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'full.permission',
            'guard_name' => 'web',
            'created_by' => 'user123',
            'updated_by' => 'user456',
        ]);
    }

    public function test_permission_has_connection_attribute(): void
    {
        $permission = new Permission();

<<<<<<< HEAD
        static::assertSame('user', $permission->connection);
=======
        $this->assertEquals('user', $permission->connection);
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_key_type_attribute(): void
    {
        $permission = new Permission();

<<<<<<< HEAD
        static::assertSame('string', $permission->keyType);
=======
        $this->assertEquals('string', $permission->keyType);
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_fillable_attributes(): void
    {
        $permission = new Permission();

        $expectedFillable = [
            'id',
            'name',
            'guard_name',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ];

<<<<<<< HEAD
        static::assertSame($expectedFillable, $permission->getFillable());
=======
        $this->assertEquals($expectedFillable, $permission->getFillable());
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_casts(): void
    {
        $permission = new Permission();

        $expectedCasts = [
            'id' => 'string',
            'uuid' => 'string',
            'name' => 'string',
            'guard_name' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];

<<<<<<< HEAD
        static::assertSame($expectedCasts, $permission->getCasts());
=======
        $this->assertEquals($expectedCasts, $permission->getCasts());
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_permission_by_name(): void
    {
        $permission = Permission::factory()->create(['name' => 'unique.permission']);

        $foundPermission = Permission::where('name', 'unique.permission')->first();

<<<<<<< HEAD
        static::assertNotNull($foundPermission);
        static::assertSame($permission->id, $foundPermission->id);
=======
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_permission_by_guard_name(): void
    {
        Permission::factory()->create(['guard_name' => 'web']);
        Permission::factory()->create(['guard_name' => 'api']);
        Permission::factory()->create(['guard_name' => 'web']);

        $webPermissions = Permission::where('guard_name', 'web')->get();

<<<<<<< HEAD
        static::assertCount(2, $webPermissions);
        static::assertTrue($webPermissions->every(fn($permission) => $permission->guard_name === 'web'));
=======
        $this->assertCount(2, $webPermissions);
        $this->assertTrue($webPermissions->every(fn ($permission) => $permission->guard_name === 'web'));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_permission_by_created_by(): void
    {
        $permission = Permission::factory()->create(['created_by' => 'user123']);

        $foundPermission = Permission::where('created_by', 'user123')->first();

<<<<<<< HEAD
        static::assertNotNull($foundPermission);
        static::assertSame($permission->id, $foundPermission->id);
=======
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_permission_by_updated_by(): void
    {
        $permission = Permission::factory()->create(['updated_by' => 'user456']);

        $foundPermission = Permission::where('updated_by', 'user456')->first();

<<<<<<< HEAD
        static::assertNotNull($foundPermission);
        static::assertSame($permission->id, $foundPermission->id);
=======
        $this->assertNotNull($foundPermission);
        $this->assertEquals($permission->id, $foundPermission->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_permissions_by_name_pattern(): void
    {
        Permission::factory()->create(['name' => 'user.create']);
        Permission::factory()->create(['name' => 'user.update']);
        Permission::factory()->create(['name' => 'user.delete']);
        Permission::factory()->create(['name' => 'post.read']);

        $userPermissions = Permission::where('name', 'like', 'user.%')->get();

<<<<<<< HEAD
        static::assertCount(3, $userPermissions);
        static::assertTrue($userPermissions->every(fn($permission) => str_starts_with($permission->name, 'user.')));
=======
        $this->assertCount(3, $userPermissions);
        $this->assertTrue($userPermissions->every(fn ($permission) => str_starts_with($permission->name, 'user.')));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_update_permission(): void
    {
        $permission = Permission::factory()->create(['name' => 'old.permission']);

        $permission->update(['name' => 'new.permission']);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => 'new.permission',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $permission = Permission::factory()->create([
            'name' => 'test.permission',
            'guard_name' => 'web',
            'created_by' => null,
            'updated_by' => null,
        ]);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'created_by' => null,
            'updated_by' => null,
        ]);
    }

    public function test_can_find_permissions_by_multiple_criteria(): void
    {
        Permission::factory()->create([
            'name' => 'admin.user.create',
            'guard_name' => 'web',
            'created_by' => 'admin',
        ]);

        Permission::factory()->create([
            'name' => 'admin.user.update',
            'guard_name' => 'api',
            'created_by' => 'admin',
        ]);

<<<<<<< HEAD
        $permissions = Permission::where('name', 'like', 'admin.user.%')->where('created_by', 'admin')->get();

        static::assertCount(2, $permissions);
        static::assertTrue($permissions->every(
            fn($permission) => str_starts_with($permission->name, 'admin.user.') && $permission->created_by === 'admin',
=======
        $permissions = Permission::where('name', 'like', 'admin.user.%')
            ->where('created_by', 'admin')
            ->get();

        $this->assertCount(2, $permissions);
        $this->assertTrue($permissions->every(fn ($permission) => 
            str_starts_with($permission->name, 'admin.user.') && $permission->created_by === 'admin'
>>>>>>> fbc8f8e (.)
        ));
    }

    public function test_permission_has_roles_relationship(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'roles'));
=======
        $this->assertTrue(method_exists($permission, 'roles'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_users_relationship(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'users'));
=======
        $this->assertTrue(method_exists($permission, 'users'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_can_use_role_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'role'));
=======
        $this->assertTrue(method_exists($permission, 'role'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_can_use_permission_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'permission'));
        static::assertTrue(method_exists($permission, 'withoutPermission'));
=======
        $this->assertTrue(method_exists($permission, 'permission'));
        $this->assertTrue(method_exists($permission, 'withoutPermission'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_can_use_without_role_scopes(): void
    {
        $permission = Permission::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'withoutRole'));
=======
        $this->assertTrue(method_exists($permission, 'withoutRole'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_factory_method(): void
    {
        $permission = new Permission();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'newFactory'));
=======
        $this->assertTrue(method_exists($permission, 'newFactory'));
>>>>>>> fbc8f8e (.)
    }

    public function test_permission_has_get_table_method(): void
    {
        $permission = new Permission();

<<<<<<< HEAD
        static::assertTrue(method_exists($permission, 'getTable'));
    }
}
=======
        $this->assertTrue(method_exists($permission, 'getTable'));
    }
}







>>>>>>> fbc8f8e (.)
