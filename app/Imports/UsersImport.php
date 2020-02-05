<?php

namespace App\Imports;

use App\Admin;
use App\Doctor;
use App\OutPatient;
use App\Pharmacy;
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
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if($row->filter()->isNotEmpty())
            {
                if(str::lower($row['role']) == 'admin'){
                    $admin = Admin::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                    ]);
                    $admin = Admin::where('email', $row['email'])->first();
                    $role = Role::where('name', 'admin')->first();
                    $roleId = $role->id;
                    $admin->user->create([
                        'email' => $admin->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }
                else if(str::lower($row['role']) == 'doctor'){
                    $doctor = Doctor::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                    ]);
                    $doctor = Doctor::where('email', $row['email'])->first();
                    $role = Role::where('name', 'doctor')->first();
                    $roleId = $role->id;
                    $doctor->user->create([
                        'email' => $doctor->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }

                else if(str::lower($row['role']) == 'pharmacy'){
                    $pharmacy = Pharmacy::create([
                        'pharmacy_name' => $row['pharmacy_name'],
                        'email' => $row['email'],
                    ]);
                    $pharmacy = Pharmacy::where('email', $row['email'])->first();
                    $role = Role::where('name', 'pharmacy')->first();
                    $roleId = $role->id;
                    $pharmacy->user->create([
                        'email' => $pharmacy->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }

                else if(str::lower($row['role']) == 'out_patient'){
                    $out_patient = OutPatient::create([
                        'last_name' => $row['last_name'],
                        'first_name' => $row['first_name'],
                        'other_name' => $row['other_name'],
                        'email' => $row['email'],
                    ]);
                    $out_patient = OutPatient::where('email', $row['email'])->first();
                    $role = Role::where('name', 'out_patient')->first();
                    $roleId = $role->id;
                    $out_patient->user->create([
                        'email' => $out_patient->email,
                        'password' => Hash::make($row['password']),
                        'role_id' => $roleId
                    ]);
                }

            }
        }
    }
}
