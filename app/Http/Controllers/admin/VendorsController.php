<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use Spatie\Activitylog\Models\Activity;
use App\Models\Vendor;
use App\User;


class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $vendors = Vendor:: orderBy('created_at', 'desc')->paginate(5);
        return view('admin.vendors.vendor_list', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $user = User::find($id);
        return view('admin.vendors.vendor_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create Vendor
         $this->validate($request, [
            'vendor_name' => 'required',
            'vendor_tel' => 'required',
            'vendor_about' => 'required',
            'vendor_image' => 'required|file|image|max:1999'
        ]);

        $user = User::find($request->user_id);
        $vendor = new Vendor;
        $vendor->vendor_name = $request->input('vendor_name');

        if($request->hasFile('vendor_image')){
            //Get just extenstion
            $extension = $request->file('vendor_image')->getClientOriginalExtension();
            //File Name to store
            $fileVendorImageToStore = $vendor->vendor_image.'vendor_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('vendor_image')->storeAs('public/vendor_images', $fileVendorImageToStore);
        } else {
                $fileVendorImageToStore = 'noimage.jpg';
        }

       
        $vendor->vendor_about = $request->input('vendor_about');
        $vendor->vendor_tel = '+237'.$request->input('vendor_tel');
        $vendor->user_name = $user->name;
        $vendor->vendor_email = $user->email;
        $vendor->vendor_image = $fileVendorImageToStore;
        $vendor->admin_name = Auth()->User()->name;
        $vendor->save();

        $activity = Activity::all()->last();
        $activity->description; 
        $activity->subject; 
        $activity->changes;
        // Send SMS
        /*$client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($vendor->vendor_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $vendor->user_name. '. Congratulations, your shop, '. $vendor->vendor_name. ' has been created. Use this link to view it: ' . route('store.index', $vendor->id). '')
                        ->send();*/
       return redirect(route('uservendors.index'))->with('success', 'Vendor Created');

        
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
    public function edit($vendors)
    {
        //
        $vendor = Vendor::where('slug', $vendors)->first();
        return view('admin.vendors.vendor_edit', compact('vendor'));
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
        // Create Vendor
         $this->validate($request, [
            'vendor_name' => 'required',
            'vendor_tel' => 'required',
            'vendor_about' => 'required',
            'vendor_image' => 'sometimes|file|image|max:1999'
        ]);

        $vendor = Vendor::find($id);
        $vendor->vendor_name = $request->input('vendor_name');

        if($request->hasFile('vendor_image')){
            //Get just extenstion
            $extension = $request->file('vendor_image')->getClientOriginalExtension();
            //File Name to store
            $fileVendorImageToStore = 'vendor_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('vendor_image')->storeAs('public/vendor_images', $fileVendorImageToStore);
        } else {
                $fileVendorImageToStore = $vendor->vendor_image;
        }

        $vendor->vendor_about = $request->input('vendor_about');
        $vendor->vendor_tel = $request->input('vendor_tel');
        $vendor->user_name = $request->input('user_name');
        $vendor->vendor_email = $request->input('vendor_email');
        $vendor->vendor_image = $fileVendorImageToStore;
        $vendor->save();

        $activity = Activity::all()->last();
        $activity->description; //returns 'updated'
        $activity->subject; //

        // Send SMS
        /*$client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($vendor->vendor_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $vendor->user_name. '.Your shop, '. $vendor->vendor_name. ' has been updated as you requested. Use this link to view it: ' . route('store.index', $vendor->id). '')
                        ->send();*/
       //return redirect(route('vendors.index'))->with('success', 'Vendor Created');

        return redirect(route('uservendors.index'))->with('success', 'Vendor Updated');
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
        $vendor = Vendor::find($id);
        $vendor->delete();
        // Send SMS
       /* $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($vendor->vendor_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $vendor->user_name. '.Your shop, '. $vendor->vendor_name. ' has been deleted along with all the products as you requested. We are constantly working and hope to provide better services. Please let us know why you took this decision by filling a little anonymous form here: '. route('store.remove'). '')
                        ->send();*/
        return redirect(route('vendors.index'))->with('success', 'Vendor Deleted');
    }
}
