<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\MailTemplateResource\Pages;

<<<<<<< HEAD
use Override;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Modules\Notify\Filament\Resources\MailTemplateResource;
use Modules\Notify\Models\MailTemplate;
=======
use Filament\Tables\Columns\TextColumn;
use Modules\Notify\Filament\Resources\MailTemplateResource;
use Modules\Notify\Models\MailTemplate;
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
use Filament\Tables;
use Filament\Tables\Table;
>>>>>>> b19cd40 (.)

class ListMailTemplates extends LangBaseListRecords
{
    protected static string $resource = MailTemplateResource::class;

<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('slug')->searchable()->sortable(),
            TextColumn::make('mailable')->searchable()->sortable(),
            TextColumn::make('subject')->searchable()->sortable(),
            TextColumn::make('counter')->searchable()->sortable(),
        ];
    }
=======
    
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('slug')
                ->searchable()
                ->sortable()
                ,

            TextColumn::make('mailable')
                ->searchable()
                ->sortable()
                ,

            TextColumn::make('subject')
                ->searchable()
                ->sortable()
                ,

            TextColumn::make('counter')
                ->searchable()
                ->sortable()
                ,
            
        ];
    }


>>>>>>> b19cd40 (.)
}
