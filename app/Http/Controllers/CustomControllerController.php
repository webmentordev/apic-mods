<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomController;

class CustomControllerController extends Controller
{
    public function index(){
        return view('pc.controller.index', [
            'controllers' => CustomController::latest()->paginate(50)
        ]);
    }

    public function create(){
        return view('pc.controller.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:custom_controllers,name',
            'price' => 'required|numeric'
        ]);
        CustomController::create([
            'name' => $request->name,
            'price' => $request->price
        ]);
        return back()->with('success', 'Custom Controller has been Added');
    }

    public function active(CustomController $controller){
        $controller->is_active = !$controller->is_active;
        $controller->save();
        return back()->with('success', 'Custom Controller status has been changed!');
    }

    public function delete(CustomController $controller){
        $controller->delete();
        return back()->with('success', 'Custom Controller has been deleted');
    }

    public function update(CustomController $controller){
        return view('pc.controller.update', [
            'cover' => $controller
        ]);
    }

    public function update_customcontroller(Request $request, CustomController $controller){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);
        $controller->update(array_filter([
            'name' => $request->name,
            'price' => $request->price
        ]));
        return back()->with('success', 'Custom Controller info has been updated!');
    }
}
