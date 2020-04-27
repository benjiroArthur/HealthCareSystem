<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //fillables
    protected $fillable = [
        'from', 'to', 'chat'
    ];
    protected $appends = ['from_now'];
    protected $with = ['fromContact'];

    public function fromContact(){
        return $this->hasOne(User::class, 'id', 'from');
    }
    public function getFromNowAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
