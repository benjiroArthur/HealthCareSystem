<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MedicalRecord;
use App\OutPatient;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check user
        if(Auth::user()->role->name === 'admin'){
            $records = MedicalRecord::all();
            return response()->json($records);
        }
        else{
            $user = Auth::user()->userable()->first();
            $records = $user->medical_records()->latest()->get();
            return response()->json($records);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'srn' => 'required',
            'diagnosis' => 'required'
        ]);
        $srn = str_replace(' ', '', $request->srn);
        $srn = strtoupper($srn);
        $patient = OutPatient::where('srn', $srn)->first();
        if(!empty($patient)){
            $data = [
                'out_patient_id' => $patient->id,
                'doctor_id' => auth()->user()->userable->id,
                'diagnosis' => $request->diagnosis,
                'heart_rate' => $request->heart_rate
            ];
            $records = new MedicalRecord();
            $record = $records->create($data);
            return response()->json($record);
        }
        else{
            return response('error');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchMedicalRecords($srn){
        $srn = str_replace(' ', '', $srn);
        $srn = strtoupper($srn);
        $patient = OutPatient::where('srn', $srn)->first();
        if(!empty($patient)){
            $records = $patient->medicalRecords()->get();
            return response()->json($records);
        }
        else{
            return response('error');
        }

    }
}
