<?php

namespace App\Models;

use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Scout\Searchable;
use League\CommonMark\CommonMarkConverter;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Wildside\Userstamps\Userstamps;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $category_id
 * @property string|null $description description of post
 * @property string $content_raw
 * @property string $content_html
 * @property string $type
 * @property int $is_sticky
 * @property string|null $published_at
 * @property string $language
 * @property string|null $layout
 * @property int $record_ordering
 * @property int|null $record_left
 * @property int|null $record_right
 * @property string|null $parent_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Kalnoy\Nestedset\Collection<int, Post> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $destroyer
 * @property-read \App\Models\User|null $editor
 * @property-read Post|null $parent
 * @property-read \App\Models\Product|null $product
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
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post ordered(string $direction = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereCategoryId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereContentHtml($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereContentRaw($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereCreatedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDeletedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDeletedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsSticky($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereLanguage($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereLayout($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNodeBetween($values, $boolean = 'and', $not = false, $query = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post wherePublishedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereRecordLeft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereRecordOrdering($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereRecordRight($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereTitle($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereType($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereUpdatedBy($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withoutRoot()
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @mixin \Eloquent
 */
class Post extends Model implements Sortable
{
    use HasFactory;
//    use MustBeApproved;
    use NodeTrait;
    use HasUlids;
    use HasSlug;
    use Searchable {
        \Laravel\Scout\Searchable::usesSoftDelete insteadof \Kalnoy\Nestedset\NodeTrait;
    }
    use SortableTrait;
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
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public $sortable = [
        'order_column_name' => 'record_ordering',
        'sort_when_creating' => true,
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
    /**
     * Return collection of addresses related to the tagged model.
     * Ordered comment by latest published.
     * And get comment was approved by user or admin.
     *
     * @return
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'model');
    }

    /**
     * Set the HTML content automatically when the raw content is set.
     *
     * @param string $value
     */
    public function setContentRawAttribute(string $value): void
    {
        $markdown = new CommonMarkConverter();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->convert($value);
    }

    /**
     * Alias for content_raw.
     * @return string
     */
    public function getContentAttribute(): string
    {
        return $this->content_raw;
    }

    /**
     * @return mixed|string
     */
    public function getExcerptAttribute(): string
    {
        if ($this->description !== null) {
            return $this->description;
        }

        return Str::limit($this->content_raw);
    }
    /**
     * Scope a query to only include published blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where([
                ['status', '=', 1],
                ['approved', '=', 1],
                ['published_at', '<=', now()],
            ]);
    }

    public function product()
    {
        return $this->hasOne(Product::class);

    }
    public function category()
    {
        return $this->belongsTo(Category::class);

    }
}
