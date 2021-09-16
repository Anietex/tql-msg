<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function show(){
        return response()->view('pages.auth.login');
    }

    public function login(LoginRequest $request) {

        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }else{
            return redirect('/login')->withInput()->with('message','Invalid email or password');
        }

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
