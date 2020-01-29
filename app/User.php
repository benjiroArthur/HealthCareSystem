<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function out_patient(){
        //dd($this->role());
        return $this->belongs('App\OutPatient');
//        if($this->role()->name == 'doctor'){
//            return $this->hasOne('App\Doctor', 'user_id');
//        }
//        else if($this->role()->name == 'admin'){
//            return $this->hasOne('App\Admin', 'user_id');
//        }
//        else if($this->role()->name == 'out_patient'){
//            return $this->hasOne('App\OutPatient', 'user_id');
//        }


    }
}





