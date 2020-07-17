@extends('users.layouts.payments')
@section('content')
<div class="container">
	<div class="jumbotron jumbotron-fluid text-center">
	  <h1 class="display-3 bg-success text-white p-1">Thank You!</h1>
	  <p class="lead"><strong>Please check your sms</strong> for the download link or click on the download button below. This download link expires after 24 hours and can be usable only once. If you use the button to download you won't be able to use the sms link and vice-versa.</p>
	  <hr>
	  <p class="lead">
	    <a class="btn btn-primary btn-sm" href="{{$url}}" role="button">Download <i class="fas fa-download"></i></a>
	    <a class="btn btn-secondary btn-sm" href="/" role="button">Shop <i class="fas fa-shopping-cart"></i></a>
	  </p>
		<div class="card bg-dark text-white text-left m-auto">
			<div class="card-body">
				<p class="lead card-header"><strong>Payment Summary</strong></p>
				<p class="text-white"><strong>Product:</strong> {{$product->product_name}}</p>
				<p class="text-white"><strong>Price:</strong> {{number_format($product->product_price * $vat)}} FCFA</p>
				<p class="text-white"><strong>Name:</strong> {{$order->customer_name}}</p>
				<p class="text-white"><strong>Tel:</strong> {{$order->customer_tel}}</p>
				<p class="text-white"><strong>Vendor:</strong> {{$product->vendor->vendor_name}}</p>
				<p class="text-white"><strong>Status:</strong> SUCCESSFUL</p>
			</div>
		</div>
	  <p class="my-3">
	    Having trouble? <a class="mx-1" href="{{ route('contact.create') }}"><i class="fas fa-phone-alt"></i> Contact us</a>
	    Return to shop? <a class="mx-1" href="{{ route('welcome') }}"><i class="fas fa-shopping-cart"></i> Shop</a>
	  </p>
	  
	</div>
</div>

@endsection
