<?php

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\Data;

/**
 * Undocumented class.
 */
class JsonResponseData extends Data
{
    public bool $success = true; // => false,

    public string $message;

<<<<<<< HEAD
    public null|int $code = null;
=======
    public ?int $code = null;
>>>>>>> f1d4085 (.)

    public array $data = [];

    public int $status = 200;

    /*
<<<<<<< HEAD
     * public function toResponse($request)
     * {
     *
     * }
     */
=======
    public function toResponse($request)
    {

    }
    */
>>>>>>> f1d4085 (.)
    public function response(): JsonResponse
    {
        $data = [
            'success' => $this->success,
            'message' => $this->message,
            'code' => $this->code,
            'data' => $this->data,
            'now' => now(),
        ];

        return response()->json($data, $this->status);
    }
}
