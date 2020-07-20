<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\URL;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Message;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $od)
    {
        //
        $product = Product::find($id);
        $order = Order::find($od);
        $url = URL::temporarySignedRoute('order.download', now()->addHours(24), [
                'id' => $order->product_id, 
                'od' => $order->id 
            ]);
        //dd($product->product_name,$order);
        $vat = config('app.vat_rate');
        return view('users.successful_payment', compact('product', 'order', 'url', 'vat'));
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

    public function download($id, $od)
    {
        $product = Product::find($id);
        $order = Order::find($od);
        //Check if User downloaded the file already.
        if($order->is_downloaded == 1 ) {
            return view('users.already_downloaded', compact('order'));
        } else {
        $order->is_downloaded = 1;
        $order->downloaded_at = \Carbon\Carbon::now();
        $order->save();
        //$order = Order::find($od);
        $myFile = storage_path("app/public/products/{$product->product_file}"); 
        $headers = ['Content-Type: application/pdf'];
        $newName = 'SchoolFAQs_'.$product->id.'-'.$product->product_file;
        //dd($myFile);
        //$order->delete();
        return response()->download($myFile, $newName, $headers);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*//
         $this->validate($request, [
            'customer_name' => 'required',
            'customer_tel' => 'required|numeric|min:9',
            'product_price' => 'required',
            'product_name' => 'required'
        ]);

        $order = new Order;
        $order->product_name = $request->input('product_name');             
        $order->product_price = $request->input('product_price');
        $order->customer_name = $request->input('customer_name');
        $order->customer_tel = '+237'.$request->input('customer_tel');
        $order->product_id = $request->input('product_id');
        $order->vendor_email = $request->input('vendor_email');
        $order->save();
        $order->products()->attach($order->product_id);

        //send sms only if product is not free
        if($order->product_price != 0) {
            // Send SMS
        $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
       $url = URL::temporarySignedRoute('order.download', now()->addHours(24), [
                'id' => $order->product_id, 
                'od' => $order->id 
            ]);
        $sendSMS = $sms->to($order->customer_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $order->customer_name. '. Thank you for purchasing \''. $order->product_name. '\' from The SchoolFAQs Shop. We hope to serve you again soon. You can download your product using this link: '.$url)
                        ->send();
        //Audit Message
        $smsaudit = new Message;
        $smsaudit->message_type = 'Auto';
        $smsaudit->message_purpose = 'Product Sale';
        $smsaudit->customer_name = $order->customer_name;
        $smsaudit->customer_tel = $order->customer_tel;
        $smsaudit->save();
        // Return Download Link
         $urli = URL::temporarySignedRoute('index.download', now()->addHours(24), [
                'id' => $order->product_id, 
                'od' => $order->id 
            ]);
         return redirect($urli)->with('success', 'Order Created');
         
        } else {
             $urli = URL::temporarySignedRoute('index.download', now()->addHours(24), [
                'id' => $order->product_id, 
                'od' => $order->id 
            ]);
             return redirect($urli)->with('success', 'Order Created');
        }
       */
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
