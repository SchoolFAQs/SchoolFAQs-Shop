@extends('users.layouts.payments')
@section('content')
<div class="container">
	<div class="jumbotron jumbotron-fluid text-center ">
	  <h1 class="display-4 text-white bg-secondary">Approve Payment</h1>
	  <p>Dail *126# to approve the transaction. You have 120s</p>
	  <small>After confirming the transaction, click on the button below to verify payment.</small>
	  <div  class="py-2">
	  	<form action="{{ route('client.payment') }}" method="GET">
	  		<input type="hidden" name="transactionID" value="{{$ref}}">
	  		<input type="submit" class="btn btn-info" value="Verify">
	  	</form>
	  </div>
		<img src="{{ asset('loading.gif') }}" alt="">
	</div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		function autoRefresh(){
			window.location = window.location.href;
			 	}
			 	 setInterval('autoRefresh()', 100);
	</script> 
@endsection
