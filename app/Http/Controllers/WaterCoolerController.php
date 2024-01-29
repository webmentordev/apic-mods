<?php

namespace App\Http\Controllers;

use App\Models\WaterCooler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaterCoolerController extends Controller
{
    public function index(){
        return view('pc.water_coolers.index', [
            'coolers' => WaterCooler::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.water_coolers.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:water_coolers,name',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        WaterCooler::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image->store('watercoolers', 'public_disk')
        ]);
        return back()->with('success', 'Water Cooler has been Added');
    }

    public function active(WaterCooler $watercooler){
        $watercooler->is_active = !$watercooler->is_active;
        $watercooler->save();
        return back()->with('success', 'Water cooler status has been changed!');
    }

    public function delete(WaterCooler $watercooler){
        $watercooler->delete();
        return back()->with('success', 'Water Cooler has been deleted');
    }

    public function update(WaterCooler $watercooler){
        return view('pc.water_coolers.update', [
            'cooler' => $watercooler
        ]);
    }

    public function update_watercooler(Request $request, WaterCooler $watercooler){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($watercooler->image);
            $image = $request->image->store('watercoolers', 'public_disk');
        }
        $watercooler->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'Water Cooler info has been updated!');
    }
}
