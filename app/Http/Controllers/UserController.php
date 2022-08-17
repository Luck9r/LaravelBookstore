<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function modify(UserRequest $request)
    {
        $user = User::find($request->input('id'));

        if($request->input('action') == "block") {
            $user -> role = 2;
            $user -> save();
        } else if($request->input('action') == "unblock") {
            $user -> role = 0;
            $user -> save();
        } else if($request->input('action') == "remove") {
            $user ->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Users were modified.');
    }
}

