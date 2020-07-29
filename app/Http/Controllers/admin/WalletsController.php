<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use User;
use Auth;
use DB;
use Carbon\Carbon;
use Redirect;

class WalletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function my_wallet($email){

        
        $my_wallet = Withdraw::where('user_email', $email)->orderBy('created_at', 'desc')->get();
        
        if (count($my_wallet) == 0) {
           $myOrders = ['vendor_email' => Auth()->User()->email, 'payment_status' => 'SUCCESSFUL'];
            $orders = Order::with('products.vendor')->where($myOrders)->orderBy('created_at', 'desc')->get();   
            $vat = config('app.vat_rate');        
            foreach ($orders as $oo) {
            $myBalance = $orders->sum(function ($order) {
                   foreach($order->products as $op){
                    $vat = config('app.vat_rate');
                        return ($order->product_price/$vat * (1 - $op->vendor->rate) );     
                    } 
                 });    
            $my_balance = DB::table('withdraws')->where('user_email', $email)->orderBy('withdraw_date', 'desc')->first();
             return view('admin.wallet.wallet_index', compact('my_wallet','myBalance', 'my_balance'));       
            }
        } else {
            $my_balance = DB::table('withdraws')->where('user_email', $email)->orderBy('withdraw_date', 'desc')->first();
            return view('admin.wallet.wallet_index', compact('my_wallet', 'my_balance'));
        }             
    }

     public function withdraw_request(Request $request){
         $this->validate($request, [
            'amount' => 'required',
            'withdraw_number' => 'required'
        ]);
         $my_wallet = Withdraw::where('user_email', Auth()->User()->email)->orderBy('created_at', 'desc')->get();
        
        if (count($my_wallet) == 0) {
           $myOrders = ['vendor_email' => Auth()->User()->email, 'payment_status' => 'SUCCESSFUL'];
            $orders = Order::with('products.vendor')->where($myOrders)->orderBy('created_at', 'desc')->get();   
            $vat = config('app.vat_rate');        
            foreach ($orders as $oo) {
            $myBalance = $orders->sum(function ($order) {
                   foreach($order->products as $op){
                    $vat = config('app.vat_rate');
                        return ($order->product_price/$vat * (1 - $op->vendor->rate) );     
                    } 
                 });
                if ($request->input('amount') <= $myBalance) {
                    $withdraw = new Withdraw();
                    $withdraw->user_id = Auth()->User()->id;
                    $withdraw->user_email = Auth()->User()->email;
                    $withdraw->balance = $myBalance - $request->input('amount');
                    $withdraw->withdraw_amount = $request->input('amount');
                    $withdraw->user_number = $request->input('withdraw_number');
                    $withdraw->withdraw_date = Carbon::now();
                    $withdraw->save();
                    return Redirect::back()->with('success', 'Your Withdrawal request has been sent!');
                } else {
                    return Redirect::back()->with('error', 'Your Account Balance is not enough to make this Withdrawl!');
                }            
            }
        } else {
             $my_balance = DB::table('withdraws')->where('user_email', Auth()->User()->email)->orderBy('withdraw_date', 'desc')->first();
             $myBalance = $my_balance->balance;
            if ($request->input('amount') <= $myBalance) {
                $withdraw = new Withdraw();
                $withdraw->user_id = Auth()->User()->id;
                $withdraw->user_email = Auth()->User()->email;
                $withdraw->balance = $myBalance - $request->input('amount');
                $withdraw->withdraw_amount = $request->input('amount');
                $withdraw->user_number = $request->input('withdraw_number');
                $withdraw->withdraw_date = Carbon::now();
                $withdraw->save();
                 return Redirect::back()->with('success', 'Your Withdrawal request has been sent!');
            } else {
                    return Redirect::back()->with('error', 'Your Account Balance is not enough to make this Withdrawl!');
            }
        }
     }

    public function index()
    {
    
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
