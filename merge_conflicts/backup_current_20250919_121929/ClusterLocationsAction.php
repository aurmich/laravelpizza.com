<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

use Modules\Geo\Datas\LocationData;
use Modules\Geo\Exceptions\InvalidLocationException;

<<<<<<< HEAD
readonly class ClusterLocationsAction
{
    public function __construct(
        private  CalculateDistanceAction $distanceCalculator,
=======
class ClusterLocationsAction
{
    public function __construct(
        private readonly CalculateDistanceAction $distanceCalculator,
>>>>>>> bc26394 (.)
    ) {}

    /**
     * Raggruppa le posizioni in cluster basati sulla distanza.
     *
     * @param  array<LocationData>  $locations  Lista delle posizioni da raggruppare
     * @param  float  $maxDistance  Distanza massima in km tra i punti di un cluster
     * @return array<array{center: LocationData, points: array<LocationData>}>
     *
     * @throws InvalidLocationException Se i dati della posizione non sono validi
     */
    public function execute(array $locations, float $maxDistance = 1.0): array
    {
        $clusters = [];

        foreach ($locations as $location) {
<<<<<<< HEAD
            if (!($location instanceof LocationData)) {
=======
            if (! $location instanceof LocationData) {
>>>>>>> bc26394 (.)
                throw InvalidLocationException::invalidData();
            }

            $assigned = false;

            foreach ($clusters as &$cluster) {
                $distance = $this->distanceCalculator->execute($cluster['center'], $location);
<<<<<<< HEAD
                $distanceKm = ((float) $distance['distance']['value']) / 1000;
=======
                $distanceKm = (float) $distance['distance']['value'] / 1000;
>>>>>>> bc26394 (.)

                if ($distanceKm <= $maxDistance) {
                    $cluster['points'][] = $location;
                    $this->updateClusterCenter($cluster);
                    $assigned = true;
                    break;
                }
            }

<<<<<<< HEAD
            if (!$assigned) {
=======
            if (! $assigned) {
>>>>>>> bc26394 (.)
                $clusters[] = [
                    'center' => $location,
                    'points' => [$location],
                ];
            }
        }

        return $clusters;
    }

    /**
     * Aggiorna il centro del cluster calcolando la media delle coordinate.
     *
     * @param  array{center: LocationData, points: array<LocationData>}  $cluster
     */
    private function updateClusterCenter(array &$cluster): void
    {
<<<<<<< HEAD
        $latSum = array_sum(array_map(fn(LocationData $point) => $point->latitude, $cluster['points']));

        $lonSum = array_sum(array_map(fn(LocationData $point) => $point->longitude, $cluster['points']));
=======
        $latSum = array_sum(array_map(
            fn (LocationData $point) => $point->latitude,
            $cluster['points']
        ));

        $lonSum = array_sum(array_map(
            fn (LocationData $point) => $point->longitude,
            $cluster['points']
        ));
>>>>>>> bc26394 (.)

        $count = count($cluster['points']);

        $cluster['center'] = new LocationData(
            latitude: $latSum / $count,
<<<<<<< HEAD
            longitude: $lonSum / $count,
=======
            longitude: $lonSum / $count
>>>>>>> bc26394 (.)
        );
    }
}
