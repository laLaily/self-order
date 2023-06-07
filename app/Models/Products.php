<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Products
 *
 * @property-read \App\Models\Cashiers|null $cashiers
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @property int $id
 * @property string $productCategory
 * @property string $productName
 * @property int $productPrice
 * @property int $productStock
 * @property string|null $updatedAt
 * @property int|null $updaterId
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdaterId($value)
 * @mixin \Eloquent
 */
class Products extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $guarded = [
        'id'
    ];

    public function cashiers() : BelongsTo{
        return $this->BelongsTo(Cashiers::class, 'updaterId');
    }
}
