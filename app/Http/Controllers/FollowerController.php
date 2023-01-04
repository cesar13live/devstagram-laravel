<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user,Request $request){
        $user->MyFollowers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user){
        $user->MyFollowers()->detach(auth()->user()->id);

        return back(); 
    }
}
