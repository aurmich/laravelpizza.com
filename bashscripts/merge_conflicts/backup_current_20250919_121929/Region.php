<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Sushi\Sushi;
use Modules\Geo\Database\Factories\RegionFactory;
use Filament\Schemas\Components\Utilities\Get;
<<<<<<< HEAD
use Modules\Xot\Contracts\ProfileContract;
=======
>>>>>>> bc26394 (.)
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $name
<<<<<<< HEAD
 * @property-read ProfileContract|null $creator
 * @property-read Collection<int, Province> $provinces
 * @property-read int|null $provinces_count
 * @property-read ProfileContract|null $updater
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read Collection<int, Province> $provinces
 * @property-read int|null $provinces_count
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> bc26394 (.)
 * @method static Builder<static>|Region newModelQuery()
 * @method static Builder<static>|Region newQuery()
 * @method static Builder<static>|Region query()
 * @method static Builder<static>|Region whereId($value)
 * @method static Builder<static>|Region whereName($value)
 * @mixin IdeHelperRegion
 * @mixin \Eloquent
 */
class Region extends BaseModel
{
    use HasFactory;
    use Sushi;

    /**
     * The factory class for this model.
     *
     * @var class-string<Factory>
     */
    protected static $factory = RegionFactory::class;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

<<<<<<< HEAD
=======

>>>>>>> bc26394 (.)
    protected array $schema = [
        'id' => 'integer',
        'name' => 'string',
    ];

<<<<<<< HEAD
    public function getRows(): array
    {
        $rows = Comune::select('regione->codice as id', 'regione->nome as name')
            ->distinct()
            ->orderBy('regione->nome')
            ->get();

=======
    public function getRows(): array{
        $rows=Comune::select("regione->codice as id","regione->nome as name")
            ->distinct()
            ->orderBy("regione->nome")
            ->get();
       
>>>>>>> bc26394 (.)
        return $rows->toArray();
    }

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    public static function getOptions(Get $get): array
    {
        return self::orderBy('name')
            ->get()
<<<<<<< HEAD
            ->pluck('name', 'id')
            ->toArray();
    }
}
=======
            ->pluck("name", "id")
            ->toArray();
    }
}
>>>>>>> bc26394 (.)
