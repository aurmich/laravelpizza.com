<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationTemplateResource\Pages;

<<<<<<< HEAD
use Modules\Notify\Filament\Resources\NotificationTemplateResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
=======
use Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord;
use Modules\Notify\Filament\Resources\NotificationTemplateResource;

>>>>>>> b19cd40 (.)

class EditNotificationTemplate extends XotBaseEditRecord
{
    protected static string $resource = NotificationTemplateResource::class;
<<<<<<< HEAD

    /*
     * protected function getRedirectUrl(): string
     * {
     * return $this->getResource()::getUrl('index');
     * }
     *
     * protected function mutateFormDataBeforeSave(array $data): array
     * {
     * // Crea una nuova versione del template
     * $this->record->createNewVersion(
     * auth()->user()->name,
     * 'Modificato tramite interfaccia amministrativa'
     * );
     *
     * return $data;
     * }
     */
}
=======
    /*
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Crea una nuova versione del template
        $this->record->createNewVersion(
            auth()->user()->name,
            'Modificato tramite interfaccia amministrativa'
        );

        return $data;
    }
    */
} 
>>>>>>> b19cd40 (.)
