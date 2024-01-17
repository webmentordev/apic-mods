<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(){
        return view('gallery.index', [
            'images' => Gallery::latest()->paginate(2)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,jfif'
        ]);
        Gallery::create([
            'image' => $request->image->store('builds', 'public_disk')
        ]);
        return back()->with('success', 'Build Image has been Added');
    }


    public function active(Gallery $gallery){
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();
        return back()->with('success', 'Build image status has been updated!');
    }

    public function delete(Gallery $gallery){
        Storage::disk('public_disk')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Build image has been deleted');
    }
}