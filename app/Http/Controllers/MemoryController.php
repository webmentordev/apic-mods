<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\MemoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemoryController extends Controller
{
    public function index(){
        return view('pc.memory.index', [
            'memories' => Memory::latest()->paginate(50),
            'types' => MemoryType::latest()->get()
        ]);
    }

    public function create(){
        return view('pc.memory.create', [
            'types' => MemoryType::latest()->get()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:memories,name',
            'memory' => 'required|numeric',
            'price' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        Memory::create([
            'name' => $request->name,
            'memory_type_id' => $request->memory,
            'price' => $request->price,
            'image' => $request->image->store('rams', 'public_disk')
        ]);
        return back()->with('success', 'Memory has been Added');
    }

    public function active(Memory $memory){
        $memory->is_active = !$memory->is_active;
        $memory->save();
        return back()->with('success', 'Memory status has been updated');
    }

    public function delete(Memory $memory){
        $memory->delete();
        return back()->with('success', 'Memory has been deleted');
    }


    public function update(Memory $memory){
        return view('pc.memory.update', [
            'memory' => $memory,
            'types' => MemoryType::latest()->get()
        ]);
    }

    public function update_memory(Request $request, Memory $memory){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'memory' => 'required|numeric|min:1'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($memory->image);
            $image = $request->image->store('rams', 'public_disk');
        }
        $memory->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'memory_type_id' => $request->memory
        ]));
        return back()->with('success', 'Memory info has been updated!');
    }
}