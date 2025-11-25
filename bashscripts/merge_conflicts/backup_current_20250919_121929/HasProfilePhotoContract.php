<?php

declare(strict_types=1);

namespace Modules\User\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Contracts\HasProfilePhotoContract.
 *
 * @phpstan-require-extends Model
 */
interface HasProfilePhotoContract
{
<<<<<<< HEAD
    public function getFilamentAvatarUrl(): null|string;
=======
    public function getFilamentAvatarUrl(): ?string;
>>>>>>> fbc8f8e (.)

    /**
     * Update the user's profile photo.
     */
<<<<<<< HEAD
    public function updateProfilePhoto(null|string $photo): void;
=======
    public function updateProfilePhoto(?string $photo): void;
>>>>>>> fbc8f8e (.)

    /**
     * Delete the user's profile photo.
     */
    public function deleteProfilePhoto(): void;

    /**
     * Get the URL to the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): string;

    /**
     * Determine if the image file exists.
     */
    public function photoExists(): bool;

    public function filamentDefaultAvatar(): string;

    /**
     * Get the disk that profile photos should be stored on.
     */
    public function profilePhotoDisk(): string;

    /**
     * Get the directory that profile photos should be stored on.
     */
    public function profilePhotoDirectory(): string;
}
