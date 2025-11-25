<?php

declare(strict_types=1);

namespace Modules\Job\Filament\Columns;

use Filament\Tables\Columns\TextColumn;

class ScheduleOptions extends TextColumn
{
    protected bool $withValue = true;

    public function withValue(bool $withValue = true): static
    {
        $this->withValue = $withValue;

        return $this;
    }

    public function getTags(): array
    {
        /*
<<<<<<< HEAD
         * if($this->record==null){
         * return [];
         * }
         * if($this->withValue)
         * return $this->record->getOptions();
         * else{
         * return parent::getTags();
         * }
         */
=======
        if($this->record==null){
            return [];
        }
        if($this->withValue)
        return $this->record->getOptions();
        else{
            return parent::getTags();
        }
        */
>>>>>>> e1b0bf9 (.)
        return [];
    }
}
