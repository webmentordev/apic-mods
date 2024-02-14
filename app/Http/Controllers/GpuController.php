<?php

namespace App\Http\Controllers;

use App\Models\Gpu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GpuController extends Controller
{
    public function index(){
        return view('pc.gpu.index', [
            'gpus' => Gpu::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.gpu.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:gpus,name',
            'price' => 'required|numeric|min:1',
            'power' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        GPU::create([
            'name' => $request->name,
            'price' => $request->price,
            'power' => $request->power,
            'image' => $request->image->store('gpus', 'public_disk')
        ]);
        return back()->with('success', 'GPU has been Added');
    }

    public function active(Gpu $gpu){
        $gpu->is_active = !$gpu->is_active;
        $gpu->save();
        return back()->with('success', 'GPU status has been changed!');
    }

    public function delete(Gpu $gpu){
        $gpu->delete();
        return back()->with('success', 'GPU has been deleted');
    }

    public function update(Gpu $gpu){
        return view('pc.gpu.update', [
            'gpu' => $gpu
        ]);
    }

    public function update_gpu(Request $request, Gpu $gpu){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'power' => 'required|numeric'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($gpu->image);
            $image = $request->image->store('gpus', 'public_disk');
        }
        $gpu->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'power' => $request->power,
            'image' => $image
        ]));
        return back()->with('success', 'GPU info has been updated!');
    }
}