<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //fillables
    Protected $fillable = ['name'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
