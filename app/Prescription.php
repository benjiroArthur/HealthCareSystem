<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    //fillables
    protected $fillable = ['prescription_code', 'doctor_id', 'out_patient_id'];

    protected $with = ['drugs', 'doctor', 'out_patient'];

    //relationships
    public function drugs()
    {
        return $this->hasMany('App\Drug');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function out_patient()
    {
        return $this->belongsTo('App\OutPatient');
    }
}
