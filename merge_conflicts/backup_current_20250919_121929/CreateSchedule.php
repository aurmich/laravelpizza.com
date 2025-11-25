<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Resources\ScheduleResource\Pages;

use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Modules\Job\Filament\Resources\ScheduleResource;
use Modules\Xot\Filament\Traits\NavigationPageLabelTrait;
use Webmozart\Assert\Assert;

class CreateSchedule extends XotBaseCreateRecord
{
    use NavigationPageLabelTrait;

    public Collection $commands;

    protected static string $resource = ScheduleResource::class;

    public function getformSchema(): array
    {
        Assert::isArray($res = $this->getResource()::getFormSchema());

        return $res;
    }

    public function form(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema->components($this->getFormSchema());
=======
        return $schema
            ->components($this->getFormSchema());
>>>>>>> e1b0bf9 (.)
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
<<<<<<< HEAD
=======

   
>>>>>>> e1b0bf9 (.)
}
