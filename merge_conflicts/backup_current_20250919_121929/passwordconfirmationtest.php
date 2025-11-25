<?php

declare(strict_types=1);

namespace Modules\Cms\Tests\Feature\Auth;

use Modules\Xot\Tests\TestCase;
<<<<<<< HEAD
use Livewire\Volt\Volt as LivewireVolt;
use Modules\Xot\Datas\XotData;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
=======
use Modules\Xot\Datas\XotData;
use Livewire\Volt\Volt as LivewireVolt;
use function Pest\Laravel\{actingAs, get};
>>>>>>> 3401a6b (.)

uses(TestCase::class);

test('confirm password screen can be rendered', function () {
    $userClass = XotData::make()->getUserClass();
    $user = $userClass::factory()->create();

    $lang = app()->getLocale();
    $response = actingAs($user)->get('/' . $lang . '/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $userClass = XotData::make()->getUserClass();
    $user = $userClass::factory()->create();

    actingAs($user);

<<<<<<< HEAD
    $response = LivewireVolt::test('auth.confirm-password')->set('password', 'password')->call('confirmPassword');

    $response->assertHasNoErrors()->assertRedirect(route('dashboard', absolute: false));
=======
    $response = LivewireVolt::test('auth.confirm-password')
        ->set('password', 'password')
        ->call('confirmPassword');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));
>>>>>>> 3401a6b (.)
});

test('password is not confirmed with invalid password', function () {
    $userClass = XotData::make()->getUserClass();
    $user = $userClass::factory()->create();

    actingAs($user);

<<<<<<< HEAD
    $response = LivewireVolt::test('auth.confirm-password')->set('password', 'wrong-password')->call('confirmPassword');

    $response->assertHasErrors(['password']);
});
=======
    $response = LivewireVolt::test('auth.confirm-password')
        ->set('password', 'wrong-password')
        ->call('confirmPassword');

    $response->assertHasErrors(['password']);
});
>>>>>>> 3401a6b (.)
