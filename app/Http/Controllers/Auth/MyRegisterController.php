<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\OutPatient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyRegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    public function userRegister(Request $request){

        $this->validate($request, [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $out_patient = new OutPatient;
        $data = $request->except('password', 'password_confirmation');
        $out_patient->create($data);



        $out_patient1 = OutPatient::where('email', $request->email)->first();
        //return $out_patient1;

        $out_patient1->user()->create(['email' => $request->email, 'password' => Hash::make($request->password)]);

        if(Auth::guard()->attempt(['email' => $request->email, 'password'=> $request->password], $request->remember))
        {
            //if successful, then redirect to dashboard
            return redirect()->intended(url('/home'));
        }
        else{
            return redirect()->back();
        }

    }
}
