<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //fillable
    protected $fillable = ['user_id', 'friend_id'];
}
