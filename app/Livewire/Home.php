<?php

namespace App\Livewire;

use App\Models\BuildCategory;
use App\Models\Gallery;
use App\Models\Package;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'categories' => BuildCategory::latest()->where('is_active', true)->with('images')->get(),
            'packages' => Package::where('is_active', true)->get()
        ]);
    }
}
