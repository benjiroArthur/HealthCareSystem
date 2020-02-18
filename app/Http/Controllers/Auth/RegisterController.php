<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\OpId;
use App\Role;
use App\User;
use App\Admin;
use App\Doctor;
use App\OutPatient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:out_patient',
            'password' => 'required|string|min:8|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
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
        $role = Role::where('name', 'out_patient')->first();
        $$out_patient->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_name' => $data['other_name'],
            'email' => $data['email'],
            'patient_id' => $patient_id
        ]);



        $role = Role::where('name', 'out_patient')->first();

        $out_patient1 = OutPatient::where('email', $data['email'])->first();
        //return $out_patient1;
       return $out_patient1->user()->create([
           'email' => $data['email'],
           'password'=> Hash::make($data['password']),
           'role_id'=> $role->id
        ]);


    }
}
