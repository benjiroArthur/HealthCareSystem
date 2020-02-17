<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //fillables
    protected $fillable = ['prescription_code', 'doctor_id', 'out_patient_id'];

    //relationships
    public function drugs()
    {
        return $this->hasMany('App\Drug');
    }
}
