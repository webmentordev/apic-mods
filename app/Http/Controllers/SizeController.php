<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        return view('pc.size.index', [
            'sizes' => Size::latest()->withCount(['motherboards', 'cases'])->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'size' => 'required|string'
        ]);
        Size::create([
            'size' => $request->size
        ]);
        return back()->with('success', 'Component Size has been Added');
    }

    public function delete(Size $size){
        $size->delete();
        return back()->with('success', 'Component Size has been deleted');
    }
}