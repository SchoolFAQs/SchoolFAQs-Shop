@extends('users.layouts.master')
@section('content')
	<div class="jumbotron jumbotron-fluid container">
		<h1 class="lead dislay-2 text-success">APPLICATION RECEIVED</h1>
		<div class="card shadow">
			<div class="card-header">
			APPLICATION
			</div>
			<div class="card-body">
				Your application has been received and it is being reviewed by our team. You will be contacted via the email/phone number you provided. For the mean time, have a look at our shop.
			</div>
		</div>
		<a href="{{ route('welcome') }}" class="btn my-3 rounded-pill btn-primary">Shop</a>
	</div>
@endsection