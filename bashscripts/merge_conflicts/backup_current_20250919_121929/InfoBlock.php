<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 3401a6b (.)
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Blocks\XotBaseBlock;

final class InfoBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')->required()->label(__('cms::blocks.info.fields.title')),
            RichEditor::make('description')->required()->label(__('cms::blocks.info.fields.description')),
=======
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->label(__('cms::blocks.info.fields.title')),

            RichEditor::make('description')
                ->required()
                ->label(__('cms::blocks.info.fields.description')),

>>>>>>> 3401a6b (.)
            FileUpload::make('logo')
                ->image()
                ->required()
                ->label(__('cms::blocks.info.fields.logo')),
<<<<<<< HEAD
            TextInput::make('copyright')->required()->label(__('cms::blocks.info.fields.copyright')),
=======

            TextInput::make('copyright')
                ->required()
                ->label(__('cms::blocks.info.fields.copyright')),
>>>>>>> 3401a6b (.)
        ];
    }

    public static function getBlockLabel(): string
    {
        return __('cms::blocks.info.label');
    }
}
