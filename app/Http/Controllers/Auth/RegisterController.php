<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    private $userable_data;
    private $userable_type;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

//        return $data;


        if($data['role_id'] == 1){
            $out_patient = new OutPatient();
            $request = $data->except(['role_id', 'Password', 'password_confirmation']);
            $out_patient->create($request);

            $this->userable_data = OutPatient::where('email', $data['email']);
            $this->userable_type = "OutPatient";
        }
        elseif($data['role_id'] == 2){
            $doctor = new Doctor();
            $request = $data->except(['role_id', 'Password', 'password_confirmation']);
            $doctor->create($request);

            $this->userable_data = Doctor::where('email', $data['email']);
            $this->userable_type = "Doctor";
        }
        elseif($data['role_id'] == 3){
            $admin = new Admin();
            $request = $data->except(['role_id', 'Password', 'password_confirmation']);
            $admin->create($request);

            $this->userable_data = Admin::where('email', $data['email']);
            $this->userable_type = "Admin";
        }

        return User::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'other_name' => $data['other_name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'userable_id' => $this->userable_data->id,
            'userable_type' => $this->userable_type,
            'password' => Hash::make($data['password']),
        ]);
    }
}
