<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\ImportResource\Pages;

<<<<<<< HEAD
use Filament\Actions\BulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Override;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
=======
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
>>>>>>> e1b0bf9 (.)
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Modules\Job\Filament\Resources\ImportResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListImports extends XotBaseListRecords
{
    protected static string $resource = ImportResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->searchable()->sortable(),
=======
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->searchable()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
            'file_name' => TextColumn::make('file_name')
                ->searchable()
                ->sortable()
                ->wrap(),
<<<<<<< HEAD
            'file_disk' => TextColumn::make('file_disk')->searchable()->sortable(),
            'importer' => TextColumn::make('importer')->searchable()->sortable(),
            'processed_rows' => TextColumn::make('processed_rows')->numeric()->sortable(),
            'total_rows' => TextColumn::make('total_rows')->numeric()->sortable(),
            'successful_rows' => TextColumn::make('successful_rows')->numeric()->sortable(),
            'completed_at' => TextColumn::make('completed_at')->dateTime()->sortable(),
=======
            'file_disk' => TextColumn::make('file_disk')
                ->searchable()
                ->sortable(),
            'importer' => TextColumn::make('importer')
                ->searchable()
                ->sortable(),
            'processed_rows' => TextColumn::make('processed_rows')
                ->numeric()
                ->sortable(),
            'total_rows' => TextColumn::make('total_rows')
                ->numeric()
                ->sortable(),
            'successful_rows' => TextColumn::make('successful_rows')
                ->numeric()
                ->sortable(),
            'completed_at' => TextColumn::make('completed_at')
                ->dateTime()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    /**
     * @return array<string, BaseFilter>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableFilters(): array
    {
        return [];
=======
    public function getTableFilters(): array
    {
        return [
        ];
>>>>>>> e1b0bf9 (.)
    }

    /**
     * @return array<string, Action|ActionGroup>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableActions(): array
    {
        return [
            'edit' => EditAction::make(),
=======
    public function getTableActions(): array
    {
        return [
            'edit' => EditAction::make()
                ,
>>>>>>> e1b0bf9 (.)
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
>>>>>>> e1b0bf9 (.)
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }
}
