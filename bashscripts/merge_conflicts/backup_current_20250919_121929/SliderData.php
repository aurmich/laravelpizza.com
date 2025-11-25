<?php

declare(strict_types=1);

namespace Modules\UI\Datas;

use Spatie\LaravelData\Data;

class SliderData extends Data
{
    public function __construct(
<<<<<<< HEAD
        public null|string $desktop_thumbnail,
        public null|string $mobile_thumbnail,
        public null|string $desktop_thumbnail_webp,
        public null|string $mobile_thumbnail_webp,
        public null|string $link,
        public null|string $title,
        public null|string $short_description,
        public null|string $description,
        public null|string $action_text,
=======
        public ?string $desktop_thumbnail,
        public ?string $mobile_thumbnail,
        public ?string $desktop_thumbnail_webp,
        public ?string $mobile_thumbnail_webp,
        public ?string $link,
        public ?string $title,
        public ?string $short_description,
        public ?string $description,
        public ?string $action_text,
>>>>>>> 727968c (.)
    ) {
        $this->short_description = $this->description;
    }
}
