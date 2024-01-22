<?php

namespace App\Models;

use App\Models\BuildCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'build_category_id',
        'is_active'
    ];

    public function category(){
        return $this->belongsTo(BuildCategory::class, 'build_category_id', 'id');
    }
}