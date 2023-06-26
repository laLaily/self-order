<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Transactions
 *
 * @property-read \App\Models\Cashiers|null $cashiers
 * @property-read \App\Models\Customers|null $customers
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions query()
 * @property int $id
 * @property int $customerId
 * @property int|null $cashierId
 * @property string $transactionDate
 * @property int $subtotal
 * @property int $tax
 * @property int $totalPrice
 * @property string $status
 * @property string|null $paymentCode
 * @property string $updatedAt
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereCashierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions wherePaymentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transactions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transactions extends Model
{
    use HasFactory;
//    use SoftDeletes;

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    public function customers() : BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customerId');
    }
    public function cashiers() : BelongsTo
    {
        return $this->belongsTo(Cashiers::class, 'cashierId');
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'detailtransactions',
            'transactionId', 'productId');
    }

    public function detail(): HasMany
    {
        return $this->hasMany(DetailTransactions::class, 'transactionId');
    }
}
