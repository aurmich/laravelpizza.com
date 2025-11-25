<?php

declare(strict_types=1);

namespace Modules\Media\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Media\Models\TemporaryUpload;

/**
 * TemporaryUpload Factory
<<<<<<< HEAD
 *
 * Factory for creating TemporaryUpload model instances for testing and seeding.
 *
=======
 * 
 * Factory for creating TemporaryUpload model instances for testing and seeding.
 * 
>>>>>>> 0a466ed (.)
 * @extends Factory<TemporaryUpload>
 */
class TemporaryUploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 0a466ed (.)
     * @var class-string<TemporaryUpload>
     */
    protected $model = TemporaryUpload::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session_id' => $this->faker->uuid(),
        ];
    }

    /**
     * Create temporary upload for a specific session.
     *
     * @param string $sessionId
     * @return static
     */
    public function forSession(string $sessionId): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> 0a466ed (.)
            'session_id' => $sessionId,
        ]);
    }

    /**
     * Create temporary upload for current session.
     *
     * @return static
     */
    public function currentSession(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
            'session_id' => session()->getId(),
        ]);
    }
}
=======
        return $this->state(fn (array $attributes): array => [
            'session_id' => session()->getId(),
        ]);
    }
}
>>>>>>> 0a466ed (.)
