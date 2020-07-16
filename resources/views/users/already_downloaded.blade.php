@extends('users.layouts.payments')
@section('content')
<div class="container">
	<div class="jumbotron text-center ">
	  <h1 class="p-1 display-4 text-white bg-info">ALREADY DOWNLOADED!</h1>
	  <p class="lead"><strong>Dear {{$order->customer_name}}, this product has been downloaded already.<br>
	  According to our systems, you downloaded this product on the <strong>{{$order->downloaded_at}}</strong>. However, if you had problems with your download please do not hesitate to contact us with your name, phone number, the screenshot of the failed download, the date of the transaction and the name of the product. We will address the problem immediately and take necessary actions.</strong> </p>
	  <hr>
		<div class="card bg-dark text-white text-left m-auto">
			<div class="card-body">
				<p class="lead card-header"><strong>Product Summary</strong></p>
				<p class="text-white"><strong>Product:</strong> {{$order->product_name}}</p>
				<p class="text-white"><strong>Price:</strong> {{number_format($order->product_price)}} FCFA</p>
				<p class="text-white"><strong>Name:</strong> {{$order->customer_name}}</p>
				<p class="text-white"><strong>Tel:</strong> {{$order->customer_tel}}</p>
			</div>
		</div>
	  <p class="my-3">
	    Having trouble? <a class="mx-1" href="{{ route('contact.create') }}"><i class="fas fa-phone-alt"></i> Contact us</a>
	    Return to shop? <a class="mx-1" href="{{ route('welcome') }}"><i class="fas fa-shopping-cart"></i> Shop</a>
	  </p>
	  
	</div>
</div>

@endsection
