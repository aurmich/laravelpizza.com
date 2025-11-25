<?php

declare(strict_types=1);

<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\AuthenticationLog;
use Modules\User\Models\User;
=======
use Modules\User\Models\User;
use Modules\User\Models\AuthenticationLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
>>>>>>> fbc8f8e (.)

describe('User Authentication', function () {
    it('can authenticate user with correct credentials', function () {
        $user = createUser([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        $authenticated = Auth::attempt([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
<<<<<<< HEAD

        expect($authenticated)->toBeTrue()->and(Auth::user()?->id)->toBe($user->id);
=======
        
        expect($authenticated)->toBeTrue()
            ->and(Auth::user()->id)->toBe($user->id);
>>>>>>> fbc8f8e (.)
    });

    it('cannot authenticate inactive user', function () {
        createUser([
            'email' => 'inactive@example.com',
            'password' => Hash::make('password123'),
            'is_active' => false,
        ]);
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        $authenticated = Auth::attempt([
            'email' => 'inactive@example.com',
            'password' => 'password123',
        ]);
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        expect($authenticated)->toBeFalse();
    });

    it('logs authentication attempts', function () {
        $user = createUser([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        Auth::attempt([
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
<<<<<<< HEAD

        expect($user->authentications)
            ->toHaveCount(1)
            ->and($user->authentications->first())
            ->toBeInstanceOf(AuthenticationLog::class);
=======
        
        expect($user->authentications)->toHaveCount(1)
            ->and($user->authentications->first())->toBeInstanceOf(AuthenticationLog::class);
>>>>>>> fbc8f8e (.)
    });

    it('handles password expiration', function () {
        $user = createUser([
            'password_expires_at' => now()->subDay(),
        ]);
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        expect($user->password_expires_at->isPast())->toBeTrue();
    });

    it('supports OTP authentication', function () {
        $user = createUser(['is_otp' => true]);
<<<<<<< HEAD

        expect($user->is_otp)->toBeTrue();
    });
});
=======
        
        expect($user->is_otp)->toBeTrue();
    });
});
>>>>>>> fbc8f8e (.)
