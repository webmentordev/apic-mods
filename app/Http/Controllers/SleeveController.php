<?php

namespace App\Http\Controllers;

use App\Models\Sleeve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SleeveController extends Controller
{
    public function index(){
        return view('pc.sleeve.index', [
            'sleeves' => Sleeve::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.sleeve.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:sleeves,name',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            $image = $request->image->store('sleeves', 'public_disk');
        }
        Sleeve::create(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'Sleeve has been Added');
    }

    public function active(Sleeve $sleeve){
        $sleeve->is_active = !$sleeve->is_active;
        $sleeve->save();
        return back()->with('success', 'Sleeve status has been changed!');
    }

    public function delete(Sleeve $sleeve){
        $sleeve->delete();
        return back()->with('success', 'Sleeve has been deleted');
    }

    public function update(Sleeve $sleeve){
        return view('pc.sleeve.update', [
            'sleeve' => $sleeve
        ]);
    }

    public function update_watercooler(Request $request, Sleeve $sleeve){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);

        $image = null;
        if($request->remove){
            if($sleeve->image){
                Storage::disk('public_disk')->delete($sleeve->image);
                $sleeve->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'image' => $image
                ]);
                return back()->with('success', 'Sleeve info has been updated, image deleted!');
            }
        }
        if($request->hasFile('image')){
            if($sleeve->image){
                Storage::disk('public_disk')->delete($sleeve->image);
            }
            $image = $request->image->store('sleeves', 'public_disk');
        }
        $sleeve->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'Sleeve info has been updated!');
    }
}