<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\FailedImportRowResource\Pages;

<<<<<<< HEAD
use Override;
=======
>>>>>>> e1b0bf9 (.)
use Filament\Tables\Columns\TextColumn;
use Modules\Job\Filament\Resources\FailedImportRowResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListFailedImportRows extends XotBaseListRecords
{
    protected static string $resource = FailedImportRowResource::class;

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
            'import_id' => TextColumn::make('import_id')
                ->searchable()
                ->sortable()
                ->copyable(),
            'data' => TextColumn::make('data')
                ->searchable()
                ->wrap()
                ->limit(100),
            'validation_error' => TextColumn::make('validation_error')
                ->searchable()
                ->wrap()
                ->limit(200),
<<<<<<< HEAD
            'created_at' => TextColumn::make('created_at')->dateTime()->sortable(),
            'updated_at' => TextColumn::make('updated_at')->dateTime()->sortable(),
=======
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->dateTime()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
        ];
    }
}
