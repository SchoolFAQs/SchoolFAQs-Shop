<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Laravel\Scout\Searchable;
use TeamTNT\TNTSearch\TNTSearch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Order;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        $prod = Product::all()->pluck('id');
        //$order_count = Order::all()->pluck('product_name')->countBy();
        $order_count = DB::table('orders')
             ->select('product_id', DB::raw('count(*) as total'))
             ->groupBy('product_id')
             ->get();
        $products = Product::orderBy('best_seller', 'desc')->orderBy('featured', 'desc')->paginate(6);
        return view('users.welcome', compact('products', 'category', 'order_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function review()
    {
        //
        dd('123');
    }
    public function side_bar_cat()
    {
        //
        $category = Category::orderBy('created_at', 'desc');
        return view('users.layouts.sidebar', compact('category'));
    }
    public function create()
    {
        //
    }
    //Search Student
    public function general_search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        //$tnt = new TNTSearch;
        //$tnt->loadConfig([
        //"storage"   => storage_path(),
        //"driver"    => 'filesystem',
        //]);
        //$tnt->selectIndex("products.index");
        //$tnt->asYouType = true;
        //$results = $tnt->search($request->input('search'));
        //dd($results);
        $order_count = DB::table('orders')
             ->select('product_id', DB::raw('count(*) as total'))
             ->groupBy('product_id')
             ->get();
        $productSearch = Product::search($request->input('search'))->orderBy('best_seller', 'desc')->orderBy('featured', 'desc')->get();
        //$vendorSearch = Vendor::search($request->input('search'))->get();
        //$categorySearch = Category::search($request->input('search'))->get();
        $search = $request->input('search');
        $category = Category::orderBy('created_at', 'desc');
        //dd($productSearch);
        return view('users.search', compact('productSearch', 'search', 'category', 'order_count'));

    }
    public function category_search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        //$tnt = new TNTSearch;
        //$productSearch = Product::search($request->input('search'))->get();
        //$vendorSearch = Vendor::search($request->input('search'))->get();
        $categorySearch = Category::find($request->input('search'));
        //$categorySearch->products()->sync($request->search);
        $search = $categorySearch->category_name;
        //dd($categorySearch->products);
        //dd($categorySearch);
        $order_count = DB::table('orders')
             ->select('product_id', DB::raw('count(*) as total'))
             ->groupBy('product_id')
             ->get();
        $category = Category::orderBy('created_at', 'desc');
        return view('users.category_search', compact('categorySearch','search', 'category', 'order_count'));

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
    public function show($product)
    {
        //
        $category = Category::orderBy('created_at', 'desc');
        $product = Product::find($product);
        return view('users.pay', compact('product', 'category'));
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
