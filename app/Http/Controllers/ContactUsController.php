<?php

namespace App\Http\Controllers;

use App\Jobs\ContactUsJob;
use App\Mail\ContactUs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'email' => 'required|email',
            'message' => 'required',
            'full_name' => 'required'
        ]);
        $data = array(
            'email' => $request->email,
            'bodymessage' => $request->bodymessage,
            'full_name' => $request->full_name,
            'subject' => 'User Enquiries'
        );
//        Mail::send('emails.contact_us', $data, function($message) use($data){
//            $message->from($data['email']);
//            $message->to('majorcaios@gmail.com');
//            $message->subject($data['subject']);
//
//        });


//            $job = (new ContactUsJob($data))->delay(Carbon::now()->addSeconds(5));

            //ContactUsJob::dispatch($data)->delay(now()->addSeconds(5));

        return response('success');
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
}
