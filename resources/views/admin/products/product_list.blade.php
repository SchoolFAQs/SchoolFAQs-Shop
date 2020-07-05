@extends('admin.layouts.master')
@section('content')
<div class="container">
	<div>
			<a href="{{ route('products.create') }}" class="btn btn-dark">Add product</a>
	</div>
	<hr>
	<div class="row">
  	@foreach($products as $product)
    @if($product->admin_name == Auth()->User()->name)
    <div class="col-12 col-lg-4">
    	<div class="card my-3 mx-3 shadow rounded-left">
    		<div class="embed-responsive embed-responsive-4by3 hovereffect">
        		<img class="card-img embed-responsive-item" src="/storage/product_images/{{$product->product_image}}" alt="{{$product->product_name}}">
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$product->product_name}}</h4>
          		<p class="card-text">{{$product->product_description}}</p>
          		<p class="card-text">{{$product->vendor->vendor_name}}</p>
          		@foreach($product->categories as $category)
          		<span class="card-text badge badge-dark">{{$category->category_name}}</span>
          		@endforeach
              <hr>          		
          		<div class="d-flex justify-content-between align-items-center">
          			<a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger">Delete</button>
                  @csrf
                </form>
          		</div>
        	</div>
      	</div>  
    </div>
    @endif
    @endforeach   
  </div>
</div>
@endsection