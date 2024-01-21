<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
        'is_active',
        'is_featured'
    ];

    public function images(){
        return $this->hasMany(Gallery::class)->where('is_active', true);
    }
}