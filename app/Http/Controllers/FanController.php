<?php

namespace App\Http\Controllers;

use App\Models\Fan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FanController extends Controller
{
    public function index(){
        return view('pc.fans.index', [
            'fans' => Fan::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.fans.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:fans,name',
            'price' => 'required|numeric'
        ]);
        Fan::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'Fan has been Added');
    }

    public function active(Fan $fan){
        $fan->is_active = !$fan->is_active;
        $fan->save();
        return back()->with('success', 'Fan status has been changed!');
    }

    public function delete(Fan $fan){
        $fan->delete();
        return back()->with('success', 'Fan has been deleted');
    }

    public function update(Fan $fan){
        return view('pc.fans.update', [
            'fan' => $fan
        ]);
    }

    public function update_fan(Request $request, Fan $fan){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);
        $fan->update(array_filter([
            'name' => $request->name,
            'price' => $request->price
        ]));
        return back()->with('success', 'Fan info has been updated!');
    }
}