<?php

namespace App\Http\Controllers;

use App\Models\PcCase;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PcCaseController extends Controller
{
    public function index(){
        return view('pc.cases.index', [
            'cases' => PcCase::latest()->with('size')->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.cases.create',[
            'sizes' => Size::latest()->get()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:pc_cases,name',
            'price' => 'required|numeric|min:1',
            'size' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:png,jpg,webp,jpeg'
        ]);
        PcCase::create([
            'name' => $request->name,
            'size_id' => $request->size,
            'price' => $request->price,
            'image' => $request->image->store('cases', 'public_disk')
        ]);
        return back()->with('success', 'CASE has been Added');
    }

    public function active(PcCase $pccase){
        $pccase->is_active = !$pccase->is_active;
        $pccase->save();
        return back()->with('success', 'CASE status has been changed!');
    }

    public function delete(PcCase $pccase){
        $pccase->delete();
        return back()->with('success', 'CASE has been deleted');
    }

    public function update(PcCase $pccase){
        return view('pc.cases.update', [
            'case' => $pccase,
            'sizes' => Size::latest()->get()
        ]);
    }

    public function update_case(Request $request, PcCase $pccase){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg',
            'size' => 'required|numeric'
        ]);
        $image = null;
        if($request->hasFile('image')){
            Storage::disk('public_disk')->delete($pccase->image);
            $image = $request->image->store('cases', 'public_disk');
        }
        $pccase->update(array_filter([
            'name' => $request->name,
            'price' => $request->price,
            'size_id' => $request->size,
            'image' => $image
        ]));
        return back()->with('success', 'CASE info has been updated!');
    }
}