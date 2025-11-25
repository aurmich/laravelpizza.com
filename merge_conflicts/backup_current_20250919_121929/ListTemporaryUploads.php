<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\TemporaryUploadResource\Pages;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 0a466ed (.)
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Media\Filament\Resources\TemporaryUploadResource;
use Modules\Media\Models\TemporaryUpload;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListTemporaryUploads extends XotBaseListRecords
{
    protected static string $resource = TemporaryUploadResource::class;

    /**
     * @return array<string, TextColumn>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a466ed (.)
    public function getTableColumns(): array
    {
        return [
            'folder' => TextColumn::make('folder')
                ->searchable()
                ->sortable()
                ->wrap(),
            'filename' => TextColumn::make('filename')
                ->searchable()
                ->sortable()
                ->wrap(),
<<<<<<< HEAD
            'created_at' => TextColumn::make('created_at')->dateTime()->sortable(),
=======
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
>>>>>>> 0a466ed (.)
        ];
    }

    /**
     * @return array<string, SelectFilter>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableFilters(): array
    {
        return [
            'folder' => SelectFilter::make('folder')->options(TemporaryUpload::distinct()->pluck(
                'folder',
                'folder',
            )->toArray(...)),
=======
    public function getTableFilters(): array
    {
        return [
            'folder' => SelectFilter::make('folder')
                ->options(fn () => TemporaryUpload::distinct()->pluck('folder', 'folder')->toArray()),
>>>>>>> 0a466ed (.)
        ];
    }

    /**
     * @return array<string, ViewAction|EditAction|DeleteAction>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a466ed (.)
    public function getTableActions(): array
    {
        return [
            'view' => ViewAction::make(),
            'edit' => EditAction::make(),
            'delete' => DeleteAction::make(),
        ];
    }

    /**
<<<<<<< HEAD
     * @return array<string, DeleteBulkAction>
     */
    #[Override]
=======
     * @return array<string, \Filament\Actions\DeleteBulkAction>
     */
>>>>>>> 0a466ed (.)
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }
}
