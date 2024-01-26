<?php

namespace App\Models;

use App\Models\Motherboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemoryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function motherboards(){
        return $this->hasMany(Motherboard::class);
    }
}