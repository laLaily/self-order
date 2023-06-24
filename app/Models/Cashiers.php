<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Cashiers
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers query()
 * @property int $id
 * @property string $cashierName
 * @property string $cashierPhone
 * @property string $username
 * @property string $password
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers whereCashierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers whereCashierPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashiers whereUsername($value)
 * @mixin \Eloquent
 */
class Cashiers extends Authenticatable implements JWTSubject
{
    use HasFactory;
//    use SoftDeletes;

    protected $primaryKey = 'id';

//    public function password(): Attribute
//    {
//        return new  Attribute(
//            set: fn ($value) => Hash::make($value),
//        );
//    }

//    public function username(): Attribute
//    {
//        return new Attribute(
//            set: fn ($value) => strtolower($value),
//        );
//    }

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
            'role' => 'cashier',
            'phone' => $this->attributes['cashierPhone'],
        ];
    }
}
