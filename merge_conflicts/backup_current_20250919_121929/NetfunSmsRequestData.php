<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> b19cd40 (.)
namespace Modules\Notify\Datas;

use Spatie\LaravelData\Data;

class NetfunSmsRequestData extends Data
{
    public function __construct(
        public string $token,
        public array $messages,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            token: $data['token'],
<<<<<<< HEAD
            messages: $data['messages'],
=======
            messages: $data['messages']
>>>>>>> b19cd40 (.)
        );
    }
}
