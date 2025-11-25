<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Widgets;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 727968c (.)
use Modules\Xot\Filament\Widgets\XotBaseWidget;

class GroupWidget extends XotBaseWidget
{
    public array $widgets = [];

<<<<<<< HEAD
    protected static null|string $pollingInterval = null;

    #[Override]
    public function getFormSchema(): array
    {
        return [];
    }
=======
    protected static ?string $pollingInterval = null;

    public function getFormSchema() :array {
        return [];
    }

>>>>>>> 727968c (.)
}
