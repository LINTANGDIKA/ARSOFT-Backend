<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function viewLogin()
    {
        return view('Login', [
            'title' => 'Login Page'
        ]);
    }
    public function loginSistem(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                Auth::login($user);
                return redirect()->route('home');
            } else {
                return redirect()->route('login')->with('error', 'Password Salah');
            }
        }
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('login')->with('success', 'Berhasil Register, Silahkan Login');
    }
    public function  logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
