<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
        ]);

        $user = User::find(auth()->id());

        $user->name = $request->name;
        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function updatePhone(Request $request) 
    {
        $request->validate([
            'phone' => 'required|digits_between:10,20',
        ]);

        $user = User::find(auth()->id());

        $user->phone_number = $request->phone;
        $user->save();

        return response()->json([
            'success' => true,
        ]);
    }
}
