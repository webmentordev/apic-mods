<?php

namespace App\Http\Controllers;

use App\Models\Socket;
use Illuminate\Http\Request;

class SocketController extends Controller
{
    public function index(){
        return view('pc.socket.index', [
            'sockets' => Socket::latest()->withCount(['motherboards', 'processors'])->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        Socket::create([
            'name' => $request->name
        ]);
        return back()->with('success', 'Socket has been Added');
    }

    public function delete(Socket $socket){
        $socket->delete();
        return back()->with('success', 'Socket has been deleted');
    }
}