<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Events\NewUser;
use App\Friend;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $role = Role::where('name', 'admin')->first();

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
     * @param \Illuminate\Http\Request $request
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

        $role = Role::where('name', 'admin')->first();
        $allAdmins = User::where('role_id', $role->id)->get();

        $admin = Admin::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'email' => $request->email,
        ]);
        $userrole = Role::where('name', $request->role)->first();
        $users = $admin->user()->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userrole->id
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

        broadcast(new NewUser($user))->toOthers();
        return response(['message' => 'User Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function show($id)
    {
        $admin = User::findOrFail($id)->userable()->first()->toArray();
        return response()->json($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\jsonResponse
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id)->userable()->first()->toArray();
        return response()->json($admin);
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
        //deactivate user
        $user = User::find($id);
        $user->active = 0;
        $user->save();
        return response('success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role->name === "admin"){
            if(auth()->user()->id != $id){
                $user = User::findOrFail($id);
                $user->userable()->delete();
                $user->delete();
                return response('success');
            }
            else{
                return response('Active User Cannot Be Deleted' );
            }
        }
        else{
            return response('Unauthorised Access' );
        }
    }
}
