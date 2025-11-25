<?php

declare(strict_types=1);

namespace Modules\User\Models;

use Modules\Xot\Models\Traits\RelationX;
use Modules\Xot\Models\Traits\HasXotFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use RelationX;
    use HasXotFactory;

    /** @var string */
    protected $connection = 'user';

    /** @var string */
    protected $table = 'permissions';

    /** @var list<string> */
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];
}
