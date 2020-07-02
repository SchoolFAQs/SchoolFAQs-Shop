@extends('users.layouts.master') 
  @section('sidebar')
    @include('users.layouts.sidebar')
  @endsection
@section('content')
 <div class="container">
    <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
      <!-- Indicators -->
      <ul class="carousel-indicators">
      @foreach( $category as $cat )
        <li data-target="#demo" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
      @endforeach
      </ul>
      
      <!-- The slideshow -->
      <div class="carousel-inner">
      @foreach( $category as $cat )
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img src="/storage/category_images/{{$cat->cover_photo}}" alt="{{ $cat->category_name }}" width="1100" height="500">
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
              <h3 class="text-light p-1 rounded text-left">{{ $cat->category_name }}</h3>
          </div>
        </div>
        @endforeach
        <div class="carousel-caption d-none d-md-block">
        <div class="jumbotron jumbotron-fluid bg-transparent">
            <h1 class="display-4 text-center"><i class="fa fa-shopping-cart"></i> SchoolFAQs SHOP</h1>
          <p class="lead text-center">Shop all the latest books, tutorials, past question booklets!</p>
        </div>
        </div>
      </div>
      
      <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>

  <div class="row">
  	@foreach($products as $product)
    <div class="col-12 col-lg-4">
    	<div class="card my-3 mx-3 shadow rounded-left">
    		<div class="embed-responsive embed-responsive-4by3 hovereffect">
        		<img class="card-img embed-responsive-item" src="/storage/product_images/{{$product->product_image}}" alt="">
            <div class="overlay">
               <h2>{{$product->product_name}}</h2>
               <a class="info" href="{{ route('client.show', $product->id) }}">View Product</a>
            </div>
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$product->product_name}}</h4>

              <h6 class="card-subtitle text-muted mb-1">Rating: {{$product->product_level}}</h6>
              <hr>
              <div class="justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-store"></i> {{$product->vendor->vendor_name}} </h6>
              </div>
          		
          		<div class="buy d-flex justify-content-between align-items-center">
            		<div class="price text-success">
            			<h5 class=" mt-4"><i class="fa fa-money"></i> {{number_format($product->product_price)}} FCFA</h5>
            		</div> 

             		<a href="{{ route('client.show', $product->id) }}" class="btn btn-danger mt-3 text-light"><i class="fas fa-shopping-cart"></i> Buy</a>
          		</div>
              <h6 class="badge">Tags:</h6>
              @foreach($product->categories as $cat)
                <span class="card-subtitle badge text-muted"> {{$cat->category_name}} </span>
              @endforeach
        	</div>
      	</div>  
    </div>
    @endforeach   
  </div>
  {{$products->links()}}
</div>

@endsection
