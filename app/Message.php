<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //fillables
    protected $fillable = [
        'from', 'to', 'chat'
    ];
}
