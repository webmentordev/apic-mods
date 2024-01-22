<?php

namespace App\Http\Controllers;

use App\Models\BuildCategory;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(){
        return view('gallery.index', [
            'images' => Gallery::latest()->with(['category'])->paginate(50),
            'categories' => BuildCategory::latest()->get()
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'images' => 'required|array',
            'category' => 'required|numeric',
        ]);
        
        $extensions = [ 'png', 'jpg', 'jpeg', 'webp', 'jfif'];
        
        foreach ($request->images as $item) {
            if(in_array($item->getClientOriginalExtension(), $extensions)){
                Gallery::create([
                    'image' => $item->store('builds', 'public_disk'),
                    'build_category_id' => $request->category,
                ]);
            }else{
                return back()->with('failed', "Build Image ".$item->getClientOriginalName()." should be png,jpg,webp,jfif");
            }
        }
        return back()->with('success', 'Build Images have been Added');
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