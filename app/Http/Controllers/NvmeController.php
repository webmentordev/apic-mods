<?php

namespace App\Http\Controllers;

use App\Models\Nvme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NvmeController extends Controller
{
    public function index(){
        return view('pc.nvme.index', [
            'nvmes' => Nvme::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.nvme.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:nvmes,name',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        Nvme::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image->store('nvmes', 'public_disk')
        ]);
        return back()->with('success', 'NVME has been Added');
    }

    public function active(Nvme $nvme){
        $nvme->is_active = !$nvme->is_active;
        $nvme->save();
        return back()->with('success', 'NVME status has been changed!');
    }

    public function delete(Nvme $nvme){
        $nvme->delete();
        return back()->with('success', 'NVME has been deleted');
    }

    public function update(Nvme $nvme){
        return view('pc.nvme.update', [
            'nvme' => $nvme
        ]);
    }

    public function update_nvme(Request $request, Nvme $nvme){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($nvme->image);
            $image = $request->image->store('nvmes', 'public_disk');
        }
        $nvme->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'NVME info has been updated!');
    }
}