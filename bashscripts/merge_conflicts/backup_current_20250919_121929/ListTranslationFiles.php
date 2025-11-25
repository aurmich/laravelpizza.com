<?php

<<<<<<< HEAD
declare(strict_types=1);


namespace Modules\Lang\Filament\Resources\TranslationFileResource\Pages;

use Filament\Actions\Action;
use Override;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns;
=======
namespace Modules\Lang\Filament\Resources\TranslationFileResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions;
use Filament\Tables\Columns;
use Filament\Resources\Pages\ListRecords;
>>>>>>> 8b0b6ac (.)
use Modules\Lang\Filament\Actions\LocaleSwitcherRefresh;
use Modules\Lang\Filament\Resources\TranslationFileResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;

class ListTranslationFiles extends XotBaseListRecords
{
    protected static string $resource = TranslationFileResource::class;

<<<<<<< HEAD
    #[Override]
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('key')->searchable(['key', 'content']),
=======
    public function getTableColumns(): array
    {
        return [
            TextColumn::make('key')
               ->searchable(['key','content']),

>>>>>>> 8b0b6ac (.)
        ];
    }

    /**
     * @return array<string, Action>
     */
<<<<<<< HEAD
    #[Override]
    protected function getHeaderActions(): array
    {
        $parentActions = parent::getHeaderActions();

=======
    protected function getHeaderActions(): array
    {
        $parentActions = parent::getHeaderActions();
        
>>>>>>> 8b0b6ac (.)
        // Assicurarsi che tutte le azioni abbiano chiavi stringa
        $actions = [
            'locale_switcher' => LocaleSwitcherRefresh::make('lang'),
        ];
<<<<<<< HEAD

        // Aggiungere le azioni parent con chiavi stringa
        foreach ($parentActions as $key => $action) {
            $actions['parent_' . (is_string($key) ? $key : ((string) $key))] = $action;
        }

        return $actions;
    }
=======
        
        // Aggiungere le azioni parent con chiavi stringa
        foreach ($parentActions as $key => $action) {
            $actions['parent_' . (is_string($key) ? $key : (string) $key)] = $action;
        }
        
        return $actions;
    }

>>>>>>> 8b0b6ac (.)
}
