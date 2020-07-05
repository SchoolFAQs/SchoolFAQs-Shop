@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3">ADMIN EDIT PRODUCT</h1>
	<form method="POST" action="{{ route('adminproducts.update', $product->id) }}" autocomplete="on" class="form-group" enctype="multipart/form-data">

		<div class="m-3 p-2">
			<div class="lead">
				<label><h5>PRODUCT RATING</h5></label>
			</div>
				
			<div class="form-check form-check-inline">
			    <input type="checkbox" class="form-check-input" name="featured_product" value="1">
			    <label class="form-check-label" for="featured_product">Featured Product</label>
			</div>
			<div class="form-check form-check-inline">
			    <input type="checkbox" class="form-check-input" name="best_seller" value="1">
			    <label class="form-check-label" for="best_seller">Best Seller</label>
			</div>
		</div>

		<label><h5>Product Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="product_name" value="{{$product->product_name}}">
		<label><h5>Product Price</h5></label>
		<input type="text" class="form-control my-2 py-3" name="product_price" value="{{$product->product_price}}">
		<div>
			<label><h5>Product Level</h5></label>
			<input type="text" name="product_level" class="form-control" value="{{$product->product_level}}">
		</div>
		<div>
			<label><h5>Product Description</h5></label>
			<textarea  class="form-control py-3" rows="6" name="product_description">{{$product->product_description}}</textarea>
		</div>
		<div class="form-group my-3">
			<label><h5>Product Image</h5></label>
			<div>
				<input type="file" name="product_image">
			</div>
		</div>	
		<input type="submit" class="btn text-light bg-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('adminproducts.index') }}">Go Back</a>
		@csrf
		<input type="hidden" name="_method" value="PUT">		
	</form>
</div>
@endsection 
