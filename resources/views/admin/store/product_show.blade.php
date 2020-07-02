@extends('admin.layouts.master')
@section('content')
  <div class="container">
    <a href="{{ route('store.index') }}" class="btn btn-dark">Go Back</a>
    <div class="row">
      <div class="my-3 col img-thumbnail">
        <div class="card-body">
            <h4 class="card-title text-center text-capitalize">{{$product->product_name}}</h4>
            <p class="card-text text-justify text-body">{{$product->product_description}}</p>
            <h6 class="mt-4 text-success">PRICE: <i class="fa fa-money"></i>  {{number_format($product->product_price)}} FCFA</h6>
            <h6 class="badge">Tags:</h6>
            @foreach($product->categories as $cat)
              <span class="badge text-muted">{{$cat->category_name}}</span>
            @endforeach
        </div>
      </div>

    <div class="my-3 col">
      <div class="card shadow rounded">
        <div>
          <img class="card-img img-thumbnail" src="/storage/product_images/{{$product->product_image}}" alt="{{$product->product_name}}">
        </div>           
      </div>
    </div>
  </div>
@endsection