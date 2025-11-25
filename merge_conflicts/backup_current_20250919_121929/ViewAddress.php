<?php

declare(strict_types=1);

namespace Modules\Geo\Filament\Resources\AddressResource\Pages;

<<<<<<< HEAD
use Override;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Modules\Geo\Filament\Resources\AddressResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
=======
use Filament\Actions;
use Filament\Infolists\Infolist;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;
use Modules\Geo\Filament\Resources\AddressResource;

>>>>>>> bc26394 (.)

class ViewAddress extends XotBaseViewRecord
{
    protected static string $resource = AddressResource::class;

<<<<<<< HEAD
    #[Override]
=======
    

>>>>>>> bc26394 (.)
    public function getInfolistSchema(): array
    {
        return [];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> bc26394 (.)
