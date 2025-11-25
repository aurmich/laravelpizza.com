<?php

declare(strict_types=1);

namespace Modules\Cms\Filament\Resources\PageResource\Pages;

use Filament\Tables\Columns\Column;
<<<<<<< HEAD
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Modules\Cms\Filament\Resources\PageResource;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListPages extends LangBaseListRecords
{
    protected static string $resource = PageResource::class;

=======
use Filament\Tables;
use Filament\Actions;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\DeleteBulkAction;
use Modules\Cms\Filament\Resources\PageResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Modules\UI\Filament\Actions\Table\TableLayoutToggleTableAction;

class ListPages extends LangBaseListRecords
{

    protected static string $resource = PageResource::class;

    

>>>>>>> 3401a6b (.)
    /**
     * @return array<string, Column>
     */
    public function getTableColumns(): array
    {
        return [
            'id' => TextColumn::make('id'),
<<<<<<< HEAD
            'title' => TextColumn::make('title')->searchable()->sortable(),
            'lang' => TextColumn::make('lang')->searchable()->sortable(),
            'updated_at' => TextColumn::make('updated_at')->sortable()->dateTime(),
        ];
    }
=======
            'title' => TextColumn::make('title')
                ->searchable()
                ->sortable(),
            'lang' => TextColumn::make('lang')
                ->searchable()
                ->sortable(),
            'updated_at' => TextColumn::make('updated_at')
                ->sortable()
                ->dateTime(),
        ];
    }





>>>>>>> 3401a6b (.)
}
