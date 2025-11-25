<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class HasManyRelationData extends Data
{
    /**
     * @param array<string, mixed>   $updateData
     * @param array<int|string>|null $from
     * @param array<int|string>|null $to
     */
    public function __construct(
        public string $foreignKey,
        public mixed $parentKey,
        public array $updateData,
        #[MapInputName('from')]
<<<<<<< HEAD
        public null|array $from = null,
        #[MapInputName('to')]
        public null|array $to = null,
    ) {}
=======
        public ?array $from = null,
        #[MapInputName('to')]
        public ?array $to = null,
    ) {
    }
>>>>>>> f1d4085 (.)
}
