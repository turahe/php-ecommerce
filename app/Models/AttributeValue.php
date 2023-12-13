<?php

namespace App\Models;

use Spatie\EloquentSortable\SortableTrait;
use Turahe\Master\Models\Model;

/**
 * App\Models\AttributeValue
 *
 * @property-read \App\Models\Attribute|null $attribute
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductAttribute> $productAttributes
 * @property-read int|null $product_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoFilter($filter = 'filter')
 * @method static \Illuminate\Database\Eloquent\Builder|Model autoSort($sortByKey = 'sort', $sortDirectionKey = 'direction')
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model search($keyword)
 * @mixin \Eloquent
 */
class AttributeValue extends Model
{
    protected $fillable = [
        'value'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class);
    }

}
