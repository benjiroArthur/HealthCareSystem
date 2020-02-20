<?php

namespace App\Http\Controllers;


use App\User;
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
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = \auth()->id();
        $user = User::find($userId);
       return view('home',compact('user'));

    }

    public function test(){


        $userId = \auth()->id();
        $user = User::find($userId);
//        return \auth()->user()->role();
        return $user->userable->last_name;
    }
}
