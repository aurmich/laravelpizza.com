<?php

declare(strict_types=1);

namespace Modules\Lang\Filament\Resources\Pages;
<<<<<<< HEAD

use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Cms\Filament\Resources\SectionResource;
=======
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Modules\Cms\Filament\Resources\SectionResource;
use Filament\Resources\Pages\EditRecord;
>>>>>>> 8b0b6ac (.)
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;

abstract class LangBaseEditRecord extends XotBaseEditRecord
{
<<<<<<< HEAD
    protected static string $resource; // = SectionResource::class;

    // use Translatable; // Temporaneamente commentato per compatibilità Filament 4.x
=======
    protected static string $resource;// = SectionResource::class;
    use Translatable;
>>>>>>> 8b0b6ac (.)

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            ...parent::getHeaderActions(),
            // ...
        ];
    }
}
