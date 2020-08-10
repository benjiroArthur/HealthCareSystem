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
    protected $appends = ['from_now', 'full_name', 'initials', 'image_source'];



    public function user(){
        return $this->morphOne('App\User', 'userable');
    }
    public function getImageAttribute($val){
        return asset('storage/images/ProfilePictures/thumbnails/'.$val);
    }
    public function getImageSourceAttribute(){
        return asset('storage/images/ProfilePictures/original/'.$this->image);
    }
    public function getCreatedAtAttribute($val){
        return Carbon::parse($val)->isoFormat('Do MMMM, YYYY');
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
