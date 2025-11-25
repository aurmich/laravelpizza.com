<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Blocks;

<<<<<<< HEAD
use Override;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
=======
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder\Block;
>>>>>>> 3401a6b (.)
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class ParagraphBlock extends XotBaseBlock
{
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 3401a6b (.)
    public static function getBlockSchema(): array
    {
        return [
            RichEditor::make('content')
                ->label('Contenuto')
                ->required()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'link',
                    'orderedList',
                    'unorderedList',
                    'h2',
                    'h3',
                    'h4',
                    'blockquote',
                    'undo',
                    'redo',
                ])
                ->disableToolbarButtons([
                    'attachFiles',
                    'codeBlock',
                ]),
        ];
    }
}
