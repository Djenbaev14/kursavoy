<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    
    public function loginPage(){
        return view('login');
    }
    public function authenticate(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            if(Auth::user()->role=='admin'){
                return redirect()->route('admin.home');
            }elseif(Auth::user()->role=='student'){
                return redirect()->route('student.home');
            }else{
                return redirect()->route('teacher.home');
            }
        }
  
        return 'no';
    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage');
    }

    
}
