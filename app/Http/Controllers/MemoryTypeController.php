<?php

namespace App\Http\Controllers;

use App\Models\MemoryType;
use Illuminate\Http\Request;

class MemoryTypeController extends Controller
{
    public function index(){
        return view('pc.memory_type.index', [
            'memorytypes' => MemoryType::latest()->withCount(['memory', 'motherboards'])->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        MemoryType::create([
            'name' => $request->name
        ]);
        return back()->with('success', 'Memory Type has been Added');
    }

    public function delete(MemoryType $memory){
        $memory->delete();
        return back()->with('success', 'Memory Type has been deleted');
    }
}