<?php

namespace App\Http\Controllers;

use App\Models\CustomLoop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomLoopController extends Controller
{
    public function index(){
        return view('pc.loops.index', [
            'loops' => CustomLoop::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.loops.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:custom_loops,name',
            'price' => 'required|numeric'
        ]);
        CustomLoop::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'CustomLoop has been Added');
    }

    public function active(CustomLoop $loop){
        $loop->is_active = !$loop->is_active;
        $loop->save();
        return back()->with('success', 'CustomLoop status has been changed!');
    }

    public function delete(CustomLoop $loop){
        $loop->delete();
        return back()->with('success', 'CustomLoop has been deleted');
    }

    public function update(CustomLoop $loop){
        return view('pc.loops.update', [
            'loop' => $loop
        ]);
    }

    public function update_customloop(Request $request, CustomLoop $loop){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);
        $loop->update(array_filter([
            'name' => $request->name,
            'price' => $request->price
        ]));
        return back()->with('success', 'CustomLoop info has been updated!');
    }
}