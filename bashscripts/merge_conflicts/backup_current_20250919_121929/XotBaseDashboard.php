<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> f1d4085 (.)
namespace Modules\Xot\Filament\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
<<<<<<< HEAD
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
=======
use Filament\Forms\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
>>>>>>> f1d4085 (.)
use Filament\Pages\Dashboard as FilamentDashboard;

abstract class XotBaseDashboard extends FilamentDashboard
{
    use FilamentDashboard\Concerns\HasFiltersForm;
<<<<<<< HEAD

    protected static null|int $navigationSort = 1;
=======
    protected static ?int $navigationSort = 1;
>>>>>>> f1d4085 (.)
    protected bool $persistsFiltersInSession = true;

    final public function filtersForm(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema->components([
            Section::make()->schema($this->getFiltersFormSchema())->columns(3),
        ]);
    }

    public function getFiltersFormSchema(): array
    {
        return [];
    }
}
=======
        return $schema
            ->components([
                Section::make()
                    ->schema($this->getFiltersFormSchema())
                    ->columns(3),
            ]);
    }


    public function getFiltersFormSchema():array{
        return [
           
        ];
    }
}



>>>>>>> f1d4085 (.)
