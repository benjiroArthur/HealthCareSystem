<?php

namespace App\Http\Controllers;

use App\DailyTips;
use App\Events\NewDailyTips;
use Illuminate\Http\Request;

class DailyTipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all tips
        $tips = DailyTips::all();
        return response()->json($tips);
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
     * @return \Illuminate\Http\jsonResponse
     */
    public function store(Request $request)
    {
        //save tips
        $tip = new DailyTips();
        $tips = $tip->create($request->all());
        broadcast(new NewDailyTips($tips));
        return response()->json($tips);
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
        $data = $request->except('id');
        $tip = DailyTips::find($id);
        $tip->update($data);

        $tips = DailyTips::all();
        return response()->json($tips);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete tip
        $tip = DailyTips::findOrFail($id);
        $tip->delete();
        return response('success');
    }

    public function getLatest(){
        $tip = DailyTips::latest()->first();
        return response()->json($tip);
    }
}
