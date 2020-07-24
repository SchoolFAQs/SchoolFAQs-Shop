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
use App\Models\Apply;

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
        $products = Product::orderBy('best_seller', 'desc')->orderBy('featured', 'desc')->orderBy('created_at', 'desc')->paginate(13);
        $vat = config('app.vat_rate');
        return view('users.welcome', compact('products', 'category', 'order_count', 'vat'));
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

    public function vendor_apply()
    {
        //
       return view('users.vendor_apply');
    }

    public function vendor_application(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_tel' => 'required',
            'date_of_birth' => 'required',
            'id_card' => 'required|mimetypes:application/pdf',
            'license' => 'sometimes|mimetypes:application/pdf'
            //'kyc_form' => 'required|mimetypes:application/pdf'
        ]);
        $apply = new Apply;
        $apply->user_name = $request->input('user_name');

        //Save ID Card File
        if($request->hasFile('id_card')){
            //Get just extenstion
            $extension = $request->file('id_card')->getClientOriginalExtension();
            //File Name to store
            $idCardName = $apply->user_name.'_idcard'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('id_card')->storeAs('public/applications/'.$request->input('user_name'), $idCardName);

        } else {
                $idCardName = 'noimage.jpg';
        }
        //Save License File
        if($request->hasFile('license')){
            //Get just extenstion
            $extension = $request->file('license')->getClientOriginalExtension();
            //File Name to store
            $licenseName = $apply->user_name.'_license'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('license')->storeAs('public/applications/'.$request->input('user_name'), $licenseName);

        } else {
                $licenseName = 'noimage.jpg';
        }

        //Save KYF File
        /*if($request->hasFile('kyc_form')){
            //Get just extenstion
            $extension = $request->file('kyc_form')->getClientOriginalExtension();
            //File Name to store
            $kycName = $apply->user_name.'_kyc'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('kyc_form')->storeAs('public/applications/'.$request->input('user_name'), $kycName);

        } else {
                $kycName = 'noimage.jpg';
        }*/
  
        $apply->user_email = $request->input('user_email');
        $apply->user_tel = '+237'.$request->input('user_tel');
        $apply->date_of_birth = $request->input('date_of_birth');
        $apply->id_card = $idCardName;
        $apply->license = $licenseName;
        //$apply->kyc_form = $kycName;
        $apply->save();
        return view('users.vendorApply')->with('success', 'Application Sent');
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
        $vat = config('app.vat_rate');
        //dd($productSearch);
        return view('users.search', compact('productSearch', 'search', 'category', 'order_count', 'vat'));

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
        $vat = config('app.vat_rate');
        return view('users.category_search', compact('categorySearch','search', 'category', 'order_count', 'vat'));

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
        $product = Product::where('slug', $product)->first();
        $vat = config('app.vat_rate'); 
        //dd($product);   
        return view('users.pay', compact('product', 'category', 'vat'));
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
