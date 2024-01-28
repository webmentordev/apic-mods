<?php

namespace App\Models;

use App\Models\PcCase;
use App\Models\Motherboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'size'
    ];

    public function motherboards(){
        return $this->hasMany(Motherboard::class);
    }

    public function cases(){
        return $this->hasMany(PcCase::class);
    }
}
