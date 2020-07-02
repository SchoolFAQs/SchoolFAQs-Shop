@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3"> EDIT VENDOR</h1>
	<form method="POST" action="{{ route('vendors.update', $vendor->id) }}" class="form-group" enctype="multipart/form-data">
		<label><h5>User Name</h5></label>
		<input type="text" class="form-control my-2 py-3" readonly="" name="user_name" value="{{$vendor->user_name}}">
		<label><h5>Vendor Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="vendor_name" value="{{$vendor->vendor_name}}">
		<label><h5>Vendor Email</h5></label>
		<input type="text" class="form-control my-2 py-3" name="vendor_email" readonly="" value="{{$vendor->vendor_email}}">

		<label><h5>Vendor Telephone</h5></label>
		<input type="text" class="form-control my-2 py-3" name="vendor_tel" value="{{$vendor->vendor_tel}}">
		<label><h5>About User</h5></label>
		<textarea  class="form-control py-3" rows="5" name="vendor_about">{{$vendor->vendor_about}}</textarea>
		<div class="form-group my-3">
			<div>
				<h6>Current Image</h6>
				<img class="w-25 disabled img-thumbnail" src="/storage/vendor_images/{{$vendor->vendor_image}}" alt="">
			</div>
			<label><h5>Vendor Image</h5></label>
			<div>
				<input type="file" name="vendor_image">
			</div>		
		</div>
		<input type="submit" class="btn text-light btn-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('vendors.index') }}">Go Back</a>
		<input type="hidden" name="_method" value="PUT">
		@csrf		
	</form>
</div>
@endsection 