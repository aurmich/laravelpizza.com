<?php

/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\JobManagerResource\Pages;

<<<<<<< HEAD
use Filament\Actions\BulkAction;
use Override;
=======
>>>>>>> e1b0bf9 (.)
use Filament\Actions\DeleteBulkAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Modules\Job\Filament\Resources\JobManagerResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListJobManagers extends XotBaseListRecords
{
    protected static string $resource = JobManagerResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
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
            'queue' => TextColumn::make('queue')->sortable()->searchable(),
            'payload' => TextColumn::make('payload')->wrap()->searchable(),
            'attempts' => TextColumn::make('attempts')->numeric()->sortable(),
            'reserved_at' => TextColumn::make('reserved_at')->dateTime()->sortable(),
            'available_at' => TextColumn::make('available_at')->dateTime()->sortable(),
=======
            'queue' => TextColumn::make('queue')
                ->sortable()
                ->searchable(),
            'payload' => TextColumn::make('payload')
                ->wrap()
                ->searchable(),
            'attempts' => TextColumn::make('attempts')
                ->numeric()
                ->sortable(),
            'reserved_at' => TextColumn::make('reserved_at')
                ->dateTime()
                ->sortable(),
            'available_at' => TextColumn::make('available_at')
                ->dateTime()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
            'created_at' => TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
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
