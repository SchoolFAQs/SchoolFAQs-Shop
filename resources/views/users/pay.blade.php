@extends('users.layouts.master')
@section('content')
<div class="container">
  <div class="row">
      <div class="mt-3 col img-thumbnail">
        <h5 class="card-title text-center display-5">Payment Form<br> <img src="{{ asset('mtn_checkout.png') }}"> {{--| <img class="rounded-circle" src="{{ asset('orange_checkout.png') }}">--}} </h5>
        <div class="card-body">
          <form method="POST" action="{{ route('client.pay') }}" class="form-group">
    		      <label><h6>Name</h6></label>
    		      <input type="text" class="form-control my-2 py-3 shadow-none border-top-0 border-left-0 border-right-0" name="customer_name" placeholder="Your Name">
      		      <label><h6>Mobile Money Number</h6></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">+237</span>
                  </div>
                  <input type="number"  class="form-control border-top-0 border-left-0 border-right-0 outline-none" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" name="customer_tel" placeholder="eg: 681108107" aria-label="Default" aria-describedby="inputGroup-sizing-small">
                </div>
    		      <div class="border p-2 my-2 bg-dark text-white">
                <label><h6>Product Name: {{$product->product_name}}  </h6></label>
              <input type="hidden" value="{{$product->product_name}}" readonly="" class="form-control border-top-0 border-left-0 border-right-0 my-2 py-3" name="product_name" placeholder="{{$product->product_name}}">
              <div>
                 <label><p>VAT: {{number_format($vat*$product->product_price - $product->product_price)}} FCFA</p></label> 
              </div>
              <div>
                <label><p>Net Price: {{number_format($vat/$vat*$product->product_price)}} FCFA</p></label>
              </div>
              
              <div>
                <label><h6>Total Price: {{round($product->product_price * $vat)}} FCFA </h6></label>
                <input type="hidden" value="{{round($product->product_price * $vat)}}" readonly="" class="form-control border-top-0 border-left-0 border-right-0 my-2 py-3" name="product_price">
              </div>  
              </div>
    		      
              <input type="hidden" name="product_id" value="{{$product->id}}">
              <input type="hidden" name="vendor_email" value="{{$product->vendor->vendor_email}}">
              <input type="hidden" name="vendor_rate" value="{{$product->vendor->rate}}">
              <input type="hidden" name="vendor_id" value="{{$product->vendor->id}}">    
              <input type="submit" id="pay" class="btn mt-2 mr-2 rounded-pill btn-primary" value="Pay {{number_format($product->product_price * $vat)}} FCFA">
            @csrf
    		  </form>
        </div>
      </div>
      
    <div class="mt-3 col">
        <div class="card shadow rounded">
          <div>
            <img class="card-img img-thumbnail" src="/storage/product_images/{{$product->product_image}}" alt="{{$product->product_name}}">
          </div>
          <div class="card-body">
            <h4 class="card-title text-center text-capitalize">{{$product->product_name}}</h4>
            <p class="card-text text-justify text-body">{{$product->product_description}}</p>
            <h6 class="mt-4 text-success"><i class="fa fa-money"></i> {{number_format($vat*$product->product_price)}} FCFA</h6>
            <h6 class="badge">Tags:</h6>
            @foreach($product->categories as $cat)
              <span class="badge text-muted">{{$cat->category_name}}</span>
            @endforeach
                <hr>
                <div class="mt-3 row">
                  <div class="col-12 col-lg-4">
                    <div>
                      <div class="row no-gutters">
                        <div class="col-6">
                          <div>
                            <img class="card-img" src=/storage/vendor_images/{{$product->vendor->vendor_image}} alt="..."> 
                          </div> 
                        </div>
                        <div class="col">
                          <div class="card-block px-1">
                            <h6 class="card-title text-capitalize">{{$product->vendor->vendor_name}}</h6>
                            <small class="card-subtitle mb-2 text-muted">{{$product->vendor->vendor_about}}</small>
                          </div>
                        </div>      
                  </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
