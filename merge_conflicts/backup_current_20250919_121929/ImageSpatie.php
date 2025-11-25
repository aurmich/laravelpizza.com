<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Blocks;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Webmozart\Assert\Assert;

class ImageSpatie
{
<<<<<<< HEAD
    public static function make(string $name = 'image_spatie', string $context = 'form'): Block
    {
        return Block::make($name)
            ->schema([
                Hidden::make('img_uuid')
                    ->default(Str::uuid()->toString(...))
                    ->formatStateUsing(fn($state) => $state ?? Str::uuid()->toString()),
                // ->live()
=======
    public static function make(
        string $name = 'image_spatie',
        string $context = 'form',
    ): Block {
        return Block::make($name)

            ->schema([
                Hidden::make('img_uuid')
                    ->default(fn () => Str::uuid()->toString())
                    ->formatStateUsing(fn ($state) => $state ?? Str::uuid()->toString())
                // ->live()
                ,

>>>>>>> 727968c (.)
                SpatieMediaLibraryFileUpload::make('image')
                    ->live()
                    ->hiddenLabel()
                    ->imagePreviewHeight('666')
                    // ->panelLayout('integrated')
                    // ->imageResizeMode('cover')
                    // ->panelAspectRatio('2:1')
                    ->maxSize(102400)
                    ->disk('local')
                    ->image()
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                    // ->rules(Rule::dimensions()->maxWidth(600)->maxHeight(800))
<<<<<<< HEAD
                    ->collection(fn(Get $get) => $get('img_uuid'))
                    ->afterStateUpdated(function (
                        HasForms $_livewire,
                        SpatieMediaLibraryFileUpload $_component,
                        TemporaryUploadedFile $state,
                        Get $get,
                        HasMedia $record,
                    ) {
                        // Call to an undefined method Filament\Forms\Contracts\HasForms::validateOnly().
                        // $livewire->validateOnly($component->getStatePath());
                        Assert::string(
                            $collection_name = $get('img_uuid'),
                            '[' . __LINE__ . '][' . class_basename(__CLASS__) . ']',
                        );
                        $res = $record->addMedia($state)->withResponsiveImages()->toMediaCollection($collection_name);
                    }),
=======
                    ->collection(fn (Get $get) => $get('img_uuid'))
                    ->afterStateUpdated(
                        function (HasForms $livewire, SpatieMediaLibraryFileUpload $component, TemporaryUploadedFile $state, Get $get, HasMedia $record) {
                            // Call to an undefined method Filament\Forms\Contracts\HasForms::validateOnly().
                            // $livewire->validateOnly($component->getStatePath());
                            Assert::string($collection_name = $get('img_uuid'), '['.__LINE__.']['.class_basename(__CLASS__).']');
                            $res = $record
                                ->addMedia($state)
                                ->withResponsiveImages()
                                ->toMediaCollection($collection_name);
                        }
                    ),

>>>>>>> 727968c (.)
                TextInput::make('caption'),
            ])
            ->columns('form' === $context ? 2 : 1);
    }
}
