<?php

namespace App\Models;

use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\Searchable;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Post
 *
 * @property-read \Kalnoy\Nestedset\Collection<int, Post> $children
 * @property-read int|null $children_count
 * @property-read Post|null $parent
 * @property-write mixed $parent_id
 *
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNodeBetween($values, $boolean = 'and', $not = false, $query = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withoutRoot()
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    use MustBeApproved;
    use NodeTrait;
    use Searchable {
        \Laravel\Scout\Searchable::usesSoftDelete insteadof \Kalnoy\Nestedset\NodeTrait;
    }
    use Userstamps;
}
