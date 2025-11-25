<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 0a466ed (.)
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
<<<<<<< HEAD
use Filament\Actions\DeleteAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Datas\ConvertData;
use Modules\Media\Filament\Infolists\VideoEntry;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Infolists\Infolist;
use Filament\Actions\DeleteAction;
use Modules\Media\Datas\ConvertData;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Modules\Media\Filament\Infolists\VideoEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Media\Filament\Resources\MediaConvertResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Media\Actions\Video\ConvertVideoByConvertDataAction;
use Modules\Media\Filament\Resources\MediaResource\Widgets\ConvertWidget;
>>>>>>> 0a466ed (.)

class ViewMedia extends XotBaseViewRecord
{
    protected static string $resource = MediaResource::class;

    /**
     * Restituisce lo schema dell'infolist per la visualizzazione dei dettagli del record.
     *
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> 0a466ed (.)
    public function getInfolistSchema(): array
    {
        return [
            'media_viewer' => Flex::make([
                Section::make()->schema([
                    ImageEntry::make('url')
<<<<<<< HEAD
                        ->defaultImageUrl(fn($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn($record): bool => $record->type === 'image'),
                    VideoEntry::make('url')
                        ->defaultImageUrl(fn($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn($record): bool => $record->type === 'video'),
=======
                        ->defaultImageUrl(fn ($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn ($record): bool => $record->type === 'image'),

                    VideoEntry::make('url')
                        ->defaultImageUrl(fn ($record) => $record->getUrl())
                        ->size(500)
                        ->visible(fn ($record): bool => $record->type === 'video'),
>>>>>>> 0a466ed (.)
                ]),
                Section::make()->schema([
                    Actions::make([
                        Action::make('convert')
                            ->tooltip('convert')
                            ->icon('heroicon-o-scale')
                            ->schema(MediaConvertResource::getFormSchema())
                            ->action(function ($record, array $data): void {
                                $data['disk'] = $record->disk;
<<<<<<< HEAD
                                $data['file'] = $record->path . '/' . $record->file_name;
=======
                                $data['file'] = $record->path.'/'.$record->file_name;
>>>>>>> 0a466ed (.)
                                $convert_data = ConvertData::from($data);
                                $record->mediaConverts()->create($convert_data->toArray());
                            }),
                    ]),
                    TextEntry::make('name'),
                    TextEntry::make('collection_name'),
                    TextEntry::make('mime_type'),
                    TextEntry::make('human_readable_size'),
                    TextEntry::make('created_at'),
<<<<<<< HEAD
                ]),
            ]),
=======
                ])
            ]),
            
>>>>>>> 0a466ed (.)
            'entry_conversions' => RepeatableEntry::make('entry_conversions')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('src'),
                    ImageEntry::make('src'),
                ])
<<<<<<< HEAD
                ->columns(4),
=======
                ->columns(4)
>>>>>>> 0a466ed (.)
        ];
    }

    /**
     * @return DeleteAction[]
     *
     * @psalm-return list{DeleteAction}
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ConvertWidget::make(['record' => $this->record]),
        ];
    }
}
