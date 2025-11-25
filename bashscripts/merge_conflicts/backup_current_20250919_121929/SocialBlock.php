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
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

final class SocialBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')->required()->label(__('cms::blocks.social.fields.title')),
=======
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')
                ->required()
                ->label(__('cms::blocks.social.fields.title')),

>>>>>>> 3401a6b (.)
            Repeater::make('social_links')
                ->label(__('cms::blocks.social.fields.social_links'))
                ->schema([
                    Select::make('platform')
                        ->required()
                        ->label(__('cms::blocks.social.fields.platform'))
                        ->options([
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'instagram' => 'Instagram',
                            'linkedin' => 'LinkedIn',
                            'youtube' => 'YouTube',
                        ]),
<<<<<<< HEAD
=======

>>>>>>> 3401a6b (.)
                    TextInput::make('url')
                        ->required()
                        ->url()
                        ->label(__('cms::blocks.social.fields.url')),
                ])
                ->collapsible()
<<<<<<< HEAD
                ->itemLabel(fn(array $state): null|string => $state['platform'] ?? null)
=======
                ->itemLabel(fn (array $state): ?string => $state['platform'] ?? null)
>>>>>>> 3401a6b (.)
                ->defaultItems(1),
        ];
    }

    public static function getBlockLabel(): string
    {
        return __('cms::blocks.social.label');
    }
}
