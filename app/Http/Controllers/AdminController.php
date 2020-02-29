<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Events\newUser;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::where('name', 'admin')->first();

        $user = User::where('role_id', $role->id)->get();

        return response($user);
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

//        return response($request->all());
            if($request->other_name == null){
                $full_name = $request->first_name.' '.$request->last_name;
            }
            else{
                $full_name = $request->first_name.' '.$request->other_name.' '.$request->last_name;
            }
        $admin = Admin::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'other_name' => $request->other_name,
            'email' => $request->email,
            'full_name' => $full_name
        ]);
        $role = Role::where('name', $request->role)->first();
       $user = $admin->user()->create([
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
        return response('No');
//        if(auth()->user()->role->name === "admin"){
//            if(auth()->user()->id != $id){
//                $user = User::findOrFail($id);
//                $user->userable()->delete();
//                $user->delete();
//                    return response('success');
//            }
//            else{
//                return response('Active User Cannot Be Deleted' );
//            }
//        }
//        else{
//            return response('Unauthorised Access' );
//        }
    }

}
