<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'processor',
        'motherboard',
        'ram',
        'nvmes',
        'ssds',
        'gpu',
        'case',
        'cooler',
        'total',
        'type',
        'cover',
        'fans',
        'cont',
        'extra'
    ];
}