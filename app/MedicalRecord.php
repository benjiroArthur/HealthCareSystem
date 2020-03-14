<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    //fillable
    protected $fillable = [
        'patient_id', 'doctor_id', 'diagnosis', 'heart_rate', 'weight'
    ];

    public function doctor(){
        $this->belongsTo('App\Doctor');
    }
    public function out_patient(){
        $this->belongsTo('App\OutPatient');
    }

}
