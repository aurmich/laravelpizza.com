<?php

declare(strict_types=1);

namespace Modules\Xot\DTOs;

use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class FieldFilterDTO extends Data
{
    public function __construct(
        public string $param_name,
        public string $field_name,
<<<<<<< HEAD
        public null|string $where_method,
        public null|string $rules,
    ) {}
=======
        public ?string $where_method,
        public ?string $rules,
    ) {
    }
>>>>>>> f1d4085 (.)
}
