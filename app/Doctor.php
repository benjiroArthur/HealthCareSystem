<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image',
        'specialization', 'qualification', 'email', 'location', 'doctor_id', 'full_name'
    ];

    protected $guarded = [];

    public function user(){
        return $this->morphOne('App\User', 'userable');
    }

    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }
}
