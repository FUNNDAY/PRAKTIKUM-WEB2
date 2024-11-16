<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginStore(Request $request)
    {
        $credential = $request->only('username','password');
        if(Auth::attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }else{
            dd('user tidak ditemukan');    
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}         
