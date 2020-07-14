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
        $order = Order::orderBy('created_at', 'desc')->paginate(10);
        $product = Product::with('vendor')->get();
        $totalOrders = Order::count();
        $totalMon = Order::sum('product_price');
        $totalMoney = $totalMon * config('app.rate');
         $vat_value =  $totalMon - $totalMon/config('app.vat_rate');
        $vat = config('app.vat_rate');
        return view('admin.superadmin.orders.total_orders', compact('order', 'product', 'totalMoney', 'totalOrders' , 'totalMon', 'vat_value', 'vat'));
    }
    public function today_sales()
    {
        //
        
        $order = Order::whereDate('created_at', date('Y-m-d'))->get();
        $product = Product::with('vendor')->get();
        $totalOrders = Order::whereDate('created_at', date('Y-m-d'))->count();
        $totalMon = Order::whereDate('created_at', date('Y-m-d'))->sum('product_price');
        $totalMoney = $totalMon * config('app.rate');
        $vat_value =  $totalMon - $totalMon/config('app.vat_rate');
        $vat = config('app.vat_rate');
        return view('admin.superadmin.orders.today_sales', compact('order', 'product', 'totalMoney', 'totalOrders' , 'totalMon', 'vat', 'vat_value'));
    }
    public function month_sales()
    {
        //
        
        $order = Order::whereMonth('created_at', Carbon::now()->month)->get();
        $product = Product::with('vendor')->get();
        $totalOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $totalMon = Order::whereMonth('created_at', Carbon::now()->month)->sum('product_price');
        $totalMoney = $totalMon * config('app.rate');
        $vat_value =  $totalMon - $totalMon/config('app.vat_rate');
        $vat = config('app.vat_rate');
        return view('admin.superadmin.orders.month_sales', compact('order', 'product', 'totalMoney', 'totalOrders' , 'totalMon', 'vat_value', 'vat'));
    }

     public function quarter_sales()
    {
        //
        
        $order = Order::where('created_at','>=',Carbon::now()->subdays(60))->get();
        $product = Product::with('vendor')->get();
        $totalOrders = Order::where('created_at','>=',Carbon::now()->subdays(60))->count();
        $totalMon = Order::where('created_at','>=',Carbon::now()->subdays(60))->sum('product_price');
        $totalMoney = $totalMon * config('app.rate');
        $vat_value =  $totalMon - $totalMon/config('app.vat_rate');
        $vat = config('app.vat_rate');
        return view('admin.superadmin.orders.quarter_sales', compact('order', 'product', 'totalMoney', 'totalOrders' , 'totalMon', 'vat', 'vat_value'));
    }

    public function year_sales()
    {
        //
        
        $order = Order::whereYear('created_at', Carbon::now()->year)->get();
        $product = Product::with('vendor')->get();
        $totalOrders = Order::whereYear('created_at', Carbon::now()->year)->count();
        $totalMon = Order::whereYear('created_at', Carbon::now()->year)->sum('product_price');
        $totalMoney = $totalMon * config('app.rate');
        $vat_value =  $totalMon - $totalMon/config('app.vat_rate');
        $vat = config('app.vat_rate');
        return view('admin.superadmin.orders.year_sales', compact('order', 'product', 'totalMoney', 'totalOrders' , 'totalMon', 'vat', 'vat_value'));
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
