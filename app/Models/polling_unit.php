<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class polling_unit extends Model
{
    use HasFactory;
    protected $table = 'polling_unit';

    // public function product(): BelongsTo
    // {
    //     return $this->belongsTo(Products::class, 'prod_id', 'id');
    // }
}
