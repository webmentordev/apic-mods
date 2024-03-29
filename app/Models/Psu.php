<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'power',
        'price',
        'image',
        'is_active'
    ];
}
