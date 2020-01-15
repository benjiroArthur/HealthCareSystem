<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except'=>['logout']]);
    }

    public function login(Request $request){
        //Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'=> $request->password], $request->remember))
        {
            //if successful, then redirect to dashboard
            return redirect()->intended(route('admin-home'));
        }

        //if unsuccessful, the redirect back to login
        return redirect()->back()->with('error','Invalid Username or Password');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
