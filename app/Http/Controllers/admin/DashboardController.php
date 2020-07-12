<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     

        return view('admin.dashboard');
    	}
    }
}
