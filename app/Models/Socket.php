<?php

namespace App\Models;

use App\Models\Processor;
use App\Models\Motherboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Socket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function motherboards(){
        return $this->hasMany(Motherboard::class);
    }

    public function processors(){
        return $this->hasMany(Processor::class);
    }
}