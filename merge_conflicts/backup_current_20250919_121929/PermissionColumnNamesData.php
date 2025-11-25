<?php

declare(strict_types=1);

namespace Modules\User\Datas;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class PermissionColumnNamesData extends Data
{
<<<<<<< HEAD
    public null|string $role_pivot_key = null;

    // => null, // default 'role_id',
    public null|string $permission_pivot_key = null;
=======
    public ?string $role_pivot_key = null;

    // => null, // default 'role_id',
    public ?string $permission_pivot_key = null;
>>>>>>> fbc8f8e (.)

    // => null, // default 'permission_id',
    public string $model_morph_key;

    // => 'model_id',
    public string $team_foreign_key; // => 'team_id',
}
