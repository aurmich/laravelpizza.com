<?php

declare(strict_types=1);

namespace Modules\Geo\Models;

use Sushi\Sushi;
use Filament\Schemas\Components\Utilities\Get;
<<<<<<< HEAD
use Modules\Xot\Contracts\ProfileContract;
=======
>>>>>>> bc26394 (.)
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
>>>>>>> bc26394 (.)

/**
 * @property int|null $region_id
 * @property int $id
 * @property string|null $name
<<<<<<< HEAD
 * @property-read ProfileContract|null $creator
 * @property-read Collection<int, Locality> $localities
 * @property-read int|null $localities_count
 * @property-read Region|null $region
 * @property-read ProfileContract|null $updater
=======
 * @property-read \Modules\SaluteOra\Models\Profile|null $creator
 * @property-read Collection<int, Locality> $localities
 * @property-read int|null $localities_count
 * @property-read Region|null $region
 * @property-read \Modules\SaluteOra\Models\Profile|null $updater
>>>>>>> bc26394 (.)
 * @method static Builder<static>|Province newModelQuery()
 * @method static Builder<static>|Province newQuery()
 * @method static Builder<static>|Province query()
 * @method static Builder<static>|Province whereId($value)
 * @method static Builder<static>|Province whereName($value)
 * @method static Builder<static>|Province whereRegionId($value)
 * @mixin IdeHelperProvince
 * @mixin \Eloquent
 */
class Province extends BaseModel
{
    use HasFactory;
    use Sushi;

    protected array $schema = [
        'region_id' => 'integer',
        'id' => 'integer',
        'name' => 'string',
    ];

<<<<<<< HEAD
    public function getRows(): array
    {
        $rows = Comune::select('regione->codice as region_id', 'provincia->codice as id', 'provincia->nome as name')
            ->distinct()
            ->orderBy('provincia->nome')
            ->get();

=======

    public function getRows(): array{
        $rows=Comune::select("regione->codice as region_id","provincia->codice as id","provincia->nome as name")
            ->distinct()
            ->orderBy("provincia->nome")
            ->get();
       
>>>>>>> bc26394 (.)
        return $rows->toArray();
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class);
    }

    public static function getOptions(Get $get): array
    {
<<<<<<< HEAD
        $region = $get('administrative_area_level_1') ?? $get('region');
        return self::where('region_id', $region)
            ->orderBy('name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
=======
        $region=$get('administrative_area_level_1') ?? $get('region');
        return self::where('region_id',$region)
            ->orderBy('name')
            ->get()
            ->pluck("name", "id")
            ->toArray();

            
    }
}
>>>>>>> bc26394 (.)
