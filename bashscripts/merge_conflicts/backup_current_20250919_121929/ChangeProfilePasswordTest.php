<?php

declare(strict_types=1);

use Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> fbc8f8e (.)
use Modules\User\Models\User;
use Modules\Xot\Contracts\ProfileContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
<<<<<<< HEAD

use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
=======
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\{actingAs, post};
>>>>>>> fbc8f8e (.)

uses(TestCase::class);

test('can change profile password', function (): void {
    // Crea un utente e un profilo
    /** @var UserContract&Authenticatable&Model $user */
    $user = User::factory()->create([
        'password' => bcrypt('old_password'),
    ]);

    $profileClass = XotData::make()->getProfileClass();
    /** @var ProfileContract $profile */
<<<<<<< HEAD
    $profile = $profileClass::factory()
        ->create([
            'user_id' => $user->id,
        ]);
=======
    $profile = $profileClass::factory()->create([
        'user_id' => $user->id,
    ]);
>>>>>>> fbc8f8e (.)

    // Simula l'autenticazione
    actingAs($user);

    // Esegui il cambio password
<<<<<<< HEAD
    $response = post(
        route('filament.resources.profiles.change-password', [
            'record' => $profile->id,
        ]),
        [
            'current_password' => 'old_password',
            'new_password' => 'new_password',
            'new_password_confirmation' => 'new_password',
        ],
    );
=======
    $response = post(route('filament.resources.profiles.change-password', [
        'record' => $profile->id,
    ]), [
        'current_password' => 'old_password',
        'new_password' => 'new_password',
        'new_password_confirmation' => 'new_password',
    ]);
>>>>>>> fbc8f8e (.)

    // Verifica che la risposta sia di successo
    $response->assertSuccessful();

    // Verifica che la password sia stata aggiornata
<<<<<<< HEAD
    expect(Hash::check('new_password', $user->fresh()?->password))->toBeTrue();
=======
    expect(Hash::check('new_password', $user->fresh()->password))->toBeTrue();
>>>>>>> fbc8f8e (.)
});

test('cannot change password with wrong current password', function (): void {
    // Crea un utente e un profilo
    /** @var UserContract&Authenticatable&Model $user */
    $user = User::factory()->create([
        'password' => bcrypt('old_password'),
    ]);

    $profileClass = XotData::make()->getProfileClass();
    /** @var ProfileContract $profile */
<<<<<<< HEAD
    $profile = $profileClass::factory()
        ->create([
            'user_id' => $user->id,
        ]);
=======
    $profile = $profileClass::factory()->create([
        'user_id' => $user->id,
    ]);
>>>>>>> fbc8f8e (.)

    // Simula l'autenticazione
    actingAs($user);

    // Prova a cambiare la password con la password corrente errata
<<<<<<< HEAD
    $response = post(
        route('filament.resources.profiles.change-password', [
            'record' => $profile->id,
        ]),
        [
            'current_password' => 'wrong_password',
            'new_password' => 'new_password',
            'new_password_confirmation' => 'new_password',
        ],
    );
=======
    $response = post(route('filament.resources.profiles.change-password', [
        'record' => $profile->id,
    ]), [
        'current_password' => 'wrong_password',
        'new_password' => 'new_password',
        'new_password_confirmation' => 'new_password',
    ]);
>>>>>>> fbc8f8e (.)

    // Verifica che la risposta contenga un errore
    $response->assertSessionHasErrors('current_password');

    // Verifica che la password non sia stata cambiata
<<<<<<< HEAD
    expect(Hash::check('old_password', $user->fresh()?->password))->toBeTrue();
});
=======
    expect(Hash::check('old_password', $user->fresh()->password))->toBeTrue();
}); 
>>>>>>> fbc8f8e (.)
