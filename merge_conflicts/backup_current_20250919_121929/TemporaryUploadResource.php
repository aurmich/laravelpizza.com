<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> 0a466ed (.)
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Pages\PageRegistration;
use Modules\Media\Filament\Resources\TemporaryUploadResource\Pages\CreateTemporaryUpload;
// use Modules\Media\Filament\Resources\TemporaryUploadResource\RelationManagers;
use Modules\Media\Filament\Resources\TemporaryUploadResource\Pages\EditTemporaryUpload;
// use Filament\Forms;
use Modules\Media\Filament\Resources\TemporaryUploadResource\Pages\ListTemporaryUploads;
use Modules\Media\Models\TemporaryUpload;
use Modules\Xot\Filament\Resources\XotBaseResource;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;

class TemporaryUploadResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = TemporaryUpload::class;

    /**
     * @return array<string, Component>
     */
    #[Override]
=======
    protected static ?string $model = TemporaryUpload::class;

    /**
     * @return array<string, \Filament\Schemas\Components\Component>
     */
>>>>>>> 0a466ed (.)
    public static function getFormSchema(): array
    {
        return [
            'file' => FileUpload::make('file')
                ->required()
                ->preserveFilenames()
                ->acceptedFileTypes(['image/*', 'application/pdf', 'application/msword'])
                ->maxSize(10240),
<<<<<<< HEAD
            'folder' => TextInput::make('folder')->required()->maxLength(255),
            'expires_at' => DateTimePicker::make('expires_at')->required(),
=======
            'folder' => TextInput::make('folder')
                ->required()
                ->maxLength(255),
            'expires_at' => DateTimePicker::make('expires_at')
                ->required(),
>>>>>>> 0a466ed (.)
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
            'index' => ListTemporaryUploads::route('/'),
            'create' => CreateTemporaryUpload::route('/create'),
            'edit' => EditTemporaryUpload::route('/{record}/edit'),
        ];
    }
}
