<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Models\ProductAttribute
 *
 * @property int $id
 * @property int $quantity
 * @property string|null $price
 * @property string $product_id
 * @property string|null $length
 * @property string|null $width
 * @property string|null $height
 * @property string|null $distance_unit
 * @property string|null $weight
 * @property string|null $mass_unit
 * @property int|null $product_attribute_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AttributeValue> $attributesValues
 * @property-read int|null $attributes_values_count
 * @property-read \App\Models\Product|null $product
 * @method static \Database\Factories\ProductAttributeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereDistanceUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereMassUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereProductAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereWidth($value)
 * @mixin \Eloquent
 */
class ProductAttribute extends Model
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default'
    ];
    public $sortable = [
        'order_column_name' => 'record_ordering',
        'sort_when_creating' => true,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }
}
