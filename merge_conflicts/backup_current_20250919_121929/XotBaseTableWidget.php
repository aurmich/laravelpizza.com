<?php

<<<<<<< HEAD
declare(strict_types=1);


namespace Modules\Xot\Filament\Widgets;

use Filament\Widgets\TableWidget as FilamentTableWidget;
use Modules\Xot\Filament\Traits\TransTrait;
=======
namespace Modules\Xot\Filament\Widgets;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Widgets\TableWidget as FilamentTableWidget;
>>>>>>> f1d4085 (.)

abstract class XotBaseTableWidget extends FilamentTableWidget
{
    use TransTrait;
}
