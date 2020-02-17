<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    //fillable
    protected $fillable = ['prescription_id', 'name', 'dispensed'];

    //cast
    protected $casts = ['dispensed' => 'boolean'];

    //relationships
    public function prescription()
    {
        return $this->belongsTo('App\Prescription');
    }
}
