<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\MediaResource\Pages;

<<<<<<< HEAD
use Override;
=======
>>>>>>> 0a466ed (.)
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ConvertMedia extends XotBaseViewRecord
{
    protected static string $resource = MediaResource::class;

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a466ed (.)
    public function getInfolistSchema(): array
    {
        return [
            // Definire qui i componenti dell'infolist
        ];
    }
}
