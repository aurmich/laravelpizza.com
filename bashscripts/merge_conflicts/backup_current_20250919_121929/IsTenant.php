<?php

declare(strict_types=1);

namespace Modules\User\Models\Traits;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
=======
>>>>>>> fbc8f8e (.)
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\User\Contracts\TeamContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> fbc8f8e (.)

/**
 * Undocumented trait.
 *
 * @property TeamContract $currentTeam
 */
trait IsTenant
{
    /**
     * Get all users associated with this tenant.
     *
     * @return BelongsToMany<Model&UserContract, static>
     */
    public function users(): BelongsToMany
    {
        $xot = XotData::make();
        $userClass = $xot->getUserClass();

        // $this->setConnection('mysql');
        /** @var class-string<Model&UserContract> $userClass */
        return $this->belongsToManyX($userClass, null, 'tenant_id', 'user_id');
<<<<<<< HEAD

=======
>>>>>>> fbc8f8e (.)
        // ->as('membership')
    }

    /*
     * Method to create a belongsToMany relationship.
<<<<<<< HEAD
     *
     * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
     *
=======
     * 
     * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
     * 
>>>>>>> fbc8f8e (.)
     * @param class-string<TRelatedModel> $related The related model class
     * @param string|null $table The pivot table name
     * @param string $foreignPivotKey The foreign key in pivot table
     * @param string $relatedPivotKey The related key in pivot table
     * @param string|null $parentKey The parent key
     * @param string|null $relatedKey The related key
     * @param string|null $relation The relation name
<<<<<<< HEAD
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<TRelatedModel, static>
     *
     * public function belongsToManyX(
     * string $related,
     * ?string $table = null,
     * ?string $foreignPivotKey = 'tenant_id',
     * ?string $relatedPivotKey = 'user_id',
     * ?string $parentKey = null,
     * ?string $relatedKey = null,
     * ?string $relation = null
     * ): BelongsToMany {
     * return $this->belongsToMany($related, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relation);
     * }
     */
=======
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<TRelatedModel, static>

    public function belongsToManyX(
        string $related,
        ?string $table = null,
        ?string $foreignPivotKey = 'tenant_id',
        ?string $relatedPivotKey = 'user_id',
        ?string $parentKey = null,
        ?string $relatedKey = null,
        ?string $relation = null
    ): BelongsToMany {
        return $this->belongsToMany($related, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $relation);
    }
        */
>>>>>>> fbc8f8e (.)
}
