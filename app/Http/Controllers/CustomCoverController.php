<?php

namespace App\Http\Controllers;

use App\Models\CustomCover;
use Illuminate\Http\Request;

class CustomCoverController extends Controller
{
    public function index(){
        return view('pc.cover.index', [
            'covers' => CustomCover::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.cover.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:custom_covers,name',
            'price' => 'required|numeric|min:1'
        ]);
        CustomCover::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'CustomCover has been Added');
    }

    public function active(CustomCover $cover){
        $cover->is_active = !$cover->is_active;
        $cover->save();
        return back()->with('success', 'CustomCover status has been changed!');
    }

    public function delete(CustomCover $cover){
        $cover->delete();
        return back()->with('success', 'CustomCover has been deleted');
    }

    public function update(CustomCover $cover){
        return view('pc.cover.update', [
            'cover' => $cover
        ]);
    }

    public function update_customcover(Request $request, CustomCover $cover){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255'
        ]);
        $cover->update(array_filter([
            'name' => $request->name,
            'price' => $request->price
        ]));
        return back()->with('success', 'CustomCover info has been updated!');
    }
}
