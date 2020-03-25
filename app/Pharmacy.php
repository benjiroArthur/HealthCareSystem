<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    //fillables
    protected $fillable = [
        'pharmacy_name', 'phone_number', 'image', 'email', 'location', 'srn'
    ];

    protected $guarded = [];

    public function user(){
        return $this->morphOne('App\User', 'userable');
    }

    public function getImageAttribute($val){
        return asset('assets/ProfilePictures/'.$val);
    }

}
