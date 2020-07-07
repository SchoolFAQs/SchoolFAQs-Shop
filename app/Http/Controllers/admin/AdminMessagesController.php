<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mediumart\Orange\SMS\SMS;
use Redirect;
use Carbon\Carbon;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\Contact;
use App\Models\Message;

class AdminMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin_sms_count = Message::where('admin_id', Auth()->User()->id)->count();
        $message_count = Contact::all()->count();
        $messages = Contact::orderBy('is_solved', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contact.usermessages', compact('messages', 'message_count', 'admin_sms_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function send_message(Request $request)
    {
        //
        $this->validate($request, [
            'message' => 'required'
        ]);
        $customer_tel = $request->input('user_tel');
        $customer_ticket = $request->input('user_ticket').'_'.Auth()->User()->id;
        $message = $request->input('message');
        // Send SMS
        $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($customer_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message(''.$customer_ticket.' '.$message.'')
                        ->send();
        $smsaudit = new Message;
        $smsaudit->admin_id = Auth()->User()->id;
        $smsaudit->message_type = 'Custom Message';
        $smsaudit->message_purpose = 'Ticket Reply';
        $smsaudit->message = $message;
        $smsaudit->customer_name = $request->input('user_name');
        $smsaudit->customer_tel = $request->input('user_tel');
        $smsaudit->save();

        return Redirect::back()->with('success', 'Message Sent!');

    }

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
        //
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
        $message = Contact::find($id);
        return view('admin.contact.message_show', compact('message'));
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
        $message = Contact::find($id);
        $message->admin_name = $request->input('admin_name');
        $message->is_solved = 1;
        $message->solve_date = Carbon::now();
        $message->save();
        return Redirect(route('adminmessage.index'))->with('success', 'Solved!');
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
