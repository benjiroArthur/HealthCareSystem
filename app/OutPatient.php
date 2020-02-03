<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutPatient extends Model
{
    protected $guarded = [];
    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image', 'email', 'location'
    ];

    public function getFullNameAttribute(){
        if($this->other_name === null){
            return ucfirst($this->first_name).' '.ucfirst($this->last_name);
        }
        return ucfirst($this->first_name).' '.ucfirst($this->other_name).' '.ucfirst($this->last_name);
    }

    public function user(){
        return $this->morphOne('App\User', 'userable');
    }
}
