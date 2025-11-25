<?php

declare(strict_types=1);

namespace Modules\Geo\Contracts;

interface GeocodingServiceInterface
{
    /**
     * Get coordinates from address.
     *
     * @return array{latitude: float, longitude: float}|null
     */
<<<<<<< HEAD
    public function getCoordinates(string $address): null|array;
=======
    public function getCoordinates(string $address): ?array;
>>>>>>> bc26394 (.)
}
