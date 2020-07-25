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
          <img class="d-block w-100" src="/storage/category_images/{{$cat->cover_photo}}" alt="{{ $cat->category_name }}">
          <div class="black-overlay"></div>
          <div class="carousel-caption">
              <h6 class="text-light p-1 rounded text-left">{{ $cat->category_name }}</h6>
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

  <div class="mt-3 row">
    @foreach($products as $product)
    <div class="col-12 col-lg-4">
      <hr>
      <div class="card border-0">
          <div class="card-header bg-transparent border-0">
            <div class="d-flex justify-content-start align-items-start">
                @if($product->best_seller == 1)
                 <h6><span class="badge badge-pills badge-info"><i class="fas fa-award"></i> BEST SELLER</span></h6>
                @endif
                @if($product->featured == 1)
                <h6><span class="badge badge-pill badge-secondary"><i class="fas fa-star"></i> FEATURED</span></h6>
                @endif
            </div>
          </div>
        <div class="row no-gutters">
          <div class="col-4">
            <div class="hovereffect product">
              <img class="card-img" src="/storage/product_images/{{$product->product_image}}" alt=""> 
                <div class="overlay">
                   <h2>{{$product->product_name}}</h2>
                   <a class="info" href="{{ route('client.show', $product->slug) }}">View Product</a>
                </div>
            </div>  
          </div>
          <div class="col">
            <div class="card-block px-2">
              <h4 class="card-title">{{$product->product_name}}</h4>
              <p class="card-text">{{$product->product_level}}</p>
              <div class="price">
                  <h5 class="text-success"><i class="fa fa-money"></i> {{number_format($product->product_price * $vat)}} FCFA <sub class="text-muted"><del>{{number_format($product->product_price * $vat * 2)}} FCFA</del></sub></h5>
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
          </div>
        </div>
        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center w-100 text-muted">
          <div>
            <small class="card-subtitle mb-2 text-muted">sold by: <h6><i class="fas fa-store"></i> {{$product->vendor->vendor_name}}</h6> </small>
          </div>
          <div>
            <span>
              <a href="{{ route('client.show', $product->slug) }}" class="btn my-2 float-right rounded-pill btn-danger"><i class="fas fa-shopping-cart"></i> Buy</a>
            </span>
          </div>
        </div>
    </div>
  </div>
    @endforeach   
  </div>
  {{$products->links()}}
</div>
@endsection
