<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 0a466ed (.)
use Modules\Media\Filament\Resources\MediaResource\Pages\ListMedia;
use Modules\Media\Filament\Resources\MediaResource\Pages\CreateMedia;
use Modules\Media\Filament\Resources\MediaResource\Pages\EditMedia;
use Modules\Media\Filament\Resources\MediaResource\Pages\ViewMedia;
use Modules\Media\Filament\Resources\MediaResource\Pages\ConvertMedia;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\PageRegistration;
use Modules\Media\Filament\Resources\MediaResource\Pages;
use Modules\Media\Models\Media;
use Modules\Xot\Filament\Resources\XotBaseResource;

class MediaResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = Media::class;

    /**
     * @return array<string, Component>
     */
    #[Override]
=======
    protected static ?string $model = Media::class;

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> 0a466ed (.)
    public static function getFormSchema(): array
    {
        return [
            'file' => FileUpload::make('file')
                ->hint(static::trans('fields.file_hint'))
                ->storeFileNamesIn('original_file_name')
                ->visibility('private')
                ->required()
                ->columnSpanFull(),
            'attachment_type' => Radio::make('attachment_type'),
            'name' => TextInput::make('name')
                ->translateLabel()
                ->hint(static::trans('fields.name.hint'))
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }

    /**
     * @psalm-return array<never, never>
     */
<<<<<<< HEAD
    #[Override]
    public static function getRelations(): array
    {
        return [];
=======
    public static function getRelations(): array
    {
        return [
        ];
>>>>>>> 0a466ed (.)
    }

    /**
     * @return PageRegistration[]
     *
     * @psalm-return array{index: PageRegistration, create: PageRegistration, edit: PageRegistration}
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a466ed (.)
    public static function getPages(): array
    {
        return [
            'index' => ListMedia::route('/'),
            'create' => CreateMedia::route('/create'),
            'edit' => EditMedia::route('/{record}/edit'),
            'view' => ViewMedia::route('/{record}'),
            'convert' => ConvertMedia::route('/{record}/convert'),
        ];
    }
}
