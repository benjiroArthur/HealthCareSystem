<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\OpId;
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

        $patient_id = "";
        $outid = OpId::latest()->first();
        if($outid == null){
            $val = 1;
            $op = new OpId;
            $op->out_patient_id = $val;
            $op->save();
        }
        else{
            $val = $outid->out_patient_id + 1;
            $op = new OpId;
            $op->out_patient_id = $val;
            $op->save();
        }
        if($val < 10){
            $patient_id = "hcpt000".$val;
        }
        elseif($val > 9 && $val < 100){
            $patient_id = "hcpt00".$val;
        }
        elseif($val > 99 && $val < 1000){
            $patient_id = "hcpt0".$val;
        }
        elseif($val > 900){
            $patient_id = "hcpt".$val;
        }
        $out_patient = new OutPatient;
        $data = $request->except('password', 'password_confirmation');
        $data['patient_id'] = $patient_id;
        $out_patient->create($data);



        $out_patient1 = OutPatient::where('email', $request->email)->first();
        //return $out_patient1;

        $out_patient1->user()->create(['email' => $request->email, 'password' => $request->password]);

        if(Auth::attempt(['email' => $request->email, 'password'=> $request->password]))
        {
            //if successful, then redirect to dashboard
            return redirect()->intended(url('/home'));
        }
        else{
            return redirect()->back();
        }

    }
}
