<?php

declare(strict_types=1);

namespace Modules\Geo\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Geo\Models\State;

/**
 * State Factory
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> bc26394 (.)
 * @extends Factory<State>
 */
class StateFactory extends Factory
{
    protected $model = State::class;

    public function definition(): array
    {
        $italianRegions = [
            'Lazio' => 'LAZ',
            'Lombardia' => 'LOM',
            'Campania' => 'CAM',
            'Sicilia' => 'SIC',
            'Veneto' => 'VEN',
            'Piemonte' => 'PIE',
            'Emilia-Romagna' => 'EMR',
            'Toscana' => 'TOS',
            'Puglia' => 'PUG',
<<<<<<< HEAD
            'Calabria' => 'CAL',
=======
            'Calabria' => 'CAL'
>>>>>>> bc26394 (.)
        ];

        $state = $this->faker->randomElement(array_keys($italianRegions));

        return [
            'state' => $state,
<<<<<<< HEAD
            'state_code' => is_string($state) && isset($italianRegions[$state]) ? $italianRegions[$state] : 'XX',
=======
            'state_code' => $italianRegions[$state],
>>>>>>> bc26394 (.)
        ];
    }

    public function lombardia(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> bc26394 (.)
            'state' => 'Lombardia',
            'state_code' => 'LOM',
        ]);
    }

    public function lazio(): static
    {
<<<<<<< HEAD
        return $this->state(fn(array $_attributes): array => [
=======
        return $this->state(fn (array $attributes): array => [
>>>>>>> bc26394 (.)
            'state' => 'Lazio',
            'state_code' => 'LAZ',
        ]);
    }
}
