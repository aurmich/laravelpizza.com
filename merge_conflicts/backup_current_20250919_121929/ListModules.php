<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\ModuleResource\Pages;

<<<<<<< HEAD
use Filament\Actions\BulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Override;
=======
>>>>>>> f1d4085 (.)
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
<<<<<<< HEAD
=======
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> f1d4085 (.)
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Modules\UI\Enums\TableLayoutEnum;
use Modules\Xot\Filament\Resources\ModuleResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Nwidart\Modules\Facades\Module;

=======
use Nwidart\Modules\Facades\Module;

use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

>>>>>>> f1d4085 (.)
class ListModules extends XotBaseListRecords
{
    public TableLayoutEnum $layoutView = TableLayoutEnum::LIST;

    protected static string $resource = ModuleResource::class;

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    public function getGridTableColumns(): array
    {
        return [
            Stack::make($this->getTableColumns()),
        ];
    }

    /**
     * @return array<string, Tables\Columns\Column>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')->searchable()->sortable(),
            'path' => TextColumn::make('path')->searchable()->sortable(),
            'enabled' => TextColumn::make('enabled')->sortable(),
=======
    public function getTableColumns(): array
    {
        return [
            'name' => TextColumn::make('name')
                ->searchable()
                ->sortable(),
            'path' => TextColumn::make('path')
                ->searchable()
                ->sortable(),
            'enabled' => TextColumn::make('enabled')
                ->sortable(),
>>>>>>> f1d4085 (.)
        ];
    }

    /**
     * Undocumented function.
     *
     * @return array<BaseFilter>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    public function getTableFilters(): array
    {
        return [
            // Tables\Filters\SelectFilter::make('name')->options(
            //    Module::pluck('name', 'name')->toArray()
            // ),
            // Tables\Filters\SelectFilter::make('status')->options([
            //    'enabled' => 'Enabled',
            //    'disabled' => 'Disabled',
            // ])->default('enabled'),
        ];
    }

    /**
     * Undocumented function.
     *
     * @return array<Action|ActionGroup>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableActions(): array
    {
        return [
            ViewAction::make(),
            EditAction::make(),
            DeleteAction::make()->requiresConfirmation(),
=======
    public function getTableActions(): array
    {
        return [
            ViewAction::make()
                ,
            EditAction::make()
                ,
            DeleteAction::make()

                ->requiresConfirmation(),
>>>>>>> f1d4085 (.)
        ];
    }

    /**
<<<<<<< HEAD
     * @return array<string, BulkAction>
     */
    #[Override]
=======
     * @return array<string, \Filament\Actions\BulkAction>
     */
>>>>>>> f1d4085 (.)
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }
}
