<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Order;
use App\Model\Vendor;
use App\User;

class TotalOrdersController extends Controller
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
        $paidOrder = ['payment_status' => 'SUCCESSFUL'];
        //Get all orders
        $order = Order::with('products.vendor')->paginate(10);
        $totalOrders = Order::all()->count(); //Get number of all daily orders
        //Get all successfully paid orders
        $paidOrders = Order::with('products.vendor')->where($paidOrder)->get();
        $totalPaidOrders = sizeof($paidOrders);
        //Get VAT 
        $vat = config('app.vat_rate');
        //Get Total Money
        foreach ($paidOrders as $po) {
            $totalMoney = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                     $vat = config('app.vat_rate');
                    return ($op->product_price * $vat);
                }
            });       
        }
        //Get Total NetIncome
        foreach ($paidOrders as $po) {
            $totalNetIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price);
                }
            });       
        } 
        //Get Total Income
        foreach ($paidOrders as $po) {
            $totalIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * $op->vendor->rate);
                }
            });       
        }      
        if ($totalPaidOrders == 0) {
                $totalMoney = 0;
                $totalNetIncome = 0;
                $totalIncome = 0;
            }
        //Total Vat
        $totalVat = $totalMoney - $totalNetIncome;
        return view('admin.superadmin.orders.total_orders', compact('order', 'totalOrders', 'totalMoney', 'paidOrders', 'totalPaidOrders', 'totalNetIncome', 'totalIncome', 'vat', 'totalVat'));
    }

    public function today_sales()
    {
        //
        $paidOrder = ['payment_status' => 'SUCCESSFUL'];
        //Get all orders
        $order = Order::with('products.vendor')->whereDate('created_at', date('Y-m-d'))->paginate(10);
        $totalOrders = Order::whereDate('created_at', date('Y-m-d'))->count(); //Get number of all daily orders
        //Get all successfully paid orders
        $paidOrders = Order::with('products.vendor')->whereDate('created_at', date('Y-m-d'))->where($paidOrder)->get();
        $totalPaidOrders = sizeof($paidOrders);
        //Get VAT 
        $vat = config('app.vat_rate');
        //Get Total Money
        foreach ($paidOrders as $po) {
                $totalMoney = $paidOrders->sum(function ($order) {
                    foreach($order->products as $op){
                        $vat = config('app.vat_rate');
                    return ($op->product_price * $vat);
                    }
                });  
            }

            if ($totalPaidOrders == 0) {
                $totalMoney = 0;
                $totalNetIncome = 0;
                $totalIncome = 0;
            }
        //Get Total NetIncome
        foreach ($paidOrders as $po) {
            $totalNetIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price);
                }
            });       
        } 

        //Get Total Income
        foreach ($paidOrders as $po) {
            $totalIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * $op->vendor->rate);
                }
            });       
        }      
        //Total Vat
        $totalVat = $totalMoney - $totalNetIncome; 

        
        return view('admin.superadmin.orders.today_sales', compact('order', 'totalOrders', 'totalMoney', 'paidOrders', 'totalPaidOrders', 'totalNetIncome', 'totalIncome', 'vat', 'totalVat'));
    }


    public function month_sales()
    {
        //     
        $paidOrder = ['payment_status' => 'SUCCESSFUL'];
        //Get all orders
        $order = Order::with('products.vendor')->whereMonth('created_at', Carbon::now()->month)->paginate(10);
        $totalOrders = Order::whereMonth('created_at', Carbon::now()->month)->count(); //Get number of alll daily orders
        //Get all successfully paid orders
        $paidOrders = Order::with('products.vendor')->whereMonth('created_at', Carbon::now()->month)->where($paidOrder)->get();
        $totalPaidOrders = sizeof($paidOrders);
        //Get VAT 
        $vat = config('app.vat_rate');
        //Get Total Money
        foreach ($paidOrders as $po) {
            $totalMoney = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                     $vat = config('app.vat_rate');
                    return ($op->product_price * $vat);
                }
            });       
        }
        //Get Total NetIncome
        foreach ($paidOrders as $po) {
            $totalNetIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price);
                }
            });       
        } 
        //Get Total Income
        foreach ($paidOrders as $po) {
            $totalIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * $op->vendor->rate);
                }
            });       
        }      
        if ($totalPaidOrders == 0) {
                $totalMoney = 0;
                $totalNetIncome = 0;
                $totalIncome = 0;
            }
        //Total Vat
        $totalVat = $totalMoney - $totalNetIncome;
        return view('admin.superadmin.orders.month_sales', compact('order', 'totalOrders', 'totalMoney', 'paidOrders', 'totalPaidOrders', 'totalNetIncome', 'totalIncome', 'vat', 'totalVat'));
    }

     public function quarter_sales()
    {       
        //     
        $paidOrder = ['payment_status' => 'SUCCESSFUL'];
        //Get all orders
        $order = Order::with('products.vendor')->where('created_at','>=',Carbon::now()->subdays(60))->paginate(10);
        $totalOrders = Order::where('created_at','>=',Carbon::now()->subdays(60))->count(); //Get number of alll daily orders
        //Get all successfully paid orders
        $paidOrders = Order::with('products.vendor')->where('created_at','>=',Carbon::now()->subdays(60))->where($paidOrder)->get();
        $totalPaidOrders = sizeof($paidOrders);
        //Get VAT 
        $vat = config('app.vat_rate');
        //Get Total Money
        foreach ($paidOrders as $po) {
            $totalMoney = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                     $vat = config('app.vat_rate');
                    return ($op->product_price * $vat);
                }
            });       
        }
        //Get Total NetIncome
        foreach ($paidOrders as $po) {
            $totalNetIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price);
                }
            });       
        } 
        //Get Total Income
        foreach ($paidOrders as $po) {
            $totalIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * $op->vendor->rate);
                }
            });       
        }      
        if ($totalPaidOrders == 0) {
                $totalMoney = 0;
                $totalNetIncome = 0;
                $totalIncome = 0;
            }
        //Total Vat
        $totalVat = $totalMoney - $totalNetIncome;
        return view('admin.superadmin.orders.quarter_sales', compact('order', 'totalOrders', 'totalMoney', 'paidOrders', 'totalPaidOrders', 'totalNetIncome', 'totalIncome', 'vat', 'totalVat'));
    }

    public function year_sales()
    {
        //     
        $paidOrder = ['payment_status' => 'SUCCESSFUL'];
        //Get all orders
        $order = Order::with('products.vendor')->whereYear('created_at', Carbon::now()->year)->paginate(10);
        $totalOrders = Order::whereYear('created_at', Carbon::now()->year)->count(); //Get number of alll daily orders
        //Get all successfully paid orders
        $paidOrders = Order::with('products.vendor')->whereYear('created_at', Carbon::now()->year)->where($paidOrder)->get();
        $totalPaidOrders = sizeof($paidOrders);
        //Get VAT 
        $vat = config('app.vat_rate');
        //Get Total Money
        foreach ($paidOrders as $po) {
            $totalMoney = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                     $vat = config('app.vat_rate');
                    return ($op->product_price * $vat);
                }
            });       
        }
        //Get Total NetIncome
        foreach ($paidOrders as $po) {
            $totalNetIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price);
                }
            });       
        } 
        //Get Total Income
        foreach ($paidOrders as $po) {
            $totalIncome = $paidOrders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * $op->vendor->rate);
                }
            });       
        }      
        if ($totalPaidOrders == 0) {
                $totalMoney = 0;
                $totalNetIncome = 0;
                $totalIncome = 0;
            }
        //Total Vat
        $totalVat = $totalMoney - $totalNetIncome;
        return view('admin.superadmin.orders.year_sales', compact('order', 'totalOrders', 'totalMoney', 'paidOrders', 'totalPaidOrders', 'totalNetIncome', 'totalIncome', 'vat', 'totalVat'));
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
