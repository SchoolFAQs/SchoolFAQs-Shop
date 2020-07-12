@extends('users.layouts.master') 
  @section('sidebar')
    @include('users.layouts.sidebar')
  @endsection
@section('content')
 @include('users.layouts.mainsearch')
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
          <img src="/storage/category_images/{{$cat->cover_photo}}" alt="{{ $cat->category_name }}" height="500" width="1150">
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
               <a class="info" href="{{ route('client.show', $product->slug) }}">View Product</a>
            </div>
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$product->product_name}}</h4>
              
              <div class="buy text-info d-flex justify-content-around align-items-center">
                @if($product->best_seller == 1)
                 <h6><span><i class="fas fa-award"></i> BEST SELLER</span></h6>
                @endif
                @if($product->featured == 1)
                <h6><span><i class="fas fa-star"></i> FEATURED</span></h6>
                @endif
              </div>
              <div class="buy d-flex justify-content-around align-items-center">
                <div>
                  <span>
                    <h6 class="text-muted">Rating: {{$product->product_level}}</h6> 
                  </span>
                </div>
                <div>
                  <span>
                    @foreach($order_count as $order)
                      @if($product->id == $order->product_id)
                        <h6 class="text-muted">Orders: {{$order->total}}</h6>
                      @endif
                    @endforeach
                  </span>
                </div>               
              </div>

              <hr>
              <div class="justify-content-between align-items-center">
                <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-store"></i> {{$product->vendor->vendor_name}} </h6>
              </div>
          		
          		<div class="buy d-flex justify-content-between align-items-center">
            		<div class="price text-success">
            			<h5 class=" mt-4"><i class="fa fa-money"></i> {{number_format($product->product_price)}} FCFA</h5>
            		</div> 

             		<a href="{{ route('client.show', $product->slug) }}" class="btn mr-2 rounded-pill btn-danger"><i class="fas fa-shopping-cart"></i> Buy</a>
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
