<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutPatient extends Model
{
    protected $guarded = [];
    //protected $table = 'out_patients';
    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image', 'email', 'location', 'srn', 'full_name'
    ];


    public function user(){
        return $this->morphOne('App\User', 'userable');
    }

    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }

    public function medical_record(){
        $this->hasMany('App\MedicalRecord');
    }

}
