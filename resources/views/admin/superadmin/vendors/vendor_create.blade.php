@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3"> CREATE VENDOR</h1>
	<form method="POST" action="{{ route('vendors.store') }}" class="form-group" enctype="multipart/form-data">
		<label><h5>User Name</h5></label>
		<input type="text" class="form-control my-2 py-3" readonly="" name="user_name" value="{{$user->name}}">
		<label><h5>Vendor Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="vendor_name" placeholder="Vendor Name">
		<label><h5>Vendor Email</h5></label>
		<input type="text" class="form-control my-2 py-3" name="vendor_email" readonly="" value="{{$user->email}}">

		<label><h5>Vendor Telephone</h5></label>
		<input type="text" class="form-control my-2 py-3" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="681108107" name="vendor_tel">
		<label><h5>About User</h5></label>
		<textarea  class="form-control py-3" rows="5" name="vendor_about" placeholder="Vendor Description"></textarea>
		<div class="form-group my-3">
			<label><h5>Vendor Image</h5></label>
			<div>
				<input type="file" name="vendor_image">
			</div>		
		</div>
		<input type="hidden" value="{{$user->id}}" name="user_id">
		<input type="submit" class="btn text-light btn-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('user.index') }}">Go Back</a>
		@csrf		
	</form>
</div>
@endsection 