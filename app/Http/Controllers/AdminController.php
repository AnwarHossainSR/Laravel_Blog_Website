<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $check = $request->only('email', 'password');

       if (Auth::guard('admin')->attempt($check)) {
           return redirect()->route('admin.dashboard');
       }
       else
       {
          return back()->with('error','Please provide valid credientials');
       }
    }
    public function dashboard()
    {
        return view('admin.include.home');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form');
    }

}
