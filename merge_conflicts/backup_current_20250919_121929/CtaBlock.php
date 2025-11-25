<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
=======
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Builder\Block;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class CtaBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')->label('Titolo')->required(),
            Textarea::make('description')->label('Descrizione')->required(),
            TextInput::make('button_text')->label('Testo Pulsante')->required(),
=======
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Titolo')
                ->required(),
            Textarea::make('description')
                ->label('Descrizione')
                ->required(),
            TextInput::make('button_text')
                ->label('Testo Pulsante')
                ->required(),
>>>>>>> 3401a6b (.)
            TextInput::make('button_link')
                ->label('Link Pulsante')
                ->required()
                ->url(),
        ];
    }
}
