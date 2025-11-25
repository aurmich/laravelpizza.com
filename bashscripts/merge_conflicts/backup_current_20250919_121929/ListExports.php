<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\ExportResource\Pages;

<<<<<<< HEAD
use Override;
=======
>>>>>>> e1b0bf9 (.)
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Modules\Job\Filament\Resources\ExportResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListExports extends XotBaseListRecords
{
    protected static string $resource = ExportResource::class;

    /**
     * @return array<string, Column>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> e1b0bf9 (.)
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->numeric()
                ->sortable()
                ->searchable(),
<<<<<<< HEAD
            'name' => TextColumn::make('name')->sortable()->searchable(),
            'status' => TextColumn::make('status')->sortable()->searchable(),
=======
            'name' => TextColumn::make('name')
                ->sortable()
                ->searchable(),
            'status' => TextColumn::make('status')
                ->sortable()
                ->searchable(),
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
}
