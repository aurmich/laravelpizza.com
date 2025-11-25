<?php

declare(strict_types=1);

namespace Modules\User\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Models\Profile;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_profile_with_minimal_data(): void
    {
        $profile = Profile::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_name' => 'johndoe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_name' => 'johndoe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_can_create_profile_with_all_fields(): void
    {
        $profileData = [
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'user_name' => 'janesmith',
            'email' => 'jane@example.com',
            'phone' => '+1234567890',
            'bio' => 'Software Developer',
            'avatar' => 'avatar.jpg',
            'timezone' => 'UTC',
            'locale' => 'en',
            'preferences' => ['theme' => 'dark', 'notifications' => true],
            'status' => 'active',
            'extra' => ['skills' => ['PHP', 'Laravel'], 'experience' => 5],
        ];

        $profile = Profile::factory()->create($profileData);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'user_name' => 'janesmith',
            'email' => 'jane@example.com',
            'phone' => '+1234567890',
            'bio' => 'Software Developer',
            'avatar' => 'avatar.jpg',
            'timezone' => 'UTC',
            'locale' => 'en',
            'status' => 'active',
        ]);

        // Verifica campi JSON
<<<<<<< HEAD
        static::assertSame(['theme' => 'dark', 'notifications' => true], $profile->preferences);
        static::assertSame(['skills' => ['PHP', 'Laravel'], 'experience' => 5], $profile->extra);
=======
        $this->assertEquals(['theme' => 'dark', 'notifications' => true], $profile->preferences);
        $this->assertEquals(['skills' => ['PHP', 'Laravel'], 'experience' => 5], $profile->extra);
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_schemaless_attributes(): void
    {
        $profile = new Profile();

        $expectedAttributes = ['extra'];
<<<<<<< HEAD
        static::assertSame($expectedAttributes, $profile->getSchemalessAttributes());
=======
        $this->assertEquals($expectedAttributes, $profile->getSchemalessAttributes());
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_table_name(): void
    {
        $profile = new Profile();

<<<<<<< HEAD
        static::assertSame('profiles', $profile->getTable());
=======
        $this->assertEquals('profiles', $profile->getTable());
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_email(): void
    {
        $profile = Profile::factory()->create(['email' => 'unique@example.com']);

        $foundProfile = Profile::where('email', 'unique@example.com')->first();

<<<<<<< HEAD
        static::assertNotNull($foundProfile);
        static::assertSame($profile->id, $foundProfile->id);
=======
        $this->assertNotNull($foundProfile);
        $this->assertEquals($profile->id, $foundProfile->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_user_name(): void
    {
        $profile = Profile::factory()->create(['user_name' => 'uniqueuser']);

        $foundProfile = Profile::where('user_name', 'uniqueuser')->first();

<<<<<<< HEAD
        static::assertNotNull($foundProfile);
        static::assertSame($profile->id, $foundProfile->id);
=======
        $this->assertNotNull($foundProfile);
        $this->assertEquals($profile->id, $foundProfile->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_first_name(): void
    {
        $profile = Profile::factory()->create(['first_name' => 'Unique']);

        $foundProfile = Profile::where('first_name', 'Unique')->first();

<<<<<<< HEAD
        static::assertNotNull($foundProfile);
        static::assertSame($profile->id, $foundProfile->id);
=======
        $this->assertNotNull($foundProfile);
        $this->assertEquals($profile->id, $foundProfile->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_last_name(): void
    {
        $profile = Profile::factory()->create(['last_name' => 'Unique']);

        $foundProfile = Profile::where('last_name', 'Unique')->first();

<<<<<<< HEAD
        static::assertNotNull($foundProfile);
        static::assertSame($profile->id, $foundProfile->id);
=======
        $this->assertNotNull($foundProfile);
        $this->assertEquals($profile->id, $foundProfile->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_phone(): void
    {
        $profile = Profile::factory()->create(['phone' => '+1234567890']);

        $foundProfile = Profile::where('phone', '+1234567890')->first();

<<<<<<< HEAD
        static::assertNotNull($foundProfile);
        static::assertSame($profile->id, $foundProfile->id);
=======
        $this->assertNotNull($foundProfile);
        $this->assertEquals($profile->id, $foundProfile->id);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_status(): void
    {
        Profile::factory()->create(['status' => 'active']);
        Profile::factory()->create(['status' => 'inactive']);
        Profile::factory()->create(['status' => 'pending']);

        $activeProfiles = Profile::where('status', 'active')->get();

<<<<<<< HEAD
        static::assertCount(1, $activeProfiles);
        static::assertSame('active', $activeProfiles->first()->status);
=======
        $this->assertCount(1, $activeProfiles);
        $this->assertEquals('active', $activeProfiles->first()->status);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_timezone(): void
    {
        Profile::factory()->create(['timezone' => 'UTC']);
        Profile::factory()->create(['timezone' => 'Europe/Rome']);
        Profile::factory()->create(['timezone' => 'America/New_York']);

        $utcProfiles = Profile::where('timezone', 'UTC')->get();

<<<<<<< HEAD
        static::assertCount(1, $utcProfiles);
        static::assertSame('UTC', $utcProfiles->first()->timezone);
=======
        $this->assertCount(1, $utcProfiles);
        $this->assertEquals('UTC', $utcProfiles->first()->timezone);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profile_by_locale(): void
    {
        Profile::factory()->create(['locale' => 'en']);
        Profile::factory()->create(['locale' => 'it']);
        Profile::factory()->create(['locale' => 'de']);

        $englishProfiles = Profile::where('locale', 'en')->get();

<<<<<<< HEAD
        static::assertCount(1, $englishProfiles);
        static::assertSame('en', $englishProfiles->first()->locale);
=======
        $this->assertCount(1, $englishProfiles);
        $this->assertEquals('en', $englishProfiles->first()->locale);
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profiles_by_name_pattern(): void
    {
        Profile::factory()->create(['first_name' => 'John', 'last_name' => 'Doe']);
        Profile::factory()->create(['first_name' => 'Jane', 'last_name' => 'Doe']);
        Profile::factory()->create(['first_name' => 'Bob', 'last_name' => 'Smith']);

        $doeProfiles = Profile::where('last_name', 'like', '%Doe%')->get();

<<<<<<< HEAD
        static::assertCount(2, $doeProfiles);
        static::assertTrue($doeProfiles->every(fn($profile) => str_contains($profile->last_name, 'Doe')));
=======
        $this->assertCount(2, $doeProfiles);
        $this->assertTrue($doeProfiles->every(fn ($profile) => str_contains($profile->last_name, 'Doe')));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_find_profiles_by_bio_pattern(): void
    {
        Profile::factory()->create(['bio' => 'Software Developer']);
        Profile::factory()->create(['bio' => 'Designer']);
        Profile::factory()->create(['bio' => 'Product Manager']);

        $devProfiles = Profile::where('bio', 'like', '%Developer%')->get();

<<<<<<< HEAD
        static::assertCount(1, $devProfiles);
        static::assertTrue($devProfiles->every(fn($profile) => str_contains($profile->bio, 'Developer')));
=======
        $this->assertCount(1, $devProfiles);
        $this->assertTrue($devProfiles->every(fn ($profile) => str_contains($profile->bio, 'Developer')));
>>>>>>> fbc8f8e (.)
    }

    public function test_can_update_profile(): void
    {
        $profile = Profile::factory()->create(['first_name' => 'Old Name']);

        $profile->update(['first_name' => 'New Name']);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'first_name' => 'New Name',
        ]);
    }

    public function test_can_handle_null_values(): void
    {
        $profile = Profile::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'user_name' => 'testuser',
            'email' => 'test@example.com',
            'phone' => null,
            'bio' => null,
            'avatar' => null,
            'timezone' => null,
            'locale' => null,
        ]);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'phone' => null,
            'bio' => null,
            'avatar' => null,
            'timezone' => null,
            'locale' => null,
        ]);
    }

    public function test_can_find_profiles_by_multiple_criteria(): void
    {
        Profile::factory()->create([
            'status' => 'active',
            'timezone' => 'UTC',
            'locale' => 'en',
        ]);

        Profile::factory()->create([
            'status' => 'active',
            'timezone' => 'Europe/Rome',
            'locale' => 'it',
        ]);

        Profile::factory()->create([
            'status' => 'inactive',
            'timezone' => 'UTC',
            'locale' => 'en',
        ]);

<<<<<<< HEAD
        $profiles = Profile::where('status', 'active')->where('timezone', 'UTC')->get();

        static::assertCount(1, $profiles);
        static::assertSame('active', $profiles->first()->status);
        static::assertSame('UTC', $profiles->first()->timezone);
=======
        $profiles = Profile::where('status', 'active')
            ->where('timezone', 'UTC')
            ->get();

        $this->assertCount(1, $profiles);
        $this->assertEquals('active', $profiles->first()->status);
        $this->assertEquals('UTC', $profiles->first()->timezone);
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_roles_relationship(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'roles'));
=======
        $this->assertTrue(method_exists($profile, 'roles'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_permissions_relationship(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'permissions'));
=======
        $this->assertTrue(method_exists($profile, 'permissions'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_teams_relationship(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'teams'));
=======
        $this->assertTrue(method_exists($profile, 'teams'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_devices_relationship(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'devices'));
=======
        $this->assertTrue(method_exists($profile, 'devices'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_media_relationship(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'media'));
=======
        $this->assertTrue(method_exists($profile, 'media'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_can_use_permission_scopes(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'permission'));
        static::assertTrue(method_exists($profile, 'withoutPermission'));
=======
        $this->assertTrue(method_exists($profile, 'permission'));
        $this->assertTrue(method_exists($profile, 'withoutPermission'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_can_use_role_scopes(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'role'));
        static::assertTrue(method_exists($profile, 'withoutRole'));
=======
        $this->assertTrue(method_exists($profile, 'role'));
        $this->assertTrue(method_exists($profile, 'withoutRole'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_can_use_extra_attributes_scopes(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertTrue(method_exists($profile, 'withExtraAttributes'));
=======
        $this->assertTrue(method_exists($profile, 'withExtraAttributes'));
>>>>>>> fbc8f8e (.)
    }

    public function test_profile_has_factory(): void
    {
        $profile = Profile::factory()->create();

<<<<<<< HEAD
        static::assertNotNull($profile->id);
        static::assertInstanceOf(Profile::class, $profile);
    }
}
=======
        $this->assertNotNull($profile->id);
        $this->assertInstanceOf(Profile::class, $profile);
    }
}







>>>>>>> fbc8f8e (.)
