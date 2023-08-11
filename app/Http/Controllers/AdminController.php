<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginAdmin(){
        // dd(bcrypt(12345678));
        if(auth()->check())
        {
            return redirect()->to('home');
        }
        return view('login');
    }
    public function postLoginAdmin(Request $request){
        // dd($request->has('remember-me'));
        $credentials =  $request->only('email', 'password');
        // dd($credentials);
        $remember = $request->has('remember-me') ? true : false;
        if(auth()->attempt($credentials,$remember)){
            return redirect()->to('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logOutAdmin(){
        auth()->logout();
        return redirect()->route('login');
    }
}
