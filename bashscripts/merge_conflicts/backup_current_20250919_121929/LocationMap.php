<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

<<<<<<< HEAD
// use Modules\Geo\Filament\Widgets\LocationMapWidget; // Widget disabilitato per compatibilità Filament v4
=======
use Modules\Geo\Filament\Widgets\LocationMapWidget;
>>>>>>> bc26394 (.)
use Modules\Geo\Filament\Widgets;
use Modules\Xot\Filament\Pages\XotBasePage;

class LocationMap extends XotBasePage
{
    protected function getHeaderWidgets(): array
    {
        return [
<<<<<<< HEAD
            // LocationMapWidget::class, // Widget disabilitato per compatibilità Filament v4
=======
            LocationMapWidget::class,
>>>>>>> bc26394 (.)
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
