<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //fillables
    protected $fillable = ['region', 'city', 'gp_digital_address', 'user_id'];

    //return with


    //relationship

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
