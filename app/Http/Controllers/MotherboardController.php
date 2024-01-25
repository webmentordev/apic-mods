<?php

namespace App\Http\Controllers;

use App\Models\Motherboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotherboardController extends Controller
{
    public function index(){
        return view('pc.motherboard.index', [
            'motherboards' => Motherboard::latest()->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,webp,jpeg',
            'name' => 'required|string',
            'price' => 'required|numeric|min:1'
        ]);
        Motherboard::create([
            'image' => $request->image->store('motherboards', 'public_disk'),
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'Motherboard have been Added');
    }

    public function active(Motherboard $motherboard){
        $motherboard->is_active = !$motherboard->is_active;
        $motherboard->save();
        return back()->with('success', 'Motherboard status has been updated!');
    }

    public function delete(Motherboard $motherboard){
        Storage::disk('public_disk')->delete($motherboard->image);
        $motherboard->delete();
        return back()->with('success', 'Motherboard has been deleted');
    }

    public function update(Motherboard $motherboard){
        return view('pc.motherboard.update', [
            'motherboard' => $motherboard
        ]);
    }

    public function update_motherboard(Request $request, Motherboard $motherboard){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($motherboard->image);
            $image = $request->image->store('motherboards', 'public_disk');
        }
        $motherboard->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'Motherboard info has been updated!');
    }
}
