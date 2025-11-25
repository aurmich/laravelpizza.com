<?php

declare(strict_types=1);

namespace Modules\UI\Models;

use Modules\Xot\Contracts\ProfileContract;
use Modules\UI\Database\Factories\CollectionFactory;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Models\BaseModel;

/**
 * Collection model for UI module.
 * FormBuilder module not available - extending from XotBaseModel instead.
 */
/**
 * @property ProfileContract|null $creator
 * @property ProfileContract|null $updater
 *
 * @method static CollectionFactory factory($count = null, $state = [])
 * @method static Builder<static>|Collection newModelQuery()
 * @method static Builder<static>|Collection newQuery()
 * @method static Builder<static>|Collection query()
 *
 * @mixin \Eloquent
 */
class Collection extends BaseModel
{
    protected $table = 'collections';

    /** @var list<string> */
    protected $fillable = [
        'name',
        'description',
        'type',
    ];
}
