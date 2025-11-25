<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Blocks;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;
use Modules\Xot\Filament\Traits\TransTrait;
=======
use Filament\Forms\Components\Select;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Forms\Components\Builder\Block;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;
>>>>>>> f1d4085 (.)

abstract class XotBaseBlock
{
    use TransTrait;
<<<<<<< HEAD

    public static function make(string $name = 'article_list', string $context = 'form'): Block
    {
        /**
         * @var array<Component>
         */
        $schema = array_merge(static::getBlockSchema(), static::getBlockVarSchema());

        return Block::make($name)->schema($schema)->columns('form' === $context ? 3 : 1);
=======
    
    public static function make(
        string $name = 'article_list',
        string $context = 'form',
    ): Block {
        /**
         * @var array<\Filament\Schemas\Components\Component>
         */
        $schema = array_merge(static::getBlockSchema(), static::getBlockVarSchema());

        return Block::make($name)
            ->schema($schema)

            ->columns('form' === $context ? 3 : 1);
>>>>>>> f1d4085 (.)
    }

    /**
     * Undocumented function.
     *
<<<<<<< HEAD
     * @return array<Component>
=======
     * @return array<\Filament\Schemas\Components\Component>
>>>>>>> f1d4085 (.)
     */
    public static function getBlockSchema(): array
    {
        return [];
    }

    /**
     * Undocumented function.
     *
<<<<<<< HEAD
     * @return array<Component>
     */
    public static function getBlockVarSchema(): array
    {
        $options = app(GetViewBlocksOptionsByTypeAction::class)->execute('article_list', false);

        return [
            Select::make('view')->options($options),
=======
     * @return array<\Filament\Schemas\Components\Component>
     */
    public static function getBlockVarSchema(): array
    {
        $options = app(GetViewBlocksOptionsByTypeAction::class)
            ->execute('article_list', false);

        return [
            Select::make('view')
                ->options($options),
>>>>>>> f1d4085 (.)
        ];
    }
}
