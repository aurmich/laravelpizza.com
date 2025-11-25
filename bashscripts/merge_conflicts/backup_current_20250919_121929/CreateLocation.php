<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\LocationResource\Pages;

<<<<<<< HEAD
// use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps; // Pacchetto non installato
=======
use Cheesegrits\FilamentGoogleMaps\Concerns\InteractsWithMaps;
>>>>>>> bc26394 (.)
use Filament\Resources\Pages\CreateRecord;
use Modules\Geo\Filament\Resources\LocationResource;
use Webmozart\Assert\Assert;

class CreateLocation extends CreateRecord
{
<<<<<<< HEAD
    // use InteractsWithMaps; // Pacchetto non installato
=======
    use InteractsWithMaps;
>>>>>>> bc26394 (.)

    protected static string $resource = LocationResource::class;

    protected function getRedirectUrl(): string
    {
        Assert::string($url = $this->getResource()::getUrl('index'));

        return $url;
    }
}
