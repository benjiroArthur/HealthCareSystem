<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\OutPatient;
use App\Pharmacy;
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


}
