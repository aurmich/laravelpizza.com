<?php

declare(strict_types=1);

namespace Modules\Media\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

use function in_array;

class FileExtensionRule implements Rule
{
    protected array $validExtensions = [];

    public function __construct(array $validExtensions = [])
    {
<<<<<<< HEAD
        $this->validExtensions = array_map(mb_strtolower(...), $validExtensions);
    }

    /**
     * @param  mixed $_attribute The attribute being validated (not used in this rule)
     * @param  UploadedFile  $value The uploaded file to validate
     */
    public function passes($_attribute, $value): bool
    {
        return in_array(mb_strtolower($value->getClientOriginalExtension()), $this->validExtensions, strict: false);
=======
        $this->validExtensions = array_map(
            static fn (string $extension): string => mb_strtolower($extension),
            $validExtensions,
        );
    }

    /**
     * @param  string $attribute
     * @param  UploadedFile  $value
     */
    public function passes($attribute, $value): bool
    {
        return in_array(
            mb_strtolower($value->getClientOriginalExtension()),
            $this->validExtensions,
            strict: false,
        );
>>>>>>> 0a466ed (.)
    }

    public function message(): array|string
    {
<<<<<<< HEAD
        return trans('media::validation.mime', [
            'mimes' => implode(', ', $this->validExtensions),
        ]);
=======
        return trans(
            'media::validation.mime',
            [
                'mimes' => implode(', ', $this->validExtensions),
            ]
        );
>>>>>>> 0a466ed (.)
    }
}
