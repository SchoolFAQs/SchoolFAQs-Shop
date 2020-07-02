@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3"> CREATE CATEGORY</h1>
	<form method="POST" action="{{ route('category.store') }}" class="form-group" enctype="multipart/form-data">
		<label><h5>Category Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="category_name" placeholder="Category Name">
		<label><h5>Category Description</h5></label>
		<textarea  class="form-control py-3" rows="10" name="category_description" placeholder="Category Description"></textarea>
		<div class="form-group my-3">
			<label><h5>Category Cover Image</h5></label>
			<div>
				<input type="file" name="cover_photo">
			</div>		
		</div>
		<input type="submit" class="btn text-light btn-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('category.index') }}">Go Back</a>
		@csrf		
	</form>
</div>
@endsection 