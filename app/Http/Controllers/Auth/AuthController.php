<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    /*
    */
    public function index(){
        if(Auth::user()){

        }
        return view('auth.login');
    } 
}