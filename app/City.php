<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //relationship
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
