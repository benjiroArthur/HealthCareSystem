<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request, $id){

        $userable = User::find($id)->userable()->first();

        $userable->update($request->userData);

        $user = User::findOrFail($id);
        if($user->address === null){
            $user->address()->create($request->address);
        }
        else{
            $user->address()->update($request->address);
        }

        $user->update([
            'profile_updated' => 1
        ]);


        return response('success');
    }
}
