<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

use ValueError;
use Error;
use Exception;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class SafeArrayByModelCastAction
{
    use QueueableAction;

    /**
     * @return array<string, mixed>
     */
    public function execute(Model $model): array
    {
<<<<<<< HEAD
        try {
            return $model->attributesToArray();
        } catch (ValueError|Error|Exception $e) {
=======
        try{
            return $model->attributesToArray(); 
        }catch(ValueError|Error|Exception $e){
>>>>>>> f1d4085 (.)
            return $this->safeExecute($model);
        }
    }

<<<<<<< HEAD
    public function safeExecute(Model $model): array
    {
        $data = [];
        foreach ($model->getAttributes() as $key => $value) {
            try {
                $data[$key] = $model->$key;

                /** @phpstan-ignore-next-line */
            } catch (ValueError|Error $e) {
            }
        }

        return $data;


=======

    public function safeExecute(Model $model): array
    {
        $data=[];
        foreach($model->getAttributes() as $key=>$value){
            try{
                $data[$key]=$model->$key;
                /** @phpstan-ignore-next-line */
            }catch(ValueError|Error $e){
                
            }
        }
        
        return $data;;
>>>>>>> f1d4085 (.)
    }
}
