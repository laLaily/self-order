<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

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
class Customers extends Authenticatable implements JWTSubject
{
    use Notifiable;
//    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [
            'role' => 'customers'
        ];
    }
}
