<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 0a466ed (.)
use Modules\Media\Filament\Resources\MediaConvertResource\Pages\ListMediaConverts;
use Modules\Media\Filament\Resources\MediaConvertResource\Pages\CreateMediaConvert;
use Modules\Media\Filament\Resources\MediaConvertResource\Pages\EditMediaConvert;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Modules\Media\Filament\Resources\MediaConvertResource\Pages;
use Modules\Media\Models\MediaConvert;
use Modules\Xot\Filament\Resources\XotBaseResource;

class MediaConvertResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = MediaConvert::class;

    /**
     * @return array<string, Component>
     */
    #[Override]
=======
    protected static ?string $model = MediaConvert::class;

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> 0a466ed (.)
    public static function getFormSchema(): array
    {
        return [
            'format' => Radio::make('format')
                ->options([
                    'webm' => 'webm',
                    // 'webm02' => 'webm02',
                ])
                ->inline()
                ->inlineLabel(false),
            // -----------------------------------
            'codec_video' => Radio::make('codec_video')
                ->options([
                    'libvpx-vp9' => 'libvpx-vp9',
                    'libvpx-vp8' => 'libvpx-vp8',
                ])
                ->inline()
                ->inlineLabel(false),
            'codec_audio' => Radio::make('codec_audio')
                ->options([
                    'copy' => 'copy',
                    'libvorbis' => 'libvorbis',
                ])
                ->inline()
                ->inlineLabel(false),
            'preset' => Radio::make('preset')
                ->options([
                    'fast' => 'fast',
                    'ultrafast' => 'ultrafast',
                ])
                ->inline()
                ->inlineLabel(false),
            'bitrate' => TextInput::make('bitrate'),
            'width' => TextInput::make('width')->numeric(),
            'height' => TextInput::make('height')->numeric(),
            'threads' => TextInput::make('threads'),
            'speed' => TextInput::make('speed'),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public static function getRelations(): array
    {
        return [];
    }

    #[Override]
=======
    public static function getRelations(): array
    {
        return [
        ];
    }

>>>>>>> 0a466ed (.)
    public static function getPages(): array
    {
        return [
            'index' => ListMediaConverts::route('/'),
            'create' => CreateMediaConvert::route('/create'),
            'edit' => EditMediaConvert::route('/{record}/edit'),
        ];
    }
}
