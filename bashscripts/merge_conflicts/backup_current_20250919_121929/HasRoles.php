<?php

declare(strict_types=1);

namespace Modules\User\Models\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Models\Role;
use Spatie\Permission\Traits\HasRoles as SpatieHasRoles;

trait HasRoles
{
    use SpatieHasRoles;

    /**
     * A user may have multiple roles.
     */
    public function roles(): BelongsToMany
    {
<<<<<<< HEAD
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')->where(
            'model_type',
            self::class,
        );
=======
        return $this->belongsToMany(
            Role::class,
            'model_has_roles',
            'model_id',
            'role_id'
        )->where('model_type', self::class);
>>>>>>> fbc8f8e (.)
    }

    /**
     * Determine if the user has the given role.
     *
     * @param string|array|\Spatie\Permission\Contracts\Role|Collection $roles
     */
<<<<<<< HEAD
    public function hasRole($roles, null|string $guard = null): bool
    {
        if (is_string($roles) && str_contains($roles, '|')) {
=======
    public function hasRole($roles, ?string $guard = null): bool
    {
        if (is_string($roles) && false !== strpos($roles, '|')) {
>>>>>>> fbc8f8e (.)
            $roles = explode('|', $roles);
        }

        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }

            return false;
        }

<<<<<<< HEAD
        return !is_null($roles) && $this->roles->contains('id', $roles->id);
=======
        return ! is_null($roles) && $this->roles->contains('id', $roles->id);
>>>>>>> fbc8f8e (.)
    }
}
