<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Customers
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Customers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customers query()
 * @property int $id
 * @property string $customerName
 * @property string $customerPhone
 * @method static \Illuminate\Database\Eloquent\Builder|Customers whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customers whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customers whereId($value)
 * @mixin \Eloquent
 */
class Customers extends Model
{
    use HasFactory;
//    use SoftDeletes;

    protected $primaryKey = 'id';

    public $timestamps = false;
}
