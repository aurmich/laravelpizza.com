<?php

<<<<<<< HEAD
declare(strict_types=1);


=======
>>>>>>> f1d4085 (.)
namespace Modules\Xot\Datas\Transformers;

use Modules\Xot\Actions\File\AssetAction;
use Spatie\LaravelData\Support\DataProperty;
<<<<<<< HEAD
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;
=======
use Spatie\LaravelData\Transformers\Transformer;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
>>>>>>> f1d4085 (.)

/**
 * AssetTransformer - Trasforma riferimenti di file in percorsi completi per le risorse
 *
 * Formato input: "module::path/file.ext" o "file.ext"
 * Output: "/modules/module/resources/path/file.ext" o "/resources/path/file.ext"
 */
class AssetTransformer implements Transformer
{
    /**
     * Trasforma un riferimento di file in un percorso completo
     *
<<<<<<< HEAD
     * @param DataProperty $_property La proprietà di dati (non utilizzata)
     * @param mixed $value Il valore da trasformare (es. "user::image.png")
     * @param TransformationContext $_context Il contesto di trasformazione (non utilizzato)
     * @return string Il percorso completo (es. "/modules/user/resources/image.png")
     */
    public function transform(DataProperty $_property, $value, TransformationContext $_context): string
    {
=======
     * @param DataProperty $property La proprietà di dati
     * @param mixed $value Il valore da trasformare (es. "user::image.png")
     * @param TransformationContext $context Il contesto di trasformazione
     * @return string Il percorso completo (es. "/modules/user/resources/image.png")
     */
    public function transform(
        DataProperty $property,
        $value,
        TransformationContext $context
    ):string {
>>>>>>> f1d4085 (.)
        if (!is_string($value) || empty($value)) {
            return '';
        }
        return app(AssetAction::class)->execute($value);
    }
<<<<<<< HEAD
=======


>>>>>>> f1d4085 (.)
}
