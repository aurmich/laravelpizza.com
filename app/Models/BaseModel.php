<?php

declare(strict_types=1);

namespace Modules\Gdpr\Models;

use Modules\Xot\Models\XotBaseModel;

// //use Laravel\Scout\Searchable;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends XotBaseModel
{
    /** @var string */
    protected $connection = 'user';
}
