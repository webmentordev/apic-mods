<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterCooler extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'is_active'
    ];
}
