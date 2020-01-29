<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
//        if(Auth::check()){
//
//        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::guard('web')){return view('home');}
        else if(auth::guard('doctor')){return view('doctor-home');}
        else if(auth::guard('admin')){return view('admin-home');}

    }
}
