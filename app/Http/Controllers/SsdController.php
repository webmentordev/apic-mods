<?php

namespace App\Http\Controllers;

use App\Models\Ssd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SsdController extends Controller
{
    public function index(){
        return view('pc.ssd.index', [
            'ssds' => Ssd::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.ssd.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:ssds,name',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        Ssd::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image->store('ssds', 'public_disk')
        ]);
        return back()->with('success', 'SSD has been Added');
    }

    public function active(Ssd $ssd){
        $ssd->is_active = !$ssd->is_active;
        $ssd->save();
        return back()->with('success', 'SSD status has been changed!');
    }

    public function delete(Ssd $ssd){
        $ssd->delete();
        return back()->with('success', 'SSD has been deleted');
    }

    public function update(Ssd $ssd){
        return view('pc.ssd.update', [
            'ssd' => $ssd
        ]);
    }

    public function update_ssd(Request $request, Ssd $ssd){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($ssd->image);
            $image = $request->image->store('ssds', 'public_disk');
        }
        $ssd->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'SSD info has been updated!');
    }
}
