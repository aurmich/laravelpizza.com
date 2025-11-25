<?php

declare(strict_types=1);

/**
 * @see RyanChandler\FilamentNavigation\Filament\Fields\NavigationSelect;
 * @see https://github.com/ryangjchandler/filament-navigation
 */

namespace Modules\UI\Filament\Forms\Components;

use Filament\Forms\Components\Select;

// use RyanChandler\FilamentNavigation\Models\Navigation;

class ParentSelect extends Select
{
    protected string $optionValueProperty = 'id';

    protected function setUp(): void
    {
        parent::setUp();

        // dddx($this->getModel());
<<<<<<< HEAD
        $this->options(static fn(ParentSelect $_component): array => ['a' => 'a', 'b' => 'b']);
=======
        $this->options(static fn (ParentSelect $component): array => ['a' => 'a', 'b' => 'b']);
>>>>>>> 727968c (.)
    }

    public function getOptionValueProperty(): string
    {
        return $this->optionValueProperty;
    }
}
