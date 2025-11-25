<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

<<<<<<< HEAD
use Filament\Actions\Action;
use Override;
use Filament\Actions\CreateAction;
use Filament\Actions;
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
=======
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Actions;
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
use Modules\Geo\Filament\Resources\AddressResource;

>>>>>>> bc26394 (.)

class ListAddresses extends XotBaseListRecords
{
    protected static string $resource = AddressResource::class;

    /**
     * @return array<Action>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> bc26394 (.)
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> bc26394 (.)
