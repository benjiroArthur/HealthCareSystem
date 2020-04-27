<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    //fillables
    protected $fillable = [
        'first_name', 'last_name', 'other_name', 'dob', 'gender', 'phone_number', 'image', 'email', 'full_name'
    ];

    protected $guarded = [];
    protected $appends = ['from_now'];



    public function user(){
        return $this->morphOne('App\User', 'userable');
    }
    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }
    public function getCreatedAtAttribute($val){
        return Carbon::parse($val)->isoFormat('Do MMMM, YYYY');
    }
    public function getFromNowAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
