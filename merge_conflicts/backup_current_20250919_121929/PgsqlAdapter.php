<?php

declare(strict_types=1);

namespace Modules\Xot\Services\Trend\Adapters;

<<<<<<< HEAD
use Override;
=======
>>>>>>> f1d4085 (.)
use Error;

class PgsqlAdapter extends AbstractAdapter
{
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    public function format(string $column, string $interval): string
    {
        $format = match ($interval) {
            'minute' => 'YYYY-MM-DD HH24:MI:00',
            'hour' => 'YYYY-MM-DD HH24:00:00',
            'day' => 'YYYY-MM-DD',
            'month' => 'YYYY-MM',
            'year' => 'YYYY',
            default => throw new Error('Invalid interval.'),
        };

        return sprintf("to_char(%s, '%s')", $column, $format);
    }
}
