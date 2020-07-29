<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Vendor;
use App\User;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Force User to change Password
    public function showChangePasswordForm(){
        return view('admin.auth.changepassword');
    }
    public function changePassword(Request $request){
        //
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->password_changed_at = \Carbon\Carbon::now();
        $user->save();

        return redirect(route('admin.dashboard'))->with("success","Password changed successfully!");
     }

     
    public function index()
    {
        $myOrders = ['vendor_email' => Auth()->User()->email, 'payment_status' => 'SUCCESSFUL'];
        $orders = Order::with('products.vendor')->where($myOrders)->paginate(10);   
        $vat = config('app.vat_rate');        
        $totalOrders = Order::where($myOrders)->count();
        foreach ($orders as $oo) {
            $totalIncome = $orders->sum(function ($order) {
                foreach($order->products as $op){
                    return ($op->product_price * (1 - $op->vendor->rate));
                }
            });       
        }      

        return view('admin.orders.order_index', compact('orders', 'totalOrders', 'vat', 'totalIncome'));                
    }


    public function profile ($user){
        $profile = User::where('slug', $user)->first();
        //dd($profile);
        return view('admin.users.profile', compact('profile'));
    }
    


}
