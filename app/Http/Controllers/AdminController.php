<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Events\newUser;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $admin = User::findOrFail($id)->userable()->get();

        return response($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id)->userable()->first();
        return response($admin);
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


    }
    public function profile(){
        $user = User::findOrFail(auth()->user()->id)->userable()->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request){

        $user = User::findOrFail(auth()->user()->id)->userable()->first();

        $user->update($request->all());
        return response($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request){
        try {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:225'
            ]);
        } catch (ValidationException $e) {
            return $e;
        }
        $image_file = $request->image;

        $imageNameWithExt = $image_file->getClientOriginalName();
        //Get just extension
        $extension = $image_file->getClientOriginalExtension();

        //Filename to store
        $imageNameToStore = time().'.'.$extension;

        //upload file

        $path = $image_file->storeAs('public/assets/ProfilePictures/', $imageNameToStore);

        $image_path = public_path().'/assets/ProfilePictures/'.$imageNameToStore;
        //resize image
        Image::make($image_file->getRealPath())->resize(140,128)->save($image_path);

        $id = Auth()->user()->userable->id;
        $user = Admin::findOrFail($id);
        $user->image = $imageNameToStore;
        $user->save();

        return response($imageNameToStore);
    }

}
