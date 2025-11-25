<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Pages;

use Filament\Pages\Dashboard as FilamentDashboard;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

abstract class XotBaseDashboard extends FilamentDashboard
{
    use FilamentDashboard\Concerns\HasFiltersForm;

    protected static ?int $navigationSort = 1;

    protected bool $persistsFiltersInSession = true;

    final public function filtersForm(Schema $schema): Schema
    {
        /** @var array<Component> $filterSchema */
        $filterSchema = $this->getFiltersFormSchema();

        return $schema->components([
            Section::make()->schema($filterSchema)->columns(3),
        ]);
    }

    /**
     * @return array<Component>
     */
    public function getFiltersFormSchema(): array
    {
        return [];
    }
}
