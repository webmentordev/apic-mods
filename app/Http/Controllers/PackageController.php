<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        return view('package.index', [
            'packages' => Package::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('package.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);
        Package::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price
        ]);
        return back()->with('success', 'Package has been Added');
    }


    public function active(Package $package){
        $package->is_active = !$package->is_active;
        $package->save();
        return back()->with('success', 'Package status has been updated!');
    }

    public function delete(Package $package){
        $package->delete();
        return back()->with('success', 'Package has been deleted');
    }


    public function update(Package $package){
        return view('package.update', [
            'package' => $package
        ]);
    }

    public function update_package(Request $request, Package $package){
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);
        $package->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price
        ]);
        $package->save();
        return back()->with('success', 'Package has been updated!');
    }
}
