<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image',
        'specialization_id', 'qualification', 'email', 'location', 'doctor_srn', 'full_name', 'srn'
    ];

    protected $with = ['specialization'];

    protected $guarded = [];

    public function user(){
        return $this->morphOne('App\User', 'userable');
    }

    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }

    public function medicalRecords(){
        return $this->hasMany('App\MedicalRecord');
    }

    public function specialization(){
        return $this->belongsTo('App\Specialization');
    }

    public function prescription(){
        return $this->hasMany('App\Prescription');
    }
}
