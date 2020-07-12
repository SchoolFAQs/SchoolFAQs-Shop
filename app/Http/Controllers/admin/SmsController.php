<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use DB;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\Message;
use App\User;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('superAdmin');
    }
    
    public function index()
    {
        //
        // Check SMS Balance
        $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);  
        $sms_data = $sms->balance('CMR');
        $partnerContracts = Arr::pull($sms_data, 'partnerContracts');
        //$partnerId = Arr::pull($partnerContracts, 'partnerId');
        $contracts = Arr::pull($partnerContracts, 'contracts');
        $o = Arr::pull($contracts, '0');
        $Servicecontracts = Arr::pull($o, 'serviceContracts');
        $o2 = Arr::pull($Servicecontracts, '0');



        //Send data to Blade
        $sms_units = Arr::pull($o2, 'availableUnits');
        $description = Arr::pull($o2, 'scDescription');
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        $message_count = Message::all()->count();
        $sms_expenditure = $message_count * config('app.sms_rate');

        //Admin SMS Usage
        $admin_usage_count = DB::table('messages')
             ->select('admin_id', DB::raw('count(*) as total'))
             ->groupBy('admin_id')
             ->get();

        return view('admin.superadmin.messages.message_index', compact('messages', 'sms_units','description', 'message_count', 'admin_usage_count', 'sms_expenditure'));
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
        $message = Message::find($id);
        return view('admin.superadmin.messages.message_show', compact('message'));
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
