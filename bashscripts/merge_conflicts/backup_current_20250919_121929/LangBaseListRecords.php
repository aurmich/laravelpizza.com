<?php

declare(strict_types=1);

namespace Modules\Lang\Filament\Resources\Pages;
<<<<<<< HEAD
 
use Filament\Actions\Action;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Override;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
=======
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions\Action;
>>>>>>> 8b0b6ac (.)
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ListRecords;
use Modules\Cms\Filament\Resources\SectionResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;

abstract class LangBaseListRecords extends XotBaseListRecords
{
    use Translatable;
<<<<<<< HEAD

    protected static string $resource; // = SectionResource::class;
    /**
     * @return array<string, Action>
     */
    #[Override]
    protected function getHeaderActions(): array
    {
        $parentActions = parent::getHeaderActions();

=======
    protected static string $resource;// = SectionResource::class;
    /**
     * @return array<string, Action>
     */
    protected function getHeaderActions(): array
    {
        $parentActions = parent::getHeaderActions();
        
>>>>>>> 8b0b6ac (.)
        // Assicurarsi che tutte le azioni abbiano chiavi stringa
        $actions = [
            'locale_switcher' => LocaleSwitcher::make(),
        ];
<<<<<<< HEAD

        // Aggiungere le azioni parent con chiavi stringa
        foreach ($parentActions as $key => $action) {
            $actions['parent_' . (is_string($key) ? $key : ((string) $key))] = $action;
        }

=======
        
        // Aggiungere le azioni parent con chiavi stringa
        foreach ($parentActions as $key => $action) {
            $actions['parent_' . (is_string($key) ? $key : (string) $key)] = $action;
        }
        
>>>>>>> 8b0b6ac (.)
        return $actions;
    }
}
