<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DetailTransactions
 *
 * @property-read \App\Models\Products|null $products
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions query()
 * @property int $transactionId
 * @property int $productId
 * @property int $quantity
 * @property int $quantityPrice
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions whereQuantityPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DetailTransactions whereTransactionId($value)
 * @mixin \Eloquent
 */
class DetailTransactions extends Model
{
    use HasFactory;

    protected $table = 'detailtransactions';

    protected $guarded = ['id'];

    protected $primaryKey = 'transactionId';
    public function products() : BelongsTo
    {
        return $this->BelongsTo(Products::class, 'productId');
    }

    public $timestamps = false;
}
