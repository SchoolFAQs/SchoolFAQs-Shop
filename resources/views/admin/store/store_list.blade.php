@extends('admin.layouts.master')
@section('content')
  <div class="h1">
      Shops
  </div> 
  <hr>
<div class="container">
	<div class="row">

    
  	@foreach($stores as $store)
    @if($store->vendor_email == Auth()->User()->email)
    <div class="col-12 col-lg-4">
    	<div class="card my-3 mx-3 shadow rounded-left">
    		<div class="embed-responsive embed-responsive-4by3 hovereffect">
        		<img class="card-img embed-responsive-item" src="/storage/vendor_images/{{$store->vendor_image}}" alt="{{$store->vendor_image}}">
        	</div>
        	<div class="card-body">
          		<h4 class="card-title text-center text-uppercase">{{$store->vendor_name}}</h4>
          		<p class="card-text">{{$store->vendor_about}}</p>
              <hr>          		
          		<div class="d-flex justify-content-between align-items-center">
          			<a href="{{ route('store.show', $store->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-eye"></i> View Shop</a>
          		</div>
        	</div>
      	</div>  
    </div>
    @endif
    @endforeach   
  </div>
  {{$stores->links()}}
</div>
@endsection