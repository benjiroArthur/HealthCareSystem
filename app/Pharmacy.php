<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    //fillables
    protected $fillable = [
        'pharmacy_name', 'phone_number', 'image', 'email', 'location', 'srn'
    ];

    protected $guarded = [];
    protected $appends = ['from_now', 'full_name', 'first_name'];

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

    public function getFullNameAttribute(){
        return $this->pharmacy_name;
    }

    public function getFirstNameAttribute(){
        $phName = $this->pharmacy_name;
        return true;
    }

}
