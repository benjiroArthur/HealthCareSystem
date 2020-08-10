<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request, $id){

        $userable = User::find($id)->userable()->first();

        $userable->update($request->except('email'));


        return response('success');
    }


    public function address(Request $request, $id){
        $user = User::findOrFail($id);
        if($user->address === null){
            return $user->address()->create($request->all());
        }
        else{
            $user->address()->update($request->all());
        }

        $user->update([
            'profile_updated' => 1
        ]);


        return response('success');
    }
}
