<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function loginForm(){
        return view("auth.login");
    }
    public function postLogin(Request $request){
        dd($request->all());
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('/');
    }
}
