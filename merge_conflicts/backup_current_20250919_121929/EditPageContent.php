<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageContentResource\Pages;

use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Cms\Filament\Resources\PageContentResource;

class EditPageContent extends EditRecord
{
<<<<<<< HEAD
    // use Translatable; // Temporaneamente commentato per compatibilità Filament 4.x
=======
    use Translatable;
>>>>>>> 3401a6b (.)

    protected static string $resource = PageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}
