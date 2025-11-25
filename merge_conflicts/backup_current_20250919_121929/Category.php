<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> 727968c (.)
namespace Modules\UI\Filament\Blocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Blocks\XotBaseBlock;

final class Category extends XotBaseBlock
{
    public static function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->label(__('ui::blocks.category.fields.name.label'))
                ->helperText(__('ui::blocks.category.fields.name.helper_text')),
<<<<<<< HEAD
=======

>>>>>>> 727968c (.)
            TextInput::make('slug')
                ->required()
                ->label(__('ui::blocks.category.fields.slug.label'))
                ->helperText(__('ui::blocks.category.fields.slug.helper_text')),
<<<<<<< HEAD
=======

>>>>>>> 727968c (.)
            Select::make('parent_id')
                ->relationship('parent', 'name')
                ->label(__('ui::blocks.category.fields.parent.label'))
                ->helperText(__('ui::blocks.category.fields.parent.helper_text')),
        ];
    }

    public static function getTitle(): string
    {
        return __('ui::blocks.category.title');
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 727968c (.)
