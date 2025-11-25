<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Modules\Geo\Database\Factories\StateFactory;
use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD
use Modules\Xot\Contracts\ProfileContract;
=======
>>>>>>> bc26394 (.)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Builder|State newModelQuery()
 * @method static Builder|State newQuery()
 * @method static Builder|State query()
<<<<<<< HEAD
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> bc26394 (.)
 * @mixin IdeHelperState
 * @mixin \Eloquent
 */
class State extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return StateFactory
     */
    protected static function newFactory(): StateFactory
    {
        return StateFactory::new();
    }

    protected $fillable = [
        'state',
        'state_code',
    ];
}
