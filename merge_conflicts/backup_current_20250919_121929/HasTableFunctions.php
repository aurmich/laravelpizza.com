<?php

declare(strict_types=1);

namespace Modules\Xot\Interfaces;

<<<<<<< HEAD
use Filament\Actions\BulkAction;
=======
>>>>>>> f1d4085 (.)
use Filament\Tables\Columns\Column;
use Filament\Actions\Action;

interface HasTableFunctions
{
    /**
     * Get the table columns for the list view.
     *
     * @return array<string, Column>
     */
    public function getTableColumns(): array;

    /**
     * Get the table actions.
     *
     * @return array<string, Action>
     */
    public function getTableActions(): array;

    /**
     * Get the table bulk actions.
     *
<<<<<<< HEAD
     * @return array<string, BulkAction>
=======
     * @return array<string, \Filament\Actions\BulkAction>
>>>>>>> f1d4085 (.)
     */
    public function getTableBulkActions(): array;
}
