<?php

declare(strict_types=1);

/**
 * @see https://github.com/barryvdh/laravel-translation-manager/blob/master/src/Models/Translation.php
 */

namespace Modules\Lang\Models;

use Sushi\Sushi;
<<<<<<< HEAD
use Override;
use Modules\Xot\Contracts\ProfileContract;
=======
>>>>>>> 8b0b6ac (.)
use Modules\Lang\Database\Factories\TranslationFileFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Modules\Lang\Actions\GetAllTranslationAction;
use Modules\Lang\Actions\ReadTranslationFileAction;
use Modules\Lang\Actions\WriteTranslationFileAction;
<<<<<<< HEAD

=======
>>>>>>> 8b0b6ac (.)
use function Safe\json_encode;

/**
 * @property string|null $key
 * @property string|null $path
 * @property string|null $id
 * @property string|null $name
 * @property array<array-key, mixed>|null $content
<<<<<<< HEAD
 * @property-read ProfileContract|null $creator
 * @property-read ProfileContract|null $updater
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> 8b0b6ac (.)
 * @method static TranslationFileFactory factory($count = null, $state = [])
 * @method static Builder<static>|TranslationFile newModelQuery()
 * @method static Builder<static>|TranslationFile newQuery()
 * @method static Builder<static>|TranslationFile query()
 * @method static Builder<static>|TranslationFile whereContent($value)
 * @method static Builder<static>|TranslationFile whereId($value)
 * @method static Builder<static>|TranslationFile whereKey($value)
 * @method static Builder<static>|TranslationFile whereName($value)
 * @method static Builder<static>|TranslationFile wherePath($value)
 * @mixin IdeHelperTranslationFile
 * @mixin \Eloquent
 */
class TranslationFile extends BaseModel
{
    use Sushi;

    protected $fillable = [
        'id',
        'name',
        'path',
        'content',
    ];

    protected array $schema = [
<<<<<<< HEAD
        'key' => 'string',
        'path' => 'string',
        'id' => 'string',
        'name' => 'string',
=======
        'key' => "string",
        'path' => "string",
        'id' => "string",
        'name' => "string",
>>>>>>> 8b0b6ac (.)
        'content' => 'json',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 8b0b6ac (.)
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function getRows(): array
    {
        $files = app(GetAllTranslationAction::class)->execute();
<<<<<<< HEAD
        $rows = Arr::map($files, function ($item) {
            $item['id'] = $item['key'];
            $item['name'] = basename($item['path'], '.php');

            $item['content'] = json_encode(File::getRequire($item['path']));
            /*
             * // Carica il contenuto del file
             * try {
             * $readAction = app(ReadTranslationFileAction::class);
             * $item['content'] = $readAction->execute($item['path']);
             * } catch (\Exception $e) {
             * $item['content'] = [];
             * }
             */
=======
        $rows = Arr::map($files, function($item) {
            $item['id'] = $item['key'];
            $item['name'] = basename($item['path'], '.php');


            $item['content']=json_encode(File::getRequire($item['path']));
            /*
            // Carica il contenuto del file
            try {
                $readAction = app(ReadTranslationFileAction::class);
                $item['content'] = $readAction->execute($item['path']);
            } catch (\Exception $e) {
                $item['content'] = [];
            }
            */
>>>>>>> 8b0b6ac (.)
            //dddx($item);
            return $item;
        });
        return $rows;
    }
<<<<<<< HEAD
}
=======

   
}
>>>>>>> 8b0b6ac (.)
