<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DoctorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor');
    }
    public function login(Request $request){
        //Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log the user in
        if(Auth::guard('doctor')->attempt(['email' => $request->email, 'password'=> $request->password], $request->remember))
        {
            //if successful, then redirect to dashboard
            return redirect()->intended(route(''));
        }



        //if unsuccessful, the redirect back to login
        return true;
    }
}
