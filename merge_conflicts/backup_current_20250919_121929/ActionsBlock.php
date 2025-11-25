<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
=======
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class ActionsBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 3401a6b (.)
    public static function getBlockSchema(): array
    {
        return [
            Repeater::make('items')
                ->schema([
<<<<<<< HEAD
                    TextInput::make('label')->required(),
                    TextInput::make('url')->required(),
=======
                    TextInput::make('label')
                        ->required()
                        
                        ,

                    TextInput::make('url')
                        ->required()
                        
                        ,

>>>>>>> 3401a6b (.)
                    Select::make('style')
                        ->options([
                            'primary' => 'Primario',
                            'secondary' => 'Secondario',
                            'outline' => 'Outline',
                            'link' => 'Link',
                        ])
<<<<<<< HEAD
                        ->required(),
                    Select::make('icon')->options([
                        'search' => 'Ricerca',
                        'user' => 'Utente',
                        'cart' => 'Carrello',
                        'menu' => 'Menu',
                        'settings' => 'Impostazioni',
                        'notification' => 'Notifiche',
                        'language' => 'Lingua',
                    ]),
=======
                        ->required()
                        
                        ,

                    Select::make('icon')
                        ->options([
                            'search' => 'Ricerca',
                            'user' => 'Utente',
                            'cart' => 'Carrello',
                            'menu' => 'Menu',
                            'settings' => 'Impostazioni',
                            'notification' => 'Notifiche',
                            'language' => 'Lingua',
                        ])
                        
                        ,

>>>>>>> 3401a6b (.)
                    Select::make('size')
                        ->options([
                            'xs' => 'Extra Small',
                            'sm' => 'Small',
                            'md' => 'Medium',
                            'lg' => 'Large',
                        ])
<<<<<<< HEAD
                        ->default('md'),
                ])
                ->collapsible(),
=======
                        ->default('md')
                        
                        ,
                ])
                ->collapsible()
                
                ,

>>>>>>> 3401a6b (.)
            Select::make('alignment')
                ->options([
                    'start' => 'Sinistra',
                    'center' => 'Centro',
                    'end' => 'Destra',
                ])
<<<<<<< HEAD
                ->default('end'),
=======
                ->default('end')
                
                ,

>>>>>>> 3401a6b (.)
            Select::make('gap')
                ->options([
                    'xs' => 'Extra Small',
                    'sm' => 'Small',
                    'md' => 'Medium',
                    'lg' => 'Large',
                ])
<<<<<<< HEAD
                ->default('md'),
=======
                ->default('md')
                
                ,
>>>>>>> 3401a6b (.)
        ];
    }
}
