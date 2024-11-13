<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FrontendController extends Controller
{
    public function index(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function profile(){
        return view('profile');
    }
}
