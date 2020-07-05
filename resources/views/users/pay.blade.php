@extends('users.layouts.master')
@section('content')
<div class="container">
  <div class="row">
      <div class="my-3 col img-thumbnail">
        <h5 class="card-title text-center display-5">Payment Form<br> <img src="{{ asset('mtn_checkout.png') }}"> | <img class="rounded-circle" src="{{ asset('orange_checkout.png') }}"> </h5>
        <div class="card-body">
          <form method="POST" action="{{ route('order.store') }}" class="form-group">
    		      <label><h6>Name</h6></label>
    		      <input type="text" class="form-control my-2 py-3" name="customer_name" placeholder="Your Name">
    		      <label><h6>Mobile Money Number</h6></label>
    		      <input type="text" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" class="form-control my-2 py-3" name="customer_tel" placeholder="example: 681108107">
    		      <label><h6>Product Name </h6></label>
              <input type="text" value="{{$product->product_name}}" readonly="" class="form-control my-2 py-3" name="product_name" placeholder="{{$product->product_name}}">
    		      <label><h6>Total Price </h6></label>
    		      <input type="text" value="{{$product->product_price}}" readonly="" class="form-control my-2 py-3" name="product_price" placeholder="{{number_format($product->product_price)}}">
              <input type="hidden" name="product_id" value="{{$product->id}}">
    	       <div class="card-footer">
              <input type="hidden" name="vendor_email" value="{{$product->vendor->vendor_email}}">
             <div class="card-footer">
              <input type="submit" class="fas fa-money-bill btn px-3 py-3 btn-dark text-light my-2 mt-3" value="Pay {{number_format($product->product_price)}} FCFA">
            </div>
          </div>
            @csrf
    		  </form>
        </div>
      </div>

    <div class="my-3 col">
        <div class="card shadow rounded">
          <div>
            <img class="card-img img-thumbnail" src="/storage/product_images/{{$product->product_image}}" alt="{{$product->product_name}}">
          </div>
          <div class="card-body">
            <h4 class="card-title text-center text-capitalize">{{$product->product_name}}</h4>
            <p class="card-text text-justify text-body">{{$product->product_description}}</p>
            <h6 class="mt-4 text-success"><i class="fa fa-money"></i> {{number_format($product->product_price)}} FCFA</h6>
            <h6 class="badge">Tags:</h6>
            @foreach($product->categories as $cat)
              <span class="badge text-muted">{{$cat->category_name}}</span>
            @endforeach

            <div class="card" style="max-width: 540px;">
                <div class="row no-gutters mt-3">
                  <div class="col-md-4">
                    <img class="card-img img-thumbnail" src=/storage/vendor_images/{{$product->vendor->vendor_image}} alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$product->vendor->vendor_name}}</h5>
                      <p class="card-text">{{$product->vendor->vendor_about}}</p>
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