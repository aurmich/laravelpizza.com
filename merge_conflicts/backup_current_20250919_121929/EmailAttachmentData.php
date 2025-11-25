<?php

declare(strict_types=1);

namespace Modules\Notify\Datas;

use Spatie\LaravelData\Data;

class EmailAttachmentData extends Data
{
    public function __construct(
        private string $content,
        public string $name,
<<<<<<< HEAD
        public string $contentType = 'application/octet-stream',
=======
        public string $contentType = 'application/octet-stream'
>>>>>>> b19cd40 (.)
    ) {}

    public function getContent(): string
    {
        return $this->content;
    }
}
