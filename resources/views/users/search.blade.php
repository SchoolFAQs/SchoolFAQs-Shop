@extends('users.layouts.master') 
  @section('sidebar')
    @include('users.layouts.sidebar')
  @endsection
@section('content')
 @include('users.layouts.mainsearch')
<div class="container">
  <div class="mt-4">
    <h1 class="lead">Showing search results for "<strong>{{$search}}</strong>"</h1>
  </div>
    <div class="row">
      @foreach($productSearch as $product)
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
                  <h6 class="card-subtitle text-info m-2">
                    @if($product->best_seller == 1)
                     <span><i class="fas fa-award"></i> BEST SELLER</span>
                    @endif
                    @if($product->featured == 1)
                    <span><i class="fas fa-star"></i> FEATURED</span>
                    @endif
                  </h6>

                <div class="buy d-flex justify-content-around align-items-center">
                <div>
                  <span>
                    <h6 class="text-muted">{{$product->product_level}}</h6> 
                  </span>
                </div>
                <div>
                  <span>
                    @foreach($order_count as $order)
                      @if($product->id == $order->product_id)
                        @if($product->product_price != 0)
                          <h6 class="text-muted">Orders: {{$order->total}}</h6>
                          @endif
                        @if($product->product_price == 0)
                          <h6 class="text-muted">Downloads: {{$order->total}}</h6>
                        @endif
                      @endif
                    @endforeach
                  </span>
                </div>               
              </div>

                <hr>
                <div class="justify-content-between align-items-center">
                  <small class="card-subtitle mb-2 text-muted">sold by: <h6><i class="fas fa-store"></i> {{$product->vendor->vendor_name}}</h6> </small>
                </div>
                
                <div class="buy d-flex justify-content-between align-items-center">
                  <div class="price text-success">
                    <h5 class=" mt-4"><i class="fa fa-money"></i> {{number_format($product->product_price * $vat)}} FCFA</h5>
                  </div> 

                  <a href="{{ route('client.show', $product->slug) }}" class="btn btn-danger mt-3 text-light"><i class="fas fa-shopping-cart"></i> Buy</a>
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
  </div>
</div>


@endsection
