<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaConvertResource\Pages;

<<<<<<< HEAD
use Filament\Actions\BulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\ActionGroup;
use Override;
=======
>>>>>>> 0a466ed (.)
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
<<<<<<< HEAD
=======
use Filament\Tables\Filters\BaseFilter;
use Filament\Actions\ActionGroup;
>>>>>>> 0a466ed (.)
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Modules\Job\Filament\Widgets\ClockWidget;
use Modules\Media\Actions\Video\ConvertVideoByMediaConvertAction;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Models\MediaConvert;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListMediaConverts extends XotBaseListRecords
{
    protected static string $resource = MediaConvertResource::class;

    /**
     * @return array<string, Tables\Columns\Column>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')->sortable(),
            'media.file_name' => TextColumn::make('media.file_name')->sortable(),
            'format' => TextColumn::make('format')->searchable(),
            'codec_video' => TextColumn::make('codec_video')->searchable(),
            'codec_audio' => TextColumn::make('codec_audio')->searchable(),
            'preset' => TextColumn::make('preset')->searchable(),
            'bitrate' => TextColumn::make('bitrate'),
            'width' => TextColumn::make('width')->numeric(),
            'height' => TextColumn::make('height')->numeric(),
            'threads' => TextColumn::make('threads')->numeric(),
            'speed' => TextColumn::make('speed')->numeric(),
            'percentage' => TextColumn::make('percentage')->numeric(),
            'remaining' => TextColumn::make('remaining')->numeric(),
            'rate' => TextColumn::make('rate')->numeric(),
            'execution_time' => TextColumn::make('execution_time')->numeric(),
=======
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id')
                ->sortable(),
            'media.file_name' => TextColumn::make('media.file_name')
                ->sortable(),
            'format' => TextColumn::make('format')
                ->searchable(),
            'codec_video' => TextColumn::make('codec_video')
                ->searchable(),
            'codec_audio' => TextColumn::make('codec_audio')
                ->searchable(),
            'preset' => TextColumn::make('preset')
                ->searchable(),
            'bitrate' => TextColumn::make('bitrate'),
            'width' => TextColumn::make('width')
                ->numeric(),
            'height' => TextColumn::make('height')
                ->numeric(),
            'threads' => TextColumn::make('threads')
                ->numeric(),
            'speed' => TextColumn::make('speed')
                ->numeric(),
            'percentage' => TextColumn::make('percentage')
                ->numeric(),
            'remaining' => TextColumn::make('remaining')
                ->numeric(),
            'rate' => TextColumn::make('rate')
                ->numeric(),
            'execution_time' => TextColumn::make('execution_time')
                ->numeric(),
>>>>>>> 0a466ed (.)
        ];
    }

    /**
     * @return array<string, BaseFilter>
     */
<<<<<<< HEAD
    #[Override]
    public function getTableFilters(): array
    {
        return [
            'format' => SelectFilter::make('format')->options(MediaConvert::distinct()->pluck(
                'format',
                'format',
            )->toArray(...)),
            'codec_video' => SelectFilter::make('codec_video')->options(MediaConvert::distinct()->pluck(
                'codec_video',
                'codec_video',
            )->toArray(...)),
            'codec_audio' => SelectFilter::make('codec_audio')->options(MediaConvert::distinct()->pluck(
                'codec_audio',
                'codec_audio',
            )->toArray(...)),
=======
    public function getTableFilters(): array
    {
        return [
            'format' => SelectFilter::make('format')
                ->options(fn () => MediaConvert::distinct()->pluck('format', 'format')->toArray()),
            'codec_video' => SelectFilter::make('codec_video')
                ->options(fn () => MediaConvert::distinct()->pluck('codec_video', 'codec_video')->toArray()),
            'codec_audio' => SelectFilter::make('codec_audio')
                ->options(fn () => MediaConvert::distinct()->pluck('codec_audio', 'codec_audio')->toArray()),
>>>>>>> 0a466ed (.)
        ];
    }

    /**
     * @return array<string, Action|ActionGroup>
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
<<<<<<< HEAD
            'convert' => Action::make('convert')->action(function (MediaConvert $record): void {
                $record->update(['percentage' => 0]);
                $data = ConvertData::from([
                    'file' => $record->file,
                    'disk' => $record->disk,
                ]);
                app(ConvertVideoByMediaConvertAction::class)->onQueue()->execute($data, $record);
            }),
=======
            'convert' => Action::make('convert')
                ->action(function (MediaConvert $record): void {
                    $record->update(['percentage' => 0]);
                    $data = ConvertData::from([
                        'file' => $record->file,
                        'disk' => $record->disk,
                    ]);
                    app(ConvertVideoByMediaConvertAction::class)
                        ->onQueue()
                        ->execute($data, $record);
                }),
>>>>>>> 0a466ed (.)
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
>>>>>>> 0a466ed (.)
    public function getTableBulkActions(): array
    {
        return [
            'delete' => DeleteBulkAction::make(),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            ClockWidget::class,
        ];
    }
}
