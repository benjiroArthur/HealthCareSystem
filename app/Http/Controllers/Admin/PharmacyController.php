<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewUser;
use App\Http\Controllers\Controller;
use App\Pharmacy;
use App\PharmId;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
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
        $role = Role::where('name', 'pharmacy')->first();

        $users = User::where('role_id', $role->id)->get();

        return response()->json($users);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'pharmacy_name' => 'string|required|max:255',
            'email' => 'email|required|max:255|unique:admins|unique:users',
            'password' => 'required|min:8'
        ]);

        $pharmacy_srn = "";
        $outid = PharmId::latest()->first();
        if($outid == null){
            $val = 1;
            $ph = new PharmId;
            $ph->pharmacy_id = $val;
            $ph->save();
        }
        else{
            $val = $outid->pharmacy_id + 1;
            $ph = new PharmId;
            $ph->pharmacy_id = $val;
            $ph->save();
        }
        if($val < 10){
            $pharmacy_srn = "HC-PH-000".$val;
        }
        elseif($val > 9 && $val < 100){
            $pharmacy_srn = "HC-PH-00".$val;
        }
        elseif($val > 99 && $val < 1000){
            $pharmacy_srn = "HC-PH-0".$val;
        }
        elseif($val > 900){
            $pharmacy_srn = "HC-PH-".$val;
        }


        $pharmacy = Pharmacy::create([
            'pharmacy_name' => $request->pharmacy_name,
            'email' => $request->email,
            'srn' => $pharmacy_srn

        ]);
        $role = Role::where('name', $request->role)->first();
        $users = $pharmacy->user()->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id
        ]);
        $user = User::findOrFail($users->id);
        broadcast(new NewUser($user));
        return response()->json($user);
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
