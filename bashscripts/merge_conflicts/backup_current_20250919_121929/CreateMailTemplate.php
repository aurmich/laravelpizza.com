<?php

<<<<<<< HEAD
declare(strict_types=1);


namespace Modules\Notify\Filament\Resources\MailTemplateResource\Pages;

use Filament\Actions;
use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;
use Modules\Notify\Filament\Resources\MailTemplateResource;
=======
namespace Modules\Notify\Filament\Resources\MailTemplateResource\Pages;

use Filament\Actions;
use Modules\Notify\Filament\Resources\MailTemplateResource;
use Modules\Lang\Filament\Resources\Pages\LangBaseCreateRecord;
>>>>>>> b19cd40 (.)

class CreateMailTemplate extends LangBaseCreateRecord
{
    protected static string $resource = MailTemplateResource::class;
}
