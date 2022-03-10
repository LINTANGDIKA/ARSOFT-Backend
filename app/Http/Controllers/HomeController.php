<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return view('User', [
                'title' => 'Home Page',
                'email' => Auth::user()->email
            ]);
        } else {
            return redirect()->route('login');
        }
    }
}
