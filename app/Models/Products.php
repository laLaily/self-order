<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
