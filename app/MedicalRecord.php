<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    //fillable
    protected $fillable = [
        'out_patient_id', 'doctor_id', 'diagnosis', 'heart_rate'
    ];

    protected $with = ['doctor', 'out_patient'];

    public function doctor(){
        return $this->belongsTo('App\Doctor');
    }
    public function out_patient(){
       return $this->belongsTo(OutPatient::class, 'out_patient_id');
    }


}
