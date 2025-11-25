<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use Filament\Resources\Pages\CreateRecord;
use Modules\Cms\Filament\Resources\PageContentResource;

class CreatePageContent extends CreateRecord
{
<<<<<<< HEAD
    // use Translatable; // Temporaneamente commentato per compatibilità Filament 4.x
=======
    use Translatable;
>>>>>>> 3401a6b (.)

    protected static string $resource = PageContentResource::class;
}
