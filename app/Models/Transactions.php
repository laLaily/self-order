<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory;
//    use SoftDeletes;

    public $timestamps = false;

    protected $primaryKey = 'id';
    public function customers() : BelongsTo
    {
        return $this->BelongsTo(Customers::class, 'customerId');
    }

}
