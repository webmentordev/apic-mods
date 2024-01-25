<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Socket;
use App\Models\MemoryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motherboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'ram_slots',
        'memory_type_id',
        'socket_id',
        'size_id',
        'is_active'
    ];

    public function memory(){
        return $this->belongsTo(MemoryType::class, 'memory_type_id', 'id');
    }

    public function socket(){
        return $this->belongsTo(Socket::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }
}
