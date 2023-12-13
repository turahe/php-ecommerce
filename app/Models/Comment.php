<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Comment extends Model implements Sortable
{
    use HasFactory;
    use HasUlids;
    use SortableTrait;
    use NodeTrait;

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

    public $sortable = [
        'order_column_name' => 'record_ordering',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime'
    ];
}
