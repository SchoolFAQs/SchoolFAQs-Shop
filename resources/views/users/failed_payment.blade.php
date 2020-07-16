@extends('users.layouts.payments')
@section('content')
<div class="container">
	<div class="jumbotron text-center ">
	  <h1 class="display-3 text-white bg-danger">Payment Error!</h1>
	  <p class="lead"><strong>Dear {{$order->customer_name}}, the payment was unsuccesful. This could be due to a number of reasons. Please check below for the status of the transaction. <br>
	  However, if you notice that the transaction went through and money was deducted from your account, please do not hesitate to contact us with the 'Status' given below, your name, phone number, the date of the transaction and the name of the product. We will address the problem immediately and take the necessary actions.</strong> </p>
	  <hr>
		<div class="card bg-dark text-white text-left m-auto">
			<div class="card-body">
				<p class="lead card-header"><strong>Payment Summary</strong></p>
				<p class="text-white"><strong>Product:</strong> {{$order->product_name}}</p>
				<p class="text-white"><strong>Price:</strong> {{number_format($order->product_price)}} FCFA</p>
				<p class="text-white"><strong>Name:</strong> {{$order->customer_name}}</p>
				<p class="text-white"><strong>Tel:</strong> {{$order->customer_tel}}</p>
				<p class="text-white"><strong>Status:</strong> {{$failReason}}</p>
			</div>
		</div>
	  <p class="my-3">
	    Having trouble? <a href="{{ route('contact.create') }}">Contact us</a>
	  </p>
	  
	</div>
</div>

@endsection