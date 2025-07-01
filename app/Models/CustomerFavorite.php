<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFavorite extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFavoriteFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'thumb_url',
        'product_id',
        'customer_id',
    ];
}
