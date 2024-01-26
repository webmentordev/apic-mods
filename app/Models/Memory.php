<?php

namespace App\Models;

use App\Models\MemoryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'memory_type_id'
    ];

    public function memory_type(){
        return $this->belongsTo(MemoryType::class);
    }
}