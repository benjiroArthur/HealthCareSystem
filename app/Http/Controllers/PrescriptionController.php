<?php

namespace App\Http\Controllers;

use App\Drug;
use App\OutPatient;
use App\PreCode;
use App\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $srn = $request->srn;
        $srn = str_replace(' ', '', $srn);
        $srn = strtoupper($srn);
        $patient = OutPatient::where('srn', $srn)->first();

        if(!empty($patient)){
            $prescription_code = '';
            $pre_code = PreCode::latest()->first();

            if($pre_code == null){
                $val = 1;
                $newCode = new PreCode();
                $newCode->create([
                    'code' => $val
                ]);
            }
            else{
                $val = $pre_code->code + 1;
                $newCode = new PreCode();
                $newCode->create([
                    'code' => $val
                ]);
            }
            if($val < 10){
                $prescription_code = 'HC-PRES-0000'.$val;
            }
            elseif($val > 9 && $val < 100){
                $prescription_code = 'HC-PRES-000'.$val;
            }
            elseif($val > 99 && $val < 1000){
                $prescription_code = 'HC-PRES-00'.$val;
            }
            elseif($val > 900 && $val < 10000){
                $prescription_code = 'HC-PRES-0'.$val;
            }
            else{
                $prescription_code = 'HC-PRES-'.$val;
            }

            $prescription = $patient->prescription()->create([
                'prescription_code' => $prescription_code,
                'doctor_id' => auth()->user()->userable->id,
            ]);

            $drugs = $request->drugs;
            foreach ($drugs as $drug){
                $prescription->drugs()->create([
                    'name' => $drug
                ]);
            }

            return response()->json($prescription);
        }
        else{
            return response('error');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  string  $p_code
     * @return \Illuminate\Http\Response
     */
    public function show($p_code)
    {
        $p_code = str_replace(' ', '', $p_code);
        $p_code = strtoupper($p_code);
        $pres = Prescription::where('prescription_code', $p_code)->first();
        $pres1 = Prescription::where('prescription_code', $p_code)->get();

        //$drugs = Drug::where('prescription_id', $pres->id)->get();
        $drugs = $pres->drugs()->get();
        $data = [
            'prescription' => $pres1,
            'drugs' => $drugs,
        ];
        return response($data);
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
}
