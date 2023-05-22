<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Cashiers extends Model
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
}
