<?php

namespace App\Http\ViewComposers;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\User;
use Carbon\Carbon;
use App\Models\Apply;
use App\Models\Message;

class SidebarComposer
{
    public function compose($view)
    {
        $view->with(
        	[
        		'my_products' => Product::where('admin_name', Auth()->User()->name)->count(),
        		'my_vendors' => Vendor::where('vendor_email', Auth()->User()->email)->count(),
        		'my_orders' => Order::where('vendor_email', Auth()->User()->email)->count(),
        		'total_products' => Product::all()->count(),
        		'total_vendors' => Vendor::all()->count(),
                'total_applications' => Apply::where('solve_date', NULL)->count(),
        		'total_users' => User::where('role', NULL)->count(),
        		'total_categories' => Category::all()->count(),
        		'total_messages' => Contact::where('is_solved', NULL)->count(),
                'messages_count' => Message::all()->count(),
        		'total_today_orders' => Order::whereDate('created_at', date('Y-m-d'))->count(),
        		'total_month_orders' => Order::whereMonth('created_at', Carbon::now()->month)->count(),
        		'total_quater_orders' => Order::where('created_at','>=',Carbon::now()->subdays(60))->count(),
        		'total_year_orders' => Order::whereYear('created_at', Carbon::now()->year)->count(),
        		'all_time_orders' => Order::all()->count(),

        ]);
    }
}