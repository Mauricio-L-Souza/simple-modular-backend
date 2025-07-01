<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    /** @use HasFactory<\Database\Factories\UserAccessFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];
}
