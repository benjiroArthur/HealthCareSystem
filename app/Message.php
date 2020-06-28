<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FromNow;


class Message extends Model
{
    use FromNow;
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
        return $this->getAwesomeDateAttribute();
    }
}
