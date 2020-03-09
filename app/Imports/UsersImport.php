<?php

namespace App\Imports;

use App\Admin;
use App\DocId;
use App\Doctor;
use App\OpId;
use App\OutPatient;
use App\Pharmacy;
use App\PharmId;
use App\Role;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements WithHeadingRow, ToCollection, ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
        ]);
    }

     /**
    * @param  $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if($row->filter()->isNotEmpty())
            {
                if(str::lower($row['role']) === 'admin'){
                    $admin = Admin::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                        'full_name' => $row['full_name'],
                    ]);
//                    $admin = Admin::where('email', $row['email'])->first();
                    $role = Role::where('name', 'admin')->first();
                    $roleId = $role->id;
                    $admin->user->create([
                        'email' => $admin->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }
                else if(str::lower($row['role']) === 'doctor'){
                    $doctor_id = "";

                    $outid = DocId::latest()->first();
                    if($outid == null){
                        $val = 1;
                        $doc = new DocId;
                        $doc->doctor_id = $val;
                        $doc->save();
                    }
                    else{
                        $val = $outid->doctor_id + 1;
                        $doc = new DocId;
                        $doc->doctor_id = $val;
                        $doc->save();
                    }
                    if($val < 10){
                        $doctor_id = "hcdoc000".$val;
                    }
                    elseif($val > 9 && $val < 100){
                        $doctor_id = "hcdoc00".$val;
                    }
                    elseif($val > 99 && $val < 1000){
                        $doctor_id = "hcdoc0".$val;
                    }
                    elseif($val > 900){
                        $doctor_id = "hcdoc".$val;
                    }
                    $doctor = Doctor::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                        'full_name' => $row['full_name'],
                        'doctor_id' => $doctor_id
                    ]);
//                    $doctor = Doctor::where('email', $row['email'])->first();
                    $role = Role::where('name', 'doctor')->first();
                    $roleId = $role->id;
                    $doctor->user->create([
                        'email' => $doctor->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }

                else if(str::lower($row['role']) === 'pharmacy'){
                    $pharmacy_id = "";
                    $outid = PharmId::latest()->first();
                    if($outid == null){
                        $val = 1;
                        $ph = new PharmId;
                        $ph->pharmacy_id = $val;
                        $ph->save();
                    }
                    else{
                        $val = $outid->pharmacy_id + 1;
                        $ph = new PharmId;
                        $ph->pharmacy_id = $val;
                        $ph->save();
                    }
                    if($val < 10){
                        $pharmacy_id = "hcph000".$val;
                    }
                    elseif($val > 9 && $val < 100){
                        $pharmacy_id = "hcph00".$val;
                    }
                    elseif($val > 99 && $val < 1000){
                        $pharmacy_id = "hcph0".$val;
                    }
                    elseif($val > 900){
                        $pharmacy_id = "hcph".$val;
                    }
                    $pharmacy = Pharmacy::create([
                        'pharmacy_name' => $row['pharmacy_name'],
                        'email' => $row['email'],
                        'pharmacy_id' => $pharmacy_id
                    ]);
//                    $pharmacy = Pharmacy::where('email', $row['email'])->first();
                    $role = Role::where('name', 'pharmacy')->first();
                    $roleId = $role->id;
                    $pharmacy->user->create([
                        'email' => $pharmacy->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }

                else if(str::lower($row['role']) === 'out_patient'){
                    $patient_id = "";
                    $outid = OpId::latest()->first();
                    if($outid == null){
                        $val = 1;
                        $op = new OpId;
                        $op->out_patient_id = $val;
                        $op->save();
                    }
                    else{
                        $val = $outid->out_patient_id + 1;
                        $op = new OpId;
                        $op->out_patient_id = $val;
                        $op->save();
                    }
                    if($val < 10){
                        $patient_id = "hcpt000".$val;
                    }
                    elseif($val > 9 && $val < 100){
                        $patient_id = "hcpt00".$val;
                    }
                    elseif($val > 99 && $val < 1000){
                        $patient_id = "hcpt0".$val;
                    }
                    elseif($val > 900){
                        $patient_id = "hcpt".$val;
                    }
                    $out_patient = OutPatient::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                        'patient_id' => $patient_id
                    ]);
//                    $out_patient = OutPatient::where('email', $row['email'])->first();
                    $role = Role::where('name', 'out_patient')->first();
                    $roleId = $role->id;
                    $out_patient->user->create([
                        'email' => $out_patient->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }
                else{
                    
                }

            }
        }
    }
}
