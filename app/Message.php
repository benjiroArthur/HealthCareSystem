<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //fillables
    protected $fillable = [
        'from', 'to', 'chat'
    ];
    protected $with = ['fromContact'];

    public function fromContact(){
        return $this->hasOne(User::class, 'id', 'from');
    }
}
