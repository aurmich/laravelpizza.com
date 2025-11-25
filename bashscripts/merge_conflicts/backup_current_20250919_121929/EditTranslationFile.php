<?php

<<<<<<< HEAD
declare(strict_types=1);


namespace Modules\Lang\Filament\Resources\TranslationFileResource\Pages;

use Override;
=======
namespace Modules\Lang\Filament\Resources\TranslationFileResource\Pages;

>>>>>>> 8b0b6ac (.)
use Filament\Schemas\Components\Section;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Modules\Lang\Actions\SaveTransAction;
use Modules\Lang\Filament\Actions\LocaleSwitcherRefresh;
<<<<<<< HEAD
use Modules\Lang\Filament\Resources\TranslationFileResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Lang\Filament\Resources\TranslationFileResource;
>>>>>>> 8b0b6ac (.)

class EditTranslationFile extends XotBaseEditRecord
{
    protected static string $resource = TranslationFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcherRefresh::make('lang'),
            ...parent::getHeaderActions(),
            // ...
        ];
    }

    /**
     * @return array<string>
     */
<<<<<<< HEAD
    public function getTranslatableLocales()
    {
        return ['it', 'en'];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        /*
         * // Salva le traduzioni nel file
         * try {
         * $this->record->saveTranslations($data['content']);
         *
         * Notification::make()
         * ->title('Traduzioni salvate con successo')
         * ->success()
         * ->send();
         *
         * } catch (\Exception $e) {
         * Notification::make()
         * ->title('Errore durante il salvataggio')
         * ->body($e->getMessage())
         * ->danger()
         * ->send();
         *
         * // Previeni il salvataggio se c'è un errore
         * $this->halt();
         * }
         */
        /** @phpstan-ignore argument.type, property.nonObject */
        app(SaveTransAction::class)->execute($this->record->key, $data['content']);
=======
    public function getTranslatableLocales(){
        return ['it', 'en'];
    }
   
    protected function mutateFormDataBeforeSave(array $data): array
    {
        /*
        // Salva le traduzioni nel file
        try {
            $this->record->saveTranslations($data['content']);
            
            Notification::make()
                ->title('Traduzioni salvate con successo')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Errore durante il salvataggio')
                ->body($e->getMessage())
                ->danger()
                ->send();
                
            // Previeni il salvataggio se c'è un errore
            $this->halt();
        }
        */
        /** @phpstan-ignore argument.type, property.nonObject */
        app(SaveTransAction::class)->execute($this->record->key,$data['content']);
>>>>>>> 8b0b6ac (.)
        //dddx(['record'=>$this->record,'data'=>$data]);
        return $data;
    }

    protected function afterSave(): void
    {
        // Ricarica il record per aggiornare i dati
        /** @phpstan-ignore method.nonObject */
        $this->record->refresh();
    }

<<<<<<< HEAD
    #[Override]
    public function getFormSchema(): array
    {
        return [
            Section::make('content')->schema(fn($record) => $this->makeFromArray($record->content, 'content')),
=======

    public function getFormSchema(): array
    {
        return [
            Section::make('content')
                ->schema(fn($record)=>$this->makeFromArray($record->content,'content'))
>>>>>>> 8b0b6ac (.)
        ];
    }

    public function makeFromArray(array $array, string $prefix = ''): array
    {
        $fields = [];

        foreach ($array as $key => $value) {
<<<<<<< HEAD
            $fullKey = $prefix === '' ? $key : ($prefix . '.' . $key);
=======
            $fullKey = $prefix === '' ? $key : $prefix . '.' . $key;
>>>>>>> 8b0b6ac (.)

            if (is_array($value)) {
                $fields[] = Section::make($key)
                    ->label($fullKey)
                    ->schema(self::makeFromArray($value, $fullKey))
                    ->columns(2);
            } else {
                $fields[] = TextInput::make($fullKey)
                    //->label($fullKey)
                    ->label($key)
<<<<<<< HEAD
                    ->default($value);
=======
                    ->default($value)
                    ;
>>>>>>> 8b0b6ac (.)
            }
        }

        return $fields;
    }
}
