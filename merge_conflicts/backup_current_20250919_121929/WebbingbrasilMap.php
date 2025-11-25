<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Pages;

use Modules\Geo\Filament\Widgets\WebbingbrasilMap as Map;
use Modules\Xot\Filament\Pages\XotBasePage;

class WebbingbrasilMap extends XotBasePage
{
<<<<<<< HEAD
    /**
     * @return array<class-string<\Filament\Widgets\Widget>|\Filament\Widgets\WidgetConfiguration>
     */
=======
>>>>>>> bc26394 (.)
    protected function getHeaderWidgets(): array
    {
        return [
            Map::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
