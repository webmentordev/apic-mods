<?php

namespace App\Http\Controllers;

use App\Models\AirCooler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AirCoolerController extends Controller
{
    public function index(){
        return view('pc.air_coolers.index', [
            'coolers' => AirCooler::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.air_coolers.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:air_coolers,name',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        AirCooler::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image->store('aircoolers', 'public_disk')
        ]);
        return back()->with('success', 'AIR COOLER has been Added');
    }

    public function active(AirCooler $aircooler){
        $aircooler->is_active = !$aircooler->is_active;
        $aircooler->save();
        return back()->with('success', 'AIR COOLER status has been changed!');
    }

    public function delete(AirCooler $aircooler){
        $aircooler->delete();
        return back()->with('success', 'AIR COOLER has been deleted');
    }

    public function update(AirCooler $aircooler){
        return view('pc.air_coolers.update', [
            'cooler' => $aircooler
        ]);
    }

    public function update_aircooler(Request $request, AirCooler $aircooler){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($aircooler->image);
            $image = $request->image->store('aircoolers', 'public_disk');
        }
        $aircooler->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'AIR COOLER info has been updated!');
    }
}
