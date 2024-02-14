<?php

namespace App\Http\Controllers;

use App\Models\Psu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PsuController extends Controller
{
    public function index(){
        return view('pc.psu.index', [
            'psus' => Psu::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.psu.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:psus,name',
            'price' => 'required|numeric',
            'power' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        Psu::create([
            'name' => $request->name,
            'price' => $request->price,
            'power' => $request->power,
            'image' => $request->image->store('psus', 'public_disk')
        ]);
        return back()->with('success', 'PSU has been Added');
    }

    public function active(Psu $psu){
        $psu->is_active = !$psu->is_active;
        $psu->save();
        return back()->with('success', 'PSU status has been changed!');
    }

    public function delete(Psu $psu){
        $psu->delete();
        return back()->with('success', 'PSU has been deleted');
    }

    public function update(Psu $psu){
        return view('pc.psu.update', [
            'psu' => $psu
        ]);
    }

    public function update_psu(Request $request, Psu $psu){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'power' => 'required|numeric'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($psu->image);
            $image = $request->image->store('psus', 'public_disk');
        }
        $psu->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'power' => $request->power,
            'image' => $image
        ]));
        return back()->with('success', 'PSU info has been updated!');
    }
}
