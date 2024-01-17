<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'images' => Gallery::latest()->get()
        ]);
    }
}
