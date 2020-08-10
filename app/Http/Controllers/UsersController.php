<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
       if($request->hasFile('file')){
           $file = $request->file('file');
           Excel::import(new UsersImport, $file);
           return response('User Records Created Successfully', 200);
       }
       else{
           return response('No file available to upload');
       }
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
     * @throws \Illuminate\Validation\ValidationException
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

    public function uploadImage(Request $request){
        $user = Auth()->user()->userable;

        $oldImage = $user->image;
        $oldSplit = explode('/', $oldImage);
        $oldSplit = $oldSplit[count($oldSplit) -1];


        if($request->hasfile('image')){

            try {
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
                ]);
            } catch (ValidationException $e) {
                return response($e);
            }

            $image_file = $request->file('image');

            $imageNameWithExt = $image_file->getClientOriginalName();
            //Get just extension
            $extension = $image_file->getClientOriginalExtension();

            //Filename to store
            $imageNameToStore = time().'.'.$extension;

            //upload file

//      $path = $image_file->storeAs('public/assets/ProfilePictures/', $imageNameToStore);
//
            /*$image_path = public_path().'/assets/ProfilePictures/'.$imageNameToStore;
            //resize image
            Image::make($image_file->getRealPath())->resize(140,128)->save($image_path);*/

            //resize image
            $thumbImg = \Image::make($image_file->getRealPath())->resize(400,null,
                static function ($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
            $mainImg = \Image::make($image_file->getRealPath())->resize(800,null,
                static function ($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
            \Storage::disk('profile-picture')->put('thumbnails/'.$imageNameToStore, $thumbImg);
            \Storage::disk('profile-picture')->put('original/'.$imageNameToStore, $mainImg);

            if(\Storage::disk('profile-picture')->exists('/thumbnails/'.$oldSplit)){
                \Storage::disk('profile-picture')->delete('/thumbnails/'.$oldSplit);
            }
            if(\Storage::disk('profile-picture')->exists('/original/'.$oldSplit)){
                \Storage::disk('profile-picture')->delete('/original/'.$oldSplit);
            }

            $user->image = $imageNameToStore;
            $user->save();

            return response('Success');
        }

        return response('No file selected');
    }

    public function passwordUpdate(Request $request, $id){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::findOrFail($id);

        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response('success');
        }
        else{ return response('Password do not match');}
    }


    public function statusUpdate(Request $request, $id){
        $user = User::find($id);

        if($request->active == 'activate'){
            $user->update([
                'active' => 1
            ]);
            return response('User Activated Successfully');
        }
        else{
            $user->update([
                'active' => 0
            ]);
            return response('User Deactivated Successfully');
        }
    }

    public function onlineUsersCount(){
        $usersCount = User::where('online', 1)->get()->count();
        return response($usersCount);
    }
}
