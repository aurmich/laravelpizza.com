<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Resources\NotificationTemplateResource\Pages;

<<<<<<< HEAD
use Override;
use Modules\Notify\Filament\Resources\NotificationTemplateResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
=======


use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Notify\Filament\Resources\NotificationTemplateResource;
>>>>>>> b19cd40 (.)

class ListNotificationTemplates extends XotBaseListRecords
{
    protected static string $resource = NotificationTemplateResource::class;

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> b19cd40 (.)
    public function getTableColumns(): array
    {
        return [];
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> b19cd40 (.)
