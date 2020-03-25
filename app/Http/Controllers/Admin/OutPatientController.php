<?php

namespace App\Http\Controllers\Admin;

use App\Events\newUser;
use App\Http\Controllers\Controller;
use App\OpId;
use App\OutPatient;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OutPatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all patients
        $role = Role::where('name', 'out_patient')->first();

        $user = User::where('role_id', $role->id)->get();

        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'last_name' => 'string|required|max:255',
            'first_name' => 'string|required|max:255',
            'email' => 'email|required|max:255|unique:admins|unique:users',
            'password' => 'required|min:8'
        ]);


        if($request->other_name == null){
            $full_name = $request->first_name.' '.$request->last_name;
        }
        else{
            $full_name = $request->first_name.' '.$request->other_name.' '.$request->last_name;
        }
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
            $patient_id = "HC-PT-000".$val;
        }
        elseif($val > 9 && $val < 100){
            $patient_id = "HC-PT-00".$val;
        }
        elseif($val > 99 && $val < 1000){
            $patient_id = "HC-PT-0".$val;
        }
        elseif($val > 900){
            $patient_id = "HC-PT-".$val;
        }
        $patient = OutPatient::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'email' => $request->email,
            'full_name' => $full_name,
            'srn' => $patient_id
        ]);
        $role = Role::where('name', $request->role)->first();
        $user = $patient->user()->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id
        ]);

        broadcast(new newUser($user))->toOthers();
        return response(['message' => 'User Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
