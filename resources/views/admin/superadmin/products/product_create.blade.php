@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3"> ADMIN CREATE PRODUCT</h1>
	<form method="POST" action="{{ route('products.store') }}" autocomplete="on" class="form-group" enctype="multipart/form-data">
		<label><h5>Product Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="product_name" placeholder="Product Name">
		<label><h5>Product Price</h5></label>
		<input type="text" class="form-control my-2 py-3" name="product_price" placeholder="Product Price">
		<div>
			<label><h5>Product Category</h5></label>
			<select name="category_id[]" multiple="" class=" form-control selectpicker" data-actions-box="true" title="Choose Categories.." data-live-search="true" id="category_id[]">
				<option value=""></option>
				@foreach($category as $cat)
				<option data-icon="fas fa-layer-group" value="{{$cat->id}}">{{$cat->category_name}}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label><h5>Product Level</h5></label>
			<input type="text" name="product_level" class="form-control" placeholder="Product / Size / Rating">
		</div>
		<div>
			<label><h5>Product Description</h5></label>
			<textarea  class="form-control py-3" rows="6" name="product_description" placeholder="Product Description"></textarea>
		</div>
		<div class="form-group my-3">
			<label><h5>Product Image</h5></label>
			<div>
				<input type="file" name="product_image">
			</div>
		</div>
		<div class="form-group my-3">
			<label><h5>Product File</h5></label>
			<div>
				<input type="file" name="product_file">
			</div>
		</div> 
		<div>
			<label><h5>Product Vendor</h5></label>
			<select name="vendor_id" class=" form-control selectpicker" title="Choose Vendor.." data-live-search="true" id="vendor_id">
				<option value=""></option>
				@foreach($vendor as $v)
				<option data-icon="fas fa-store" value="{{$v->id}}">{{$v->vendor_name}}</option>
				@endforeach

			</select>
		</div>
		<input type="submit" class="btn text-light bg-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('adminproducts.index') }}">Go Back</a>
		@csrf		
	</form>
</div>
@endsection 
