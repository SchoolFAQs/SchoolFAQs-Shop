@extends('admin.layouts.master')
@section('content')
<div class="container">
	<h1 class="text-center my-3"> EDIT CATEGORY</h1>
	<form method="POST" action="{{ route('category.update', $category->id) }}" class="form-group" enctype="multipart/form-data">
		<label><h5>Category Name</h5></label>
		<input type="text" class="form-control my-2 py-3" name="category_name" value="{{$category->category_name}}">
		<label><h5>Category Description</h5></label>
		<textarea  class="form-control py-3" rows="10" name="category_description">{{$category->category_description}}</textarea>
		<div class="form-group my-3">
			<div>
				<h6>Current Image</h6>
				<img class="w-25 img-thumbnail" src="/storage/category_images/{{$category->cover_photo}}" alt="">
			</div>
			<label><h5>Choose new Cover Image</h5></label>
			<div>
				<input type="file" name="cover_photo">
			</div>		
		</div>
		<input type="submit" class="btn text-light btn-secondary my-2" name="Save Product">
		<a class="btn bg-dark text-light py-1 my-2" href="{{ route('category.index') }}">Go Back</a>
		<input type="hidden" name="_method" value="PUT">
		@csrf		
	</form>
</div>
@endsection