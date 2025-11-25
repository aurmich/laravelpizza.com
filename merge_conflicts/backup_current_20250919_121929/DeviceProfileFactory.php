<?php

declare(strict_types=1);

namespace Modules\User\Database\Factories;

<<<<<<< HEAD
use Override;
=======
>>>>>>> fbc8f8e (.)
use Modules\User\Models\DeviceProfile;

/**
 * DeviceProfile Factory
<<<<<<< HEAD
 *
 * Factory for creating DeviceProfile model instances for testing and seeding.
 * Extends DeviceUserFactory since DeviceProfile extends DeviceUser.
 *
=======
 * 
 * Factory for creating DeviceProfile model instances for testing and seeding.
 * Extends DeviceUserFactory since DeviceProfile extends DeviceUser.
 * 
>>>>>>> fbc8f8e (.)
 */
class DeviceProfileFactory extends DeviceUserFactory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> fbc8f8e (.)
     * @var class-string<DeviceProfile>
     */
    protected $model = DeviceProfile::class;

    /**
     * Define the model's default state.
     * Inherits from DeviceUserFactory and adds profile-specific attributes.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    #[Override]
    public function definition(): array
    {
        return array_merge(
            parent::definition(),
            [
                // DeviceProfile-specific attributes can be added here if needed
            ],
        );
=======
    public function definition(): array
    {
        return array_merge(parent::definition(), [
            // DeviceProfile-specific attributes can be added here if needed
        ]);
>>>>>>> fbc8f8e (.)
    }
}
