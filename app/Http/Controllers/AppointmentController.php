<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get appointment details
        if(auth()->user()->role->name == 'admin'){
            $appointment = Appointment::all();
        }
        elseif (auth()->user()->role->name == 'out_patient'){
            $appointment = Appointment::where('user_id', auth()->user()->id)->get();
        }
        elseif (auth()->user()->role->name == 'doctor'){
            $appointment = Appointment::where('doctor_id', auth()->user()->id)->get();
        }
        else
        {
            return response('Unauthorised Access', 401);
        }
        return response($appointment);
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
        //store appointment info
        $appointment = new Appointment();
        $appointment->create($request->all());
        return response('Appointment Booked Successfully', 200);
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
        //update info
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response('Appointment Records Updated Successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete appointment
        $appointment = Appointment::findOrFail($id);
        if(auth()->user()->role->name == 'admin' || $appointment->user_id == auth()->user()->id){
            $appointment->delete();
            return response('Appointment Deleted Successfully', 200);
        }
        else{
            return response('Access Denied', 401);
        }
    }
}
