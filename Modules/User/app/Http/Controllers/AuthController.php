<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('user_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:225',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
    }
}
