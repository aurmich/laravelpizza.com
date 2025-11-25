<?php

declare(strict_types=1);

namespace Modules\User\Actions\User;

<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Modules\Xot\Actions\String\GetPronounceablePasswordAction;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
=======
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Modules\Xot\Datas\XotData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Xot\Contracts\UserContract;
>>>>>>> fbc8f8e (.)
use Spatie\QueueableAction\QueueableAction;

class GetNewPasswordAction
{
<<<<<<< HEAD
    use QueueableAction;

    public function execute(UserContract $record): string
    {
        //$user = XotData::make()->getUserByEmail($record->email);
        $user = $record;

        //$password=trim(Str::random(10));
        //$password='Pgn7T8Bppf';
        [$password, $password_hash] = once(function () {
            //$password=trim(Str::password(10));
            $password = app(GetPronounceablePasswordAction::class)->execute();
            $password_hash = Hash::make($password);
            return [$password, $password_hash];
        });

=======
    use QueueableAction; 
    
    public function execute(UserContract $record): string
    {
        //$user = XotData::make()->getUserByEmail($record->email);
        $user=$record;
        /*
        $password=Str::password(10);
        $user->update([
            'password' => Hash::make($password),
        ]);
        */
        //$password=trim(Str::random(10));
        //$password='Pgn7T8Bppf';
        [$password,$password_hash] = once(function () {
            $password=trim(Str::random(10));
            $password_hash=Hash::make($password);
            return [$password,$password_hash];
        });
         
>>>>>>> fbc8f8e (.)
        $user->forceFill([
            //'password' => Hash::make($password),
            //'password' => '$2y$12$mFdQg0jwDMG2FjemQo9y5u2SbC1G0xSNKS3gQnFO5CQ109YWHTAtG',
            'password' => $password_hash,
        ])->save();
        /*
<<<<<<< HEAD
         * $user->update([
         * 'password' => $password,
         * ]);
         */

=======
        $user->update([
            'password' => $password,
        ]);
       */
        
>>>>>>> fbc8f8e (.)
        return $password;
    }
}
