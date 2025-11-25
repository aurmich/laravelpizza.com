<?php

declare(strict_types=1);

namespace Modules\Xot\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ViewExport implements FromView
{
    use Exportable;

    public View $view;

    /**
     * Summary of fields.
     *
     * @var array<string>
     */
<<<<<<< HEAD
    public null|array $fields = null;

    public null|string $transKey = null;
=======
    public ?array $fields = null;

    public ?string $transKey = null;
>>>>>>> f1d4085 (.)

    /**
     * Summary of __construct.
     *
     * @param array<string> $fields
     */
<<<<<<< HEAD
    public function __construct(View $view, null|string $transKey = null, null|array $fields = null)
=======
    public function __construct(View $view, ?string $transKey = null, ?array $fields = null)
>>>>>>> f1d4085 (.)
    {
        $this->view = $view;
        $this->transKey = $transKey;
        $this->fields = $fields;
    }

    public function view(): View
    {
        return $this->view;
    }
}
