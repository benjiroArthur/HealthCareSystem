<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //

    public function getImageAttribute($val){
        return asset('assets/sliders/'.$val);
    }
}
