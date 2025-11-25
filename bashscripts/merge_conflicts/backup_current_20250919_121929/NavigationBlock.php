<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
=======
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class NavigationBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
=======
    

>>>>>>> 3401a6b (.)
    public static function getBlockSchema(): array
    {
        return [
            Repeater::make('items')
                ->label('Voci di menu')
                ->schema([
<<<<<<< HEAD
                    TextInput::make('label')->label('Etichetta')->required(),
                    TextInput::make('url')->label('URL')->required(),
=======
                    TextInput::make('label')
                        ->label('Etichetta')
                        ->required(),

                    TextInput::make('url')
                        ->label('URL')
                        ->required(),

>>>>>>> 3401a6b (.)
                    Select::make('type')
                        ->label('Tipo')
                        ->options([
                            'link' => 'Link',
                            'button' => 'Pulsante',
<<<<<<< HEAD
                            'dropdown' => 'Menu a tendina',
                        ])
                        ->default('link')
                        ->reactive(),
=======
                            'dropdown' => 'Menu a tendina'
                        ])
                        ->default('link')
                        ->reactive(),

>>>>>>> 3401a6b (.)
                    Select::make('style')
                        ->label('Stile')
                        ->options([
                            'default' => 'Default',
                            'primary' => 'Primario',
<<<<<<< HEAD
                            'secondary' => 'Secondario',
                        ])
                        ->default('default')
                        ->visible(fn(Get $get) => $get('type') === 'button'),
                    Repeater::make('children')
                        ->label('Sottomenu')
                        ->schema([
                            TextInput::make('label')->label('Etichetta')->required(),
                            TextInput::make('url')->label('URL')->required(),
=======
                            'secondary' => 'Secondario'
                        ])
                        ->default('default')
                        ->visible(fn (Get $get) => $get('type') === 'button'),

                    Repeater::make('children')
                        ->label('Sottomenu')
                        ->schema([
                            TextInput::make('label')
                                ->label('Etichetta')
                                ->required(),

                            TextInput::make('url')
                                ->label('URL')
                                ->required(),

>>>>>>> 3401a6b (.)
                            Select::make('type')
                                ->label('Tipo')
                                ->options([
                                    'link' => 'Link',
<<<<<<< HEAD
                                    'button' => 'Pulsante',
                                ])
                                ->default('link'),
                        ])
                        ->visible(fn(Get $get) => $get('type') === 'dropdown')
                        ->collapsible(),
                ])
                ->collapsible()
                ->reorderable(),
=======
                                    'button' => 'Pulsante'
                                ])
                                ->default('link')
                        ])
                        ->visible(fn (Get $get) => $get('type') === 'dropdown')
                        ->collapsible()
                ])
                ->collapsible()
                ->reorderable(),

>>>>>>> 3401a6b (.)
            Select::make('alignment')
                ->label('Allineamento')
                ->options([
                    'start' => 'Sinistra',
                    'center' => 'Centro',
<<<<<<< HEAD
                    'end' => 'Destra',
                ])
                ->default('start'),
=======
                    'end' => 'Destra'
                ])
                ->default('start'),

>>>>>>> 3401a6b (.)
            Select::make('orientation')
                ->label('Orientamento')
                ->options([
                    'horizontal' => 'Orizzontale',
<<<<<<< HEAD
                    'vertical' => 'Verticale',
                ])
                ->default('horizontal'),
=======
                    'vertical' => 'Verticale'
                ])
                ->default('horizontal')
>>>>>>> 3401a6b (.)
        ];
    }

    public static function getBlockLabel(): string
    {
        return __('cms::blocks.navigation.label');
    }
}
