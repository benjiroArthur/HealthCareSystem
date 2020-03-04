<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image', 'email', 'full_name'
    ];

    protected $guarded = [];


    public function user(){
        return $this->morphOne('App\User', 'userable');
    }
    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }
}
