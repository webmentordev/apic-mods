<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
        'aio_type',
        'image',
        'is_active'
    ];
}
