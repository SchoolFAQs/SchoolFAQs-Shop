<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Vendor;
use App\User;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        if((Auth::user()->password_changed_at == null)){
            return redirect(route('changePassword'));
        } else {
         if((Auth::user()->role=='1')){
           
         } else {
         
        }
        // Dashboard
           /*$my_orders = DB::table('orders')
             ->where('vendor_email', '=', Auth()->User()->email)
             ->select('product_id', DB::raw('count(*) as total'))
             ->groupBy('product_id')
             ->get();*/

            $stores = Vendor:: orderBy('created_at', 'desc')->paginate(5);
            return view('admin.store.store_list', compact('stores'));

        //return view('admin.dashboard');
    	}
    }
}
