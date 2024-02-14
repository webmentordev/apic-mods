<?php

namespace App\Http\Controllers;

use App\Models\Socket;
use App\Models\Processor;
use App\Models\MemoryType;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessorController extends Controller
{
    public function index(){
        return view('pc.processor.index', [
            'processors' => Processor::latest()->with(['socket'])->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.processor.create', [
            'sockets' => Socket::latest()->get()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,webp,jpeg',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'socket' => 'required|numeric'
        ]);
        Processor::create([
            'image' => $request->image->store('processors', 'public_disk'),
            'name' => $request->name,
            'price' => $request->price,
            'socket_id' => $request->socket
        ]);
        return back()->with('success', 'Processor have been Added');
    }


    public function active(Processor $processor){
        $processor->is_active = !$processor->is_active;
        $processor->save();
        return back()->with('success', 'Processor status has been updated!');
    }

    public function delete(Processor $processor){
        Storage::disk('public_disk')->delete($processor->image);
        $processor->delete();
        return back()->with('success', 'Processor has been deleted');
    }

    public function update(Processor $processor){
        return view('pc.processor.update', [
            'processor' => $processor,
            'sockets' => Socket::latest()->get()
        ]);
    }

    public function update_processor(Request $request, Processor $processor){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'socket' => 'required|numeric',
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($processor->image);
            $image = $request->image->store('processors', 'public_disk');
        }
        $processor->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'socket_id' => $request->socket,
            'image' => $image
        ]));
        return back()->with('success', 'Processor info has been updated!');
    }
}