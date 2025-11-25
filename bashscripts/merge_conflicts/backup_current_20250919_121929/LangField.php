<?php

declare(strict_types=1);

namespace Modules\Lang\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Modules\Lang\Models\BaseModelLang;

class LangField implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param BaseModelLang $model
     * @param string        $key
<<<<<<< HEAD
     * @param mixed         $_value
     * @param array         $_attributes
     */
    public function get($model, $key, $_value, $_attributes)
=======
     * @param array         $attributes
     */
    public function get($model, $key, $value, $attributes)
>>>>>>> 8b0b6ac (.)
    {
        return $model->post->{$key};
    }

    /**
     * Prepare the given value for storage.
     *
     * @param BaseModelLang $model
     * @param string        $key
<<<<<<< HEAD
     * @param mixed         $value
     * @param array         $_attributes
     */
    public function set($model, $key, $value, $_attributes): array
=======
     * @param array         $attributes
     * @param string        $key
     * @param string        $value
     */
    public function set($model, $key, $value, $attributes): array
>>>>>>> 8b0b6ac (.)
    {
        $post = $model->post;
        $post->{$key} = $value;
        tap($post)->save();

        // parent::__construct([]);
        // return [$key => encrypt($value)];
        // return ['created_by' => 'xot'];
        return []; // tolgo l'aggiornamento di questo campo
    }
}
