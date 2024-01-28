<?php

namespace App\Models;

use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PcCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size_id',
        'price',
        'image',
        'is_active'
    ];

    public function size(){
        return $this->belongsTo(Size::class);
    }
}