<?php

declare(strict_types=1);

namespace Modules\Geo\Actions;

class GetBoundingBoxAction
{
<<<<<<< HEAD
    public function execute(float $latitude, float $longitude, float $distanceKm): array
    {
=======
    public function execute(
        float $latitude,
        float $longitude,
        float $distanceKm,
    ): array {
>>>>>>> bc26394 (.)
        $earthRadius = 6371; // km

        $maxLat = $latitude + rad2deg($distanceKm / $earthRadius);
        $minLat = $latitude - rad2deg($distanceKm / $earthRadius);

<<<<<<< HEAD
        $maxLon = $longitude + rad2deg(($distanceKm / $earthRadius) / cos(deg2rad($latitude)));
        $minLon = $longitude - rad2deg(($distanceKm / $earthRadius) / cos(deg2rad($latitude)));
=======
        $maxLon = $longitude + rad2deg($distanceKm / $earthRadius / cos(deg2rad($latitude)));
        $minLon = $longitude - rad2deg($distanceKm / $earthRadius / cos(deg2rad($latitude)));
>>>>>>> bc26394 (.)

        return [
            'min_lat' => $minLat,
            'max_lat' => $maxLat,
            'min_lon' => $minLon,
            'max_lon' => $maxLon,
        ];
    }
}
