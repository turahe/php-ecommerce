<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Turahe\Master\Traits\SortableTrait;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Category
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $cover
 * @property int $status
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property-read \Kalnoy\Nestedset\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @property-read Category|null $parent
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereCover($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereCreatedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDeletedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDeletedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereNodeBetween($values, $boolean = 'and', $not = false, $query = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereStatus($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereUpdatedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category withoutRoot()
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @property string|null $type
 * @property int|null $record_left
 * @property int|null $record_right
 * @property-read \Kalnoy\Nestedset\Collection<int, \App\Models\Post> $post
 * @property-read int|null $post_count
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereRecordLeft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereRecordRight($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Category whereType($value)
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;
    use HasUlids;
    use NodeTrait;
    use Searchable {
        \Laravel\Scout\Searchable::usesSoftDelete insteadof \Kalnoy\Nestedset\NodeTrait;
    }
    use Userstamps;

    protected $dateFormat = 'U';

    /**
     * @return string
     */
    public function getLftName()
    {
        return 'record_left';
    }

    /**
     * @return string
     */
    public function getRgtName()
    {
        return 'record_right';
    }

    /**
     * @return string
     */
    public function getParentIdName()
    {
        return 'parent_id';
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function post()
    {
        return $this->hasMany(Post::class);

    }


}
