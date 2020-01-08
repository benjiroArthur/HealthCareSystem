<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function login(){
        //Validate the form data

        //Attempt to log the user in

        //if successful, then redirect to dashboard

        //if unsuccessful, the redirect back to login
        return true;
    }
}
