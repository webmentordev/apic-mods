<?php

namespace App\Http\Controllers;

use App\Models\BuildCategory;
use Illuminate\Http\Request;

class BuildCategoryController extends Controller
{
    public function index(){
        return view('category.index', [
            'categories' => BuildCategory::latest()->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string|max:255'
        ]);
        BuildCategory::create([
            'title' => $request->title,
            'detail' => $request->detail
        ]);
        return back()->with('success', 'Category has been Added');
    }

    public function active(BuildCategory $category){
        $category->is_active = !$category->is_active;
        $category->save();
        return back()->with('success', 'Category status has been updated!');
    }

    public function feature(BuildCategory $category){
        $category->is_featured = !$category->is_featured;
        $category->save();
        return back()->with('success', 'Category feature has been updated!');
    }

    public function delete(BuildCategory $category){
        $category->delete();
        return back()->with('success', 'Category has been deleted');
    }
}
