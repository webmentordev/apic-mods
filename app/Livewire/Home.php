<?php

namespace App\Livewire;

use App\Models\Gallery;
use App\Models\Package;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'images' => Gallery::latest()->where('is_active', true)->get(),
            'packages' => Package::where('is_active', true)->get()
        ]);
    }
}
