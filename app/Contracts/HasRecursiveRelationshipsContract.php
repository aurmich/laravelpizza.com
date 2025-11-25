<?php

declare(strict_types=1);

namespace Modules\Xot\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Ancestors;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Bloodline;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Descendants;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\RootAncestor;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\RootAncestorOrSelf;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Siblings;

/**
 * Modules\Xot\Contracts\HasRecursiveRelationshipsContract.
 *
 * @property int $id
 * @property string $name
 * @property int $depth
 * @property Collection<static> $children
 * @property int|null $children_count
 * @property Collection<static> $ancestors The model's recursive parents.
 * @property int|null $ancestors_count
 * @property Collection<static> $ancestorsAndSelf The model's recursive parents and itself.
 * @property int|null $ancestors_and_self_count
 * @property Collection<static> $bloodline The model's ancestors, descendants and itself.
 * @property int|null $bloodline_count
 * @property Collection<static> $childrenAndSelf The model's direct children and itself.
 * @property int|null $children_and_self_count
 * @property Collection<static> $descendants The model's recursive children.
 * @property int|null $descendants_count
 * @property Collection<static> $descendantsAndSelf The model's recursive children and itself.
 * @property int|null $descendants_and_self_count
 * @property Collection<static> $parentAndSelf The model's direct parent and itself.
 * @property int|null $parent_and_self_count
 *
 * @phpstan-require-extends Model
 *
 * @mixin \Eloquent
 */
interface HasRecursiveRelationshipsContract
{
    /**
     * Execute a query with a maximum depth constraint for the recursive query.
     */
    public static function withMaxDepth(int $maxDepth, callable $query): mixed;

    /**
     * Get the name of the parent key column.
     */
    public function getParentKeyName(): string;

    /**
     * Get the name of the path column.
     */
    public function getPathName(): string;

    /**
     * Get the path separator.
     */
    public function getPathSeparator(): string;

    /**
     * Get the additional custom paths.
     *
     * @return array<string>
     */
    public function getCustomPaths(): array;

    /**
     * Get the name of the common table expression.
     */
    public function getExpressionName(): string;

    /**
     * Get the model's ancestors.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Ancestors<static>
     */
    public function ancestors(): Ancestors;

    /**
     * Get the model's ancestors and itself.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Ancestors<static>
     */
    public function ancestorsAndSelf(): Ancestors;

    /**
     * Get the model's bloodline.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Bloodline<static>
     */
    public function bloodline(): Bloodline;

    /**
     * Get the model's children.
     *
     * return \Illuminate\Database\Eloquent\Relations\HasMany<static>
     */
    public function children(): HasMany;

    /**
     * Get the model's children and itself.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Descendants<static>
     */
    public function childrenAndSelf(): Descendants;

    /**
     * Get the model's descendants.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Descendants<static>
     */
    public function descendants(): Descendants;

    /**
     * Get the model's descendants and itself.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Descendants<static>
     */
    public function descendantsAndSelf(): Descendants;

    /**
     * Get the model's parent.
     *
     * return \Illuminate\Database\Eloquent\Relations\BelongsTo<static, static>
     */
    public function parent(): BelongsTo;

    /**
     * Get the model's parent and itself.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Ancestors<static>
     */
    public function parentAndSelf(): Ancestors;

    /**
     * Get the model's root ancestor.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\RootAncestor<static>
     */
    public function rootAncestor(): RootAncestor;

    /**
     * Get the model's root ancestor or self.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\RootAncestorOrSelf<static>
     */
    public function rootAncestorOrSelf(): RootAncestorOrSelf;

    /**
     * Get the model's siblings.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Siblings<static>
     */
    public function siblings(): Siblings;

    /**
     * Get the model's siblings and itself.
     *
     * return \Staudenmeir\LaravelAdjacencyList\Eloquent\Relations\Siblings<static>
     */
    public function siblingsAndSelf(): Siblings;

    /**
     * Get the first segment of the model's path.
     */
    public function getFirstPathSegment(): string;

    /**
     * Determine whether the model's path is nested.
     */
    public function hasNestedPath(): bool;

    /**
     * Determine if an attribute is an integer.
     */
    public function isIntegerAttribute(string $attribute): bool;

    /**
     * added by XOT, viene utilizzato nelle options delle select.
     */
    public function getLabel(): string;
}
