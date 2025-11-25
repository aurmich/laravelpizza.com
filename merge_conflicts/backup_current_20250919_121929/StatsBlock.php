<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
=======
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Builder\Block;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class StatsBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')->label('Titolo')->required(),
            Repeater::make('stats')
                ->label('Statistiche')
                ->schema([
                    TextInput::make('number')->label('Numero')->required(),
                    TextInput::make('label')->label('Etichetta')->required(),
=======
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Titolo')
                ->required(),
            Repeater::make('stats')
                ->label('Statistiche')
                ->schema([
                    TextInput::make('number')
                        ->label('Numero')
                        ->required(),
                    TextInput::make('label')
                        ->label('Etichetta')
                        ->required(),
>>>>>>> 3401a6b (.)
                ])
                ->defaultItems(3)
                ->reorderable()
                ->collapsible()
                ->grid(3)
                ->maxItems(6),
        ];
    }
}
