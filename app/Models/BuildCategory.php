<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
        'is_active',
        'is_featured'
    ];
}