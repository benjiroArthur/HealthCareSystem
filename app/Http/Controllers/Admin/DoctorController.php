<?php

namespace App\Http\Controllers\Admin;

use App\DocId;
use App\Doctor;
use App\Events\NewUser;
use App\Friend;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordNotification;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all doctors
        $role = Role::where('name', 'doctor')->first();

        $user = User::where('role_id', $role->id)->latest()->get();

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'last_name' => 'string|required|max:255',
            'first_name' => 'string|required|max:255',
            'email' => 'email|required|max:255|unique:admins|unique:users'
        ]);
        DB::beginTransaction();

        try {
            $adminRole = Role::where('name', 'admin')->first();
            $allAdmins = User::where('role_id', $adminRole->id)->get();

            $userPassword = str_random(16);

            $srn = "";

            $outid = DocId::latest()->first();
            if($outid == null){
                $val = 1;
                $doc = new DocId;
                $doc->doctor_id = $val;
                $doc->save();
            }
            else{
                $val = $outid->doctor_id + 1;
                $doc = new DocId;
                $doc->doctor_id = $val;
                $doc->save();
            }
            if($val < 10){
                $srn = "HC-DOC-000".$val;
            }
            elseif($val > 9 && $val < 100){
                $srn = "HC-DOC-00".$val;
            }
            elseif($val > 99 && $val < 1000){
                $srn = "HC-DOC-0".$val;
            }
            elseif($val > 900){
                $srn = "HC-DOC-".$val;
            }
            $doctor = Doctor::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'other_name' => $request->other_name,
                'email' => $request->email,
                'srn' => $srn
            ]);
            $role = Role::where('name', $request->role)->first();
            $users = $doctor->user()->create([
                'email' => $request->email,
                'password' => Hash::make($userPassword),
                'email_verified_at' => now(),
                'role_id' => $role->id
            ]);
            $user = User::findOrFail($users->id);
            foreach ($allAdmins as $singleAdmin){
                $data = [
                    'user_id' => $singleAdmin->id,
                    'friend_id' => $user->id,
                ];
                $friend = new Friend();
                $friend->create($data);
            }
            $userData = [
                'name' => 'Dr. '.$user->userable->full_name,
                'password' => $userPassword
            ];
            DB::commit();
            $user->notify(new PasswordNotification($userData));
            broadcast(new NewUser($user))->toOthers();
            return response('success');
        }catch (\Exception $e){
            DB::rollBack();
            return response($e);
        }
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
