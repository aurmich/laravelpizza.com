<?php

/**
 * @see https://gitlab.com/amvisor/filament-failed-jobs/-/blob/master/src/resources/FailedJobsResource/Pages/ListFailedJobs.php?ref_type=heads
 */

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\FailedJobResource\Pages;

<<<<<<< HEAD
use Override;
=======
>>>>>>> e1b0bf9 (.)
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Artisan;
use Modules\Job\Filament\Resources\FailedJobResource;
use Modules\Job\Models\FailedJob;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListFailedJobs extends XotBaseListRecords
{
    protected static string $resource = FailedJobResource::class;

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
            'uuid' => TextColumn::make('uuid')
                ->searchable()
                ->sortable()
                ->copyable(),
<<<<<<< HEAD
            'connection' => TextColumn::make('connection')->searchable()->sortable(),
            'queue' => TextColumn::make('queue')->searchable()->sortable(),
=======
            'connection' => TextColumn::make('connection')
                ->searchable()
                ->sortable(),
            'queue' => TextColumn::make('queue')
                ->searchable()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
            'payload' => TextColumn::make('payload')
                ->searchable()
                ->wrap()
                ->limit(50),
            'exception' => TextColumn::make('exception')
                ->searchable()
                ->wrap()
                ->limit(100),
<<<<<<< HEAD
            'failed_at' => TextColumn::make('failed_at')->dateTime()->sortable(),
=======
            'failed_at' => TextColumn::make('failed_at')
                ->dateTime()
                ->sortable(),
>>>>>>> e1b0bf9 (.)
        ];
    }

    /**
     * @return array<string, Action>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> e1b0bf9 (.)
    protected function getHeaderActions(): array
    {
        return [
            'retry_all' => Action::make('retry_all')
                ->requiresConfirmation()
<<<<<<< HEAD
                ->action(static function (): void {
                    Artisan::call('queue:retry all');
                    Notification::make()
                        ->title('All failed jobs have been pushed back onto the queue.')
                        ->success()
                        ->send();
                }),
            'delete_all' => Action::make('delete_all')
                ->requiresConfirmation()
                ->color('danger')
                ->action(static function (): void {
                    FailedJob::truncate();
                    Notification::make()
                        ->title('All failed jobs have been removed.')
                        ->success()
                        ->send();
                }),
=======
                ->action(
                    static function (): void {
                        Artisan::call('queue:retry all');
                        Notification::make()
                            ->title('All failed jobs have been pushed back onto the queue.')
                            ->success()
                            ->send();
                    }
                ),

            'delete_all' => Action::make('delete_all')
                ->requiresConfirmation()
                ->color('danger')
                ->action(
                    static function (): void {
                        FailedJob::truncate();
                        Notification::make()
                            ->title('All failed jobs have been removed.')
                            ->success()
                            ->send();
                    }
                ),
>>>>>>> e1b0bf9 (.)
        ];
    }
}
