<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
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
        $users = User::latest('id')->get();
        return $users;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Excel::import(new UsersImport, $request->file('file'));
        return response('User Records Created Successfully', 200);
    }

    public function excelTemplate($value)
    {
        if($value == 'admin'){
            $filename = 'adminTemplate.xlsx';
        }
        elseif($value == 'doctor'){
            $filename = 'doctorTemplate.xlsx';
        }
        elseif($value == 'pharmacy'){
            $filename = 'pharmacyTemplate.xlsx';
        }
        else{
            $filename = 'outPatientTemplate.xlsx';
        }
        $file_path = public_path().'/assets/excelFiles/'.$filename;

        if(file_exists($file_path))
        {
            return response::download($file_path, $filename, ['Content-Length: '.filesize($file_path)]);
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
        //show details of a single user
        $diag = Role::all();
        $user = User::findOrFail($id);
        $result = array_merge($diag->toArray(), $user->toArray());
       return response()->json($result);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        //return the authenticated user
        return auth('api')->user();
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
        $updateUser = User::findOrFail($id)->first();

        //validation
        if($updateUser->role == 'admin'){

            $this->validate($request,[
                'last_name'=>'required|string|max:225',
                'first_name'=>'required|string|max:225',
                'email'=>'required|email|max:225',
                'gender'=>'required|string|max:225',
                'dob'=>'required|date|max:225',
                'phone_number'=>'required|string|max:225',
                'gender'=>'required|string|max:225',
            ]);
        }
        else if($updateUser->role == 'out_patient'){
            $this->validate($request,[
                'last_name'=>'required|string|max:225',
                'first_name'=>'required|string|max:225',
                'email'=>'required|email|max:225',
                'gender'=>'required|string|max:225',
                'dob'=>'required|date|max:225',
                'phone_number'=>'required|string|max:225',
                'gender'=>'required|string|max:225',
                'location'=>'required|string|max:225',
            ]);
        }
        else if($updateUser->role == 'doctor'){
            $this->validate($request,[
                'last_name'=>'required|string|max:225',
                'first_name'=>'required|string|max:225',
                'email'=>'required|email|max:225',
                'gender'=>'required|string|max:225',
                'dob'=>'required|date|max:225',
                'phone_number'=>'required|string|max:225',
                'gender'=>'required|string|max:225',
                'location'=>'required|string|max:225',
                'specialization'=>'required',
                'qualification'=>'required|string|max:225',
            ]);
        }
        else if($updateUser->role == 'pharmacy'){
            $this->validate($request,[
                'pharmacy_name'=>'required|string|max:225',
                'email'=>'required|email|max:225',
                'phone_number'=>'required|string|max:225',
                'location'=>'required|string|max:225',
            ]);
        }
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
