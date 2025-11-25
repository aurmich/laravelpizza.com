<?php

declare(strict_types=1);

namespace Modules\UI\Tests\Unit\Widgets;

use Illuminate\Database\Eloquent\Model;

class MockEventModel extends Model
{
    /** @var list<string> */
    protected $fillable = ['title', 'start', 'end', 'color'];

    public function getTable(): string
    {
        return 'mock_events';
    }
}
<?php

declare(strict_types=1);

namespace Modules\UI\Tests\Unit\Widgets;

use Illuminate\Database\Eloquent\Model;

/**
 * Modello Eloquent di supporto per i test del calendario.
 */
class MockEventModel extends Model
{
    protected $fillable = ['title', 'start', 'end', 'color'];

    public function getTable(): string
    {
        return 'mock_events';
    }
}

