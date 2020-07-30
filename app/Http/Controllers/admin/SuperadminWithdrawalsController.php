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

class SuperadminWithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $withdraw_request = Withdraw::orderBy('created_at', 'asc')->get();
        return view('admin.superadmin.vendorwallet.vendor_withdraw_request', compact('withdraw_request'));
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
     public function approve(Request $request, $id)
    {
        //
            $withdraw = Withdraw::find($id);
            $withdraw->withdraw_status = 'SUCCESSFUL';
            $withdraw->save();
            return Redirect::back()->with('success', 'Withdrawal request approved.');
    }

    public function reject(Request $request, $id)
    {
            $withdraw = Withdraw::find($id);
            $newBalance = $withdraw->balance + $withdraw->withdraw_amount;
            $withdraw->balance = $newBalance;
            $withdraw->withdraw_status = 'FAILED';
            $withdraw->save();
            return Redirect::back()->with('error', 'Withdrawal request rejected.');
    }
    public function update(Request $request, $id)
    {
        //
        dd($id);
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
