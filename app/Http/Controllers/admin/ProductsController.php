<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $products = Product::with('vendor')->get();
        return view('admin.products.product_list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendor = Vendor::all();
        $category = Category::all();
        return view('admin.products.product_create', compact('category', 'vendor'));
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
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_level' => 'sometimes',
            'product_image' => 'required|file|image|max:1999',
            'product_file' => 'required',
            'vendor_id' => 'required',
            'category_id' => 'required'
        ]);

        $product = new Product;
        $product->product_name = $request->input('product_name');

        // Handle file upload
        if($request->hasFile('product_image')){
            //Get just extenstion
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //File Name to store
            $fileImageToStore = $product->product_name.'_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileImageToStore);
        } else {
                $fileImageToStore = 'noimage.jpg';
        }

        if($request->hasFile('product_file')){
            //Get just extenstion
            $extension = $request->file('product_file')->getClientOriginalExtension();
            //File Name to store
            $fileNameToStore = $product->product_name.'_file'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('product_file')->storeAs('public/products', $fileNameToStore);
        } else {
                $fileNameToStore = 'noimage.jpg';
        }
        
        
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');
        $product->product_level = $request->input('product_level');
        $product->product_image = $fileImageToStore;
        $product->product_file = $fileNameToStore;
        $product->vendor_id = $request->input('vendor_id');
        $product->admin_name = Auth()->User()->name;
        $product->save();
        $category_id = $request->input('category_id');
        $product->categories()->attach($category_id);

        // Send SMS
        /*$client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($product->vendor->vendor_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $product->vendor->user_name. '. Congratulations, your product, '. $product->product_name. ', sold at '.$product->product_price.'FCFA has been added to your '.$product->vendor->vendor_name.' shop. Use this link to view it: ' . route('products.index', $product->id). '')
                        ->send();*/

        return redirect(route('products.index'))->with('success', 'Product Created');
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
        $product = Product::find($id);
        return view('admin.products.product_edit', compact('product'));
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
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_level' => 'sometimes',
            'product_image' => 'sometimes|file|image|max:1999',
        ]);

        $product = Product::find($id);
        $product->product_name = $request->input('product_name');

        // Handle file upload
        if($request->hasFile('product_image')){
            //Get just extenstion
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //File Name to store
            $fileImageToStore = $product->product_name.'_image'.time().'.'.$extension;
             //Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileImageToStore);
        } else {
                $fileImageToStore = $product->product_image;
        }    
        
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');
        $product->product_level = $request->input('product_level');
        $product->product_image = $fileImageToStore;
        $product->product_file = $product->product_file;
        $product->vendor_id = $product->vendor_id;
        $product->admin_name = Auth()->User()->name;
        $product->save();
        $category_id = $product->category_id;
        $product->categories()->attach($category_id);

        // Send SMS
        /*$client = SMSClient::getInstance(config('app.client_id'), config('app.client_secret'));
        $sms = new SMS($client);
        $sendSMS = $sms->to($product->vendor->vendor_tel)
                        ->from(config('app.sms_number'), 'SchoolFAQs')
                        ->message('Hello '. $product->vendor->user_name. '. Your product, '. $product->product_name. ', sold at '.$product->product_price.'FCFA has been updated. Use this link to view it: ' . route('products.index', $product->id). '')
                        ->send();*/

        return redirect(route('products.index'))->with('success', 'Product Updated');
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
        $product = Product::find($id);
        $product->delete();
        return redirect(route('products.index'))->with('success', 'Product Deleted');
    }
}
