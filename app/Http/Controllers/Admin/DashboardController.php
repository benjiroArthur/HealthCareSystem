<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\MedicalRecord;
use App\OutPatient;
use App\Pharmacy;
use App\Prescription;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOutPatient(){
        $patients = OutPatient::latest()->take(8)->get();
        return response()->json($patients);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctor(){
        $doctors = Doctor::latest()->take(8)->get();
        return response()->json($doctors);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPharmacy(){
        $pharmacy = Pharmacy::latest()->take(8)->get();
        return response()->json($pharmacy);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdmin(){
        $admins = Admin::latest()->take(8)->get();
        return response()->json($admins);
    }

    public function getStat(){
        $adminCount = Admin::all()->count();
        $patientCount = OutPatient::all()->count();
        $doctorCount = Doctor::all()->count();
        $pharmacyCount = Pharmacy::all()->count();
        $medRecordCount = MedicalRecord::all()->count();
        $pres = Prescription::all()->count();
        $users = User::all()->count();
        $online =

        $data = [
            'admin' => $adminCount,
            'patient' => $patientCount,
            'doctor' => $doctorCount,
            'pharmacy' => $pharmacyCount,
            'medRecord' => $medRecordCount,
            'prescription' => $pres,
            'users' => $users
        ];

        return response()->json($data);
    }


}
