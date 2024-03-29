<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use Bmatovu\MtnMomo\Products\Collection;
use Illuminate\Support\Facades\URL;
use App\Models\Order;
use App\Models\Message;
use App\Models\Withdraw;
use App\Models\Vendor;
use App\User;

class PaymentsController extends Controller
{
    //

    /**
     * Send request for payment.
     *
     * @param  string $product_id
     * @return \Illuminate\Http\Response
     */
    public function requesttopay (Request $request) {
    	//Validate Request
    	$this->validate($request, [
            'customer_name' => 'required',
            'customer_tel' => 'required|numeric|min:9',
            'product_price' => 'required',
            'product_name' => 'required'
        ]);
        //Check product Price
        if($request->product_price != 0) {
    	// Request Payment
        $transactId = time().$request->input('product_id');
        $product_name = $request->input('product_name');             
		$product_price = $request->input('product_price');
		$customer_tel = '237'.$request->input('customer_tel');
        //$customer_tel = $request->input('customer_tel');

    	$collection = new Collection();
		$momoTransactionId = $collection->requestToPay($transactId, $customer_tel, $product_price, 'SchoolFAQs Product', 'Payment for '.$product_name);
		//Save Transaction
			$order = new Order;             
	        $order->customer_name = $request->input('customer_name');
	        $order->customer_tel = '+237'.$request->input('customer_tel');
	        $order->product_id = $request->input('product_id');
            $order->product_price = $request->input('product_price');
	        $order->vendor_email = $request->input('vendor_email');
	        $order->product_type = 'PAID';
	        $order->transact_id = $transactId;
	        $order->transaction_id = $momoTransactionId;
	        $order->save();
	        $order->products()->attach($order->product_id);
		return redirect(route('client.payment', ['transactionID' => $momoTransactionId]));
            //return view('users.verifyPayment', compact('momoTransactionId'));

		} else // Download Free Product
			{
				$order = new Order;            
		        $order->customer_name = $request->input('customer_name');
		        $order->customer_tel = '+237'.$request->input('customer_tel');
		        $order->product_id = $request->input('product_id');
                $order->product_price = $request->input('product_price');
		        $order->vendor_email = $request->input('vendor_email');
		        $order->product_type = 'FREE';
                $order->payment_status = 'FREE';
		        $order->save();
		        $order->products()->attach($order->product_id);
				$urli = URL::temporarySignedRoute('index.download', now()->addHours(24), [
	                'id' => $order->product_id, 
	                'od' => $order->id 
	            ]);
	             return redirect($urli)->with('success', 'Success');
			}
    }


	/**
     * Check if payment was received.
     *
     * @param  string $transact_id
     * @return \Illuminate\Http\Response
     */
    public function checkpayment (Request $transactionID) {
        //dd($transactionID);
    	$collection = new Collection();
        $transaction  = $collection->getTransactionStatus($transactionID->transactionID);
        //dd($transaction);
        $success = false;
        if ($transaction['status'] == 'SUCCESSFUL') {
            $success = true;
            $order = Order::with('products.vendor')->where('transaction_id', $transactionID->transactionID)->first();

            // Update Wallet
            $withdraw = Withdraw::where('user_email', $order->vendor_email)->orderBy('withdraw_date', 'desc')->first();
            $vendor = Vendor::where('vendor_email', $order->vendor_email)->first();
            $user = User::where('email', $order->vendor_email)->first();
            $vat = config('app.vat_rate');
            if ($withdraw == '') {
                $withdraw = new Withdraw();
                $withdraw->user_id = $user->id;
                $withdraw->user_email = $order->vendor_email;
                $withdraw->balance = $order->product_price/$vat * (1- $order->products()->first()->vendor()->first()->rate);
                $withdraw->withdraw_date = Carbon::now();
                $withdraw->save();
            } else {
                $balance = $withdraw->balance;
                $withdraw->balance = $balance + ($order->product_price/$vat * (1- $order->products()->first()->vendor()->first()->rate));
                $withdraw->withdraw_date = Carbon::now();
                $withdraw->save();
            }

            //Save ORder
            $order_product = $order->products()->first();
            $order->payment_status = 'SUCCESSFUL';
            $order->save();
            //Send SMS 
            $client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        	$sms = new SMS($client);
        	//Download Link
            $urli = URL::temporarySignedRoute('index.download', now()->addHours(24), [
	                'id' => $order->product_id, 
	                'od' => $order->id 
	            ]);
            $url = URL::temporarySignedRoute('order.download', now()->addHours(24), [
                'id' => $order->product_id, 
                'od' => $order->id 
            ]);
        	$sendSMS = $sms->to($order->customer_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $order->customer_name. '. Thank you for purchasing \''. $order_product->product_name. '\' from The SchoolFAQs Shop. We hope to serve you again soon. You can download your product using this link: '.$url)
                        ->send();
	        //Audit Message
	        $smsaudit = new Message;
	        $smsaudit->message_type = 'Auto';
	        $smsaudit->message_purpose = 'Product Sale';
	        $smsaudit->customer_name = $order->customer_name;
	        $smsaudit->customer_tel = $order->customer_tel;
	        $smsaudit->save();
            $vat = config('app.vat_rate');
            return redirect($urli)->with('success', 'Payment Received');

        } elseif (($transaction['status'] == 'PENDING')) {
            $ref = $transactionID->transactionID;
            return view('users.verifyPayment', compact('ref'));
        }

        else {
        	$order = Order::where('transaction_id', $transactionID->transactionID)->first();
            //dd($transaction['reason']);
            $order->payment_status = $transaction['reason'];
            $order->save();
            //$vat = config('app.vat_rate');
            $failReason = $transaction['reason'];
        	return view('users.failed_payment', compact('failReason', 'order'))->with('error', 'Payment Failed');
        }
    }
}
