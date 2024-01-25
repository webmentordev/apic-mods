<?php

namespace App\Http\Controllers;

use App\Models\Processor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProcessorController extends Controller
{
    public function index(){
        return view('pc.processor.index', [
            'processors' => Processor::latest()->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,webp,jpeg',
            'name' => 'required|string',
            'price' => 'required|numeric|min:1',
        ]);
        Processor::create([
            'image' => $request->image->store('processors', 'public_disk'),
            'name' => $request->name,
            'price' => $request->price,
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
            'processor' => $processor
        ]);
    }

    public function update_processor(Request $request, Processor $processor){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($processor->image);
            $image = $request->image->store('processors', 'public_disk');
        }
        $processor->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image
        ]));
        return back()->with('success', 'Processor info has been updated!');
    }
}