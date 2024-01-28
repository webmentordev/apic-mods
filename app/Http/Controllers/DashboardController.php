<?php

namespace App\Http\Controllers;

use App\Models\BuildCategory;
use App\Models\Gallery;
use App\Models\Motherboard;
use App\Models\Package;
use App\Models\Processor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard', [
            'cpus' => Processor::count(),
            'cpu_price' => Processor::sum('price'),

            'motherboards' => Motherboard::count(),
            'motherboard_price' => Motherboard::sum('price'),

            'build_category' => BuildCategory::count(),
            'builds' => Gallery::count(),

            'packages' => Package::count(),
        ]);
    }
}
