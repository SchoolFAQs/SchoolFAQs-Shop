@extends('admin.layouts.master')
@section('content')
<div class="container">
	<div>
			<a href="{{ route('category.create') }}" class="btn btn-dark">Add Category</a>
	</div>
	<hr>
	<div class="row">
  	@foreach($categories as $category)
    <div class="col-12 col-lg-4">
    	<div class="card my-3 mx-3 shadow rounded-left">
    		<div class="embed-responsive embed-responsive-4by3 hovereffect">
        		<img class="card-img embed-responsive-item" src="/storage/category_images/{{$category->cover_photo}}" alt="{{ route('category.show', $category->id) }}">
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$category->category_name}}</h4>
          		<p class="card-text">{{$category->category_description}}</p>
              <hr>          		
          		<div class="d-flex justify-content-between align-items-center">
          			<a href="{{ route('category.edit', $category->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger">Delete</button>
                  @csrf
                </form>
          		</div>
        	</div>
      	</div>  
    </div>
    @endforeach   
  </div>
  {{$categories->links()}}
</div>
@endsection