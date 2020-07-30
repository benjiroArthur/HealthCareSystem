<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id', 'userable_id', 'userable_type', 'profile_updated',
        'email_verified_at', 'active', 'online'
    ];

    protected $guarded = [];

    protected $with = ['role', 'userable', 'address'];

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
        'active' => 'boolean',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function address(){
        return $this->hasOne(Address::class);
    }


    public function userable(){
        return $this->morphTo();
    }

    public function friendsOfMine(){
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }
    public function friendOf(){
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){
        return $this->friendsOfMine->merge($this->friendOf);
    }


}





