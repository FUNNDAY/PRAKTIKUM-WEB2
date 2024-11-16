<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $nama = 'ini tambahan dari controller : '.$nama;
        return view('admin.index');
    }
}
