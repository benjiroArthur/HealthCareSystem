<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OutPatient extends Model
{
    protected $guarded = [];
    protected $appends = ['from_now', 'full_name', 'initials'];
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

    /**
     *
     */
    public function medical_records(){
        return $this->hasMany('App\MedicalRecord');
    }

    public function prescription(){
        return $this->hasMany('App\Prescription');
    }

    public function getFromNowAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    public function getFullNameAttribute(){
        if($this->other_name == null){
            return $this->first_name.' '.$this->last_name;
        }
        return $this->first_name.' '.$this->other_name.' '.$this->last_name;
    }
    public function getInitialsAttribute(){
        $firstInitial = strtoupper($this->first_name[0]);
        $lastInitial = strtoupper($this->last_name[0]);
        return $firstInitial.$lastInitial;
    }
}
