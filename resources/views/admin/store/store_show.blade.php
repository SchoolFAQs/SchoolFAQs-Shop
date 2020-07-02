@extends('admin.layouts.master')
@section('content')
<div class="container">
 
	<div>
			<a href="{{ route('store.index') }}" class="btn btn-dark">Go Back</a>
	</div>
	<hr> 
  <div class="h1">
    Products
  </div>
	<div class="row">
  	@foreach($stores->products as $product)
    <div class="col-12 col-lg-4">
    	<div class="card my-3 mx-3 shadow rounded-left">
    		<div class="embed-responsive embed-responsive-4by3 hovereffect">
        		<img class="card-img embed-responsive-item" src="/storage/product_images/{{$product->product_image}}" alt="{{$product->product_name}}">
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$product->product_name}}</h4>
          		<p class="card-text">{{$product->product_description}}</p>         		
          		<div class="d-flex justify-content-between align-items-center">
          			<a href="{{ route('store.edit', $product->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-eye"></i> View Product</a>
          		</div>
        	</div>
      	</div>  
    </div>
    @endforeach   
  </div>
</div>
@endsection