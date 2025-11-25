<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Tables\Columns;

use Exception;
<<<<<<< HEAD
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Spatie\ModelStates\HasStatesContract;
use Spatie\ModelStates\State;

class SelectStateColumn extends SelectColumn
{
    protected function setUp(): void
    {
        parent::setUp();
        //  $this->selectablePlaceholder(false);
        $this->options(function (Model&HasStatesContract $record, $state): array {
            $name = $this->getName();
            if ($state === null) {
                $states = Arr::wrap($record->getDefaultStateFor($name));
                return array_combine($states, $states);
            }
            try {
                //$states=$record->getAttribute($name)->transitionableStates();
                $states = $state->transitionableStates();
            } catch (Exception $e) {
                $states = $record->getStatesFor($name)->toArray();


            }
            $states = [$state::$name, ...$states];
            $states = array_combine($states, $states);
=======
use Illuminate\Support\Arr;
use Spatie\ModelStates\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\SelectColumn;
use Spatie\ModelStates\HasStatesContract;

class SelectStateColumn extends SelectColumn
{

    protected function setUp(): void
    {
        parent::setUp();
      //  $this->selectablePlaceholder(false);
        $this->options(function (Model&HasStatesContract $record ,$state): array {
            $name=$this->getName();
            if($state==null){

                $states=Arr::wrap($record->getDefaultStateFor($name));
                return array_combine($states, $states);
            }
            try{
                //$states=$record->getAttribute($name)->transitionableStates();
                $states=$state->transitionableStates();
            }catch(Exception $e){
                $states=$record->getStatesFor($name)->toArray();;
            }
            $states=[$state::$name, ...$states];
            $states=array_combine($states, $states);
>>>>>>> 727968c (.)
            //dddx(['state'=>$state, 'state1'=>$record->getAttribute($name),'record'=>$record]);

            return $states;
        });

<<<<<<< HEAD
        $this->beforeStateUpdated(function (Model&HasStatesContract $record, $state) {
            $message = '';
            /** @phpstan-ignore property.notFound */
            $record->state->transitionTo($state, $message);
        });
    }
=======

        $this->beforeStateUpdated(function (Model&HasStatesContract $record, $state) {
            $message='';
            /** @phpstan-ignore property.notFound */
            $record->state->transitionTo($state,$message);
        });


    }




>>>>>>> 727968c (.)
}
