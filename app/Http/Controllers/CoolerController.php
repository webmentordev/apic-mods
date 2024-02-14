<?php

namespace App\Http\Controllers;

use App\Models\Cooler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoolerController extends Controller
{
    public function index(){
        return view('pc.coolers.index', [
            'coolers' => Cooler::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.coolers.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:coolers,name',
            'price' => 'required|numeric|min:1',
            'type' => 'required|string|max:255',
            'aio' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        Cooler::create([
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'aio_type' => $request->aio,
            'image' => $request->image->store('coolers', 'public_disk')
        ]);
        return back()->with('success', 'Cooler has been Added');
    }

    public function active(Cooler $cooler){
        $cooler->is_active = !$cooler->is_active;
        $cooler->save();
        return back()->with('success', 'Cooler status has been changed!');
    }

    public function delete(Cooler $cooler){
        $cooler->delete();
        return back()->with('success', 'Cooler has been deleted');
    }

    public function update(Cooler $cooler){
        return view('pc.coolers.update', [
            'cooler' => $cooler
        ]);
    }

    public function update_cooler(Request $request, Cooler $cooler){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
            'aio' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($cooler->image);
            $image = $request->image->store('coolers', 'public_disk');
        }
        $cooler->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'type' => $request->type,
            'image' => $image
        ]));
        if($request->aio == null){
            $cooler->update([
                'aio_type' => null,
            ]);
        }else{
            $cooler->update([
                'aio_type' => $request->aio,
            ]);
        }
        return back()->with('success', 'Cooler info has been updated!');
    }
}