<?php
<<<<<<< HEAD

=======
>>>>>>> 727968c (.)
declare(strict_types=1);

namespace Modules\UI\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Blocks\XotBaseBlock;
=======
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Modules\Xot\Filament\Blocks\XotBaseBlock;
use Filament\Forms\Components\Forms;
>>>>>>> 727968c (.)
use Modules\Xot\Filament\Traits\TransTrait;

class Navigation extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
    public static function getBlockSchema(): array
    {
        return [
            Repeater::make('items')
                ->label('Voci di navigazione')
                ->schema([
                    TextInput::make('label')->label('Testo link')->required(),
                    TextInput::make('url')
                        ->label('URL link')
                        ->url()
                        ->required(),
                ])
                ->columns(2)
                ->minItems(1),
=======
    

    public static function getBlockSchema(): array
    {
        return [
                Repeater::make('items')
                    ->label('Voci di navigazione')
                    ->schema([
                        TextInput::make('label')
                            ->label('Testo link')
                            ->required(),
                        TextInput::make('url')
                            ->label('URL link')
                            ->url()
                            ->required(),
                    ])
                    ->columns(2)
                    ->minItems(1),
>>>>>>> 727968c (.)
        ];
    }

    public function getFormSchema(): array
    {
        return [
            Repeater::make('items')
                ->label(static::trans('blocks.navigation.fields.items.label'))
                ->schema([
<<<<<<< HEAD
                    TextInput::make('text')->label(static::trans('blocks.navigation.fields.text.label')),
                    TextInput::make('url')->label(static::trans('blocks.navigation.fields.url.label')),
=======
                    TextInput::make('text')
                        ->label(static::trans('blocks.navigation.fields.text.label')),
                    TextInput::make('url')
                        ->label(static::trans('blocks.navigation.fields.url.label')),
>>>>>>> 727968c (.)
                ]),
        ];
    }
}
