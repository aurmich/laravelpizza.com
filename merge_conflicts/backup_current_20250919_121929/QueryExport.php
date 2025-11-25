<?php

declare(strict_types=1);

namespace Modules\Xot\Exports;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Lang\Actions\TransCollectionAction;

// use Staudenmeir\LaravelCte\Query\Builder as CteBuilder;

class QueryExport implements FromQuery, ShouldQueue, WithChunkReading, WithHeadings, WithMapping
{
    use Exportable;

    public array $headings = [];

    /** @var array<int, string> */
    public array $fields = [];

<<<<<<< HEAD
    public null|string $transKey = null;
=======
    public ?string $transKey = null;
>>>>>>> f1d4085 (.)

    public QueryBuilder|EloquentBuilder $query;

    /**
     * @param array<int, string> $fields
     */
<<<<<<< HEAD
    public function __construct(QueryBuilder|EloquentBuilder $query, null|string $transKey = null, array $fields = [])
=======
    public function __construct(QueryBuilder|EloquentBuilder $query, ?string $transKey = null, array $fields = [])
>>>>>>> f1d4085 (.)
    {
        $this->query = $query;
        $this->transKey = $transKey;
        $this->fields = $fields;

        /*
<<<<<<< HEAD
         * $this->headings = collect($query->first())
         * ->keys()
         * ->map(
         * function ($item) use ($transKey) {
         * $t = $transKey.'.'.$item;
         * $trans = trans($t);
         * if ($trans != $t) {
         * return $trans;
         * }
         *
         * return $item;
         * }
         * )
         * ->toArray();
         */
=======
        $this->headings = collect($query->first())
            ->keys()
            ->map(
                function ($item) use ($transKey) {
                    $t = $transKey.'.'.$item;
                    $trans = trans($t);
                    if ($trans != $t) {
                        return $trans;
                    }

                    return $item;
                }
            )
            ->toArray();
        */
>>>>>>> f1d4085 (.)
    }

    public function getHead(): Collection
    {
<<<<<<< HEAD
        if (!empty($this->fields)) {
=======
        if (! empty($this->fields)) {
>>>>>>> f1d4085 (.)
            return collect($this->fields);
        }
        /**
         * @var Arrayable<(int|string), mixed>|iterable<(int|string), mixed>|null
         */
        $first = $this->query->first();
        if (null === $first) {
            return collect([]);
        }

        // Parameter #1 $value of function collect expects Illuminate\Contracts\Support\Arrayable<(int|string), mixed>|iterable<(int|string), mixed>|null, object given.
        return collect($first)->keys();
    }

    public function headings(): array
    {
        $headings = $this->getHead();
        $transKey = $this->transKey;
        $headings = app(TransCollectionAction::class)->execute($headings, $transKey);

        return $headings->toArray();
    }

    /**
     * se si usa scout aggiungere |ScoutBuilder.
     */
    public function query(): QueryBuilder|EloquentBuilder|Relation
    {
        return $this->query;
<<<<<<< HEAD

=======
>>>>>>> f1d4085 (.)
        // ->orderBy('id');
    }

    public function chunkSize(): int
    {
        return 200;
    }

    /**
     * @param Arrayable<(int|string), mixed>|iterable<(int|string), mixed>|null $item
     */
    public function map($item): array
    {
<<<<<<< HEAD
        if (!empty($this->fields)) {
=======
        if (! empty($this->fields)) {
>>>>>>> f1d4085 (.)
            return collect($item)->toArray();
        }

        // rameter #1 $value of function collect expects Illuminate\Contracts\Support\Arrayable<(int|string), mixed>|iterable<(int|string), mixed>|null, object given.
<<<<<<< HEAD
        return collect($item)->only($this->fields)->toArray();
=======
        return collect($item)
            ->only($this->fields)
            ->toArray();
>>>>>>> f1d4085 (.)
    }
}
