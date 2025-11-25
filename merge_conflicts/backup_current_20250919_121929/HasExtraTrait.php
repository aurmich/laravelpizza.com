<?php

declare(strict_types=1);

namespace Modules\Xot\Models\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\ExtraContract;
use Modules\Xot\Models\Extra;
use Webmozart\Assert\Assert;

use function Safe\json_encode;

/**
 * Modules\Xot\Models\HasExtraTrait.
 *
 * @property string $currency
 * @property float $price
 * @property string $price_complete
 * @property int $qty
 * @property ExtraContract|null $extra
 */
trait HasExtraTrait
{
    /**
     * Retrieves the morphed one-to-one relationship between the current model and the Extra model.
     *
     * return MorphOne<ExtraContract>
     */
    public function extra(): MorphOne
    {
        $extra_class = Str::of(static::class)
            ->before('\Models\\')
            ->append('\Models\Extra')
            ->toString();
        Assert::classExists($extra_class);
<<<<<<< HEAD
        Assert::isAOf(
            $extra_class,
            Model::class,
            '[' . __LINE__ . '][' . class_basename($this) . '][' . $extra_class . ']',
        );
=======
        Assert::isAOf($extra_class, Model::class, '['.__LINE__.']['.class_basename($this).']['.$extra_class.']');
>>>>>>> f1d4085 (.)
        // Assert::isInstanceOf($extra_class, ExtraContract::class, '['.__LINE__.']['.class_basename($this).']['.$extra_class.']');
        // Assert::implementsInterface($extra_class, ExtraContract::class, '['.__LINE__.']['.class_basename($this).']['.$extra_class.']');

        return $this->morphOne($extra_class, 'model');
    }

    /**
     * @return array<string, mixed>|bool|int|string|null
     */
    public function getExtra(string $name): array|bool|int|string|null
    {
<<<<<<< HEAD
        if ($this->extra === null) {
=======

        if ($this->extra == null) {
>>>>>>> f1d4085 (.)
            return null;
        }
        $value = $this->extra->extra_attributes->get($name);
        if (
<<<<<<< HEAD
            is_array($value) ||
                is_int($value) ||
                // || is_float($value)
                is_null($value) ||
                is_bool($value) ||
                is_string($value)
=======
            is_array($value) || is_int($value)
            // || is_float($value)
            || is_null($value) || is_bool($value)
            || is_string($value)
>>>>>>> f1d4085 (.)
        ) {
            /** @var array<string, mixed>|bool|int|string|null */
            return $value;
        }
<<<<<<< HEAD
        throw new Exception('[' . __LINE__ . '][' . __CLASS__ . ']');
=======
        throw new Exception('['.__LINE__.']['.__CLASS__.']');
>>>>>>> f1d4085 (.)
    }

    /**
     * @param  int|float|string|array<string, mixed>|bool|null  $value
     * @return void
     */
    public function setExtra(string $name, $value)
    {
        $extra = $this->extra;
        if ($this->extra === null) {
            // $extra = $this->extra()->firstOrCreate([], ['extra_attributes' => []]);
<<<<<<< HEAD
            $extra = $this->extra()->firstOrCreate([], ['extra_attributes' => json_encode([])]);
            Assert::implementsInterface(
                $extra,
                ExtraContract::class,
                '[' . __LINE__ . '][' . class_basename($this) . '][' . $extra . ']',
            );
        }
        Assert::notNull($extra);
        // $extra is asserted to be non-null above
=======
            $extra = $this->extra()
                ->firstOrCreate([], ['extra_attributes' => json_encode([])]);
            Assert::implementsInterface($extra, ExtraContract::class, '['.__LINE__.']['.class_basename($this).']['.$extra.']');
        }
        Assert::notNull($extra);
>>>>>>> f1d4085 (.)
        $extra->extra_attributes->set($name, $value);
        $extra->save();
    }
}
