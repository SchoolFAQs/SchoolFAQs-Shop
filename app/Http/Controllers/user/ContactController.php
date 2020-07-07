<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\Contact;
use App\Models\Message;

class ContactController extends Controller
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
        return view('users.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'user_name' => 'required',
            'user_tel' => 'required',
            'message' => 'required'
        ]);

        $message = new Contact;
        $message->ticket_id = '[CASE #TICKET_SFAQs'.time().']';
        $ticket = $message->ticket_id;
        $message->user_name = $request->input('user_name');
        $message->user_tel = '+237'.$request->input('user_tel');
        $message->message = $request->input('message');
         //Save Message
        $message->save();
        $ticket = $message->ticket_id;
        $message = $request->input('message');
        $user_name = $request->input('user_name');
        $tel = '+237'.$request->input('user_tel');
        // Send SMS
        $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message(''.$ticket.' Hello '. $user_name. '. Your message has been recieved. Our team will review your message and get back to you as sooon as possible through the phone number you gave us. Thank you for trusting our services. The SchoolFAQs Management Team.')
                        ->send();
        //Audit Message
        $smsaudit = new Message;
        $smsaudit->message_type = 'Auto';
        $smsaudit->message_purpose = 'Contact CS';
        $smsaudit->customer_name = $user_name;
        $smsaudit->customer_tel = $tel;
        $smsaudit->save();
        //Redirect Users
        return view('users.message_received', compact('ticket', 'message', 'user_name'))->with('success', 'Your message has been recieved.');
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
