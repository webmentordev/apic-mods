<?php

namespace App\Models;

use App\Models\Socket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Processor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'socket_id',
        'is_active'
    ];

    public function socket(){
        return $this->belongsTo(Socket::class);
    }
}
