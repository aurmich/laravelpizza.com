<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Support;

use Illuminate\Database\Eloquent\Model;

/**
 * Test model for XotBaseTransition testing.
 *
 * @internal
 *
 * @coversNothing
 */
class TestModelForTransition extends Model
{
    /** @var string */
    protected $table = 'test_transitions';

    /** @var list<string> */
    protected $fillable = ['name', 'state'];

    /** @var bool */
    public $timestamps = false;

    /**
     * Get mock key for testing.
     */
    public function getKey(): int
    {
        return 1;
    }

    /**
     * Check if model exists.
     */
    public function exists(): bool
    {
        return true;
    }
}
