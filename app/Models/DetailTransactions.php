<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransactions extends Model
{
    use HasFactory;

    protected $table = 'detailtransactions';

    public function products() : BelongsTo
    {
        return $this->BelongsTo(Products::class, 'productId');
    }

    public $timestamps = false;
}
