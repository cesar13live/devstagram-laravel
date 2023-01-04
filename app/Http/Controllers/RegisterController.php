<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // validation

        //reescribir request

        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request, [
            'name' => 'required | max:30 | min:10',
            'username' => 'required | max:20 | min:5 | unique:users',
            'email' => 'required | min:10 | email | unique:users',
            'password' => 'required | min:10 | confirmed',
        ]);

        User::create([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //autenticar el usuario

        auth()->attempt([
            'email' =>$request->email,
            'password' =>$request->password,
        ]);

        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
