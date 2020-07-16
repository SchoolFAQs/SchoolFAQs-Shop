@extends('users.layouts.master')
@section('content')
	<div class="jumbotron container">
		<h1 class="lead dislay-2 text-success">MESSAGE RECEIVED</h1>
		<div class="card shadow">
			<div class="card-header">
				<h6>{{$ticket}}</h6>
			</div>
			<div class="card-body">
				Hello <strong>{{$user_name}}</strong>. Your message has been received and it is being reviewed by our team. We'll get to you soon. For the meantime, this is the message we have received:
				<div class="lead card p-3">
					<h4>"{{$message}}"</h4>
				</div>
				@if($image != 'noimage.jpg')
				<div>
					<img class="img-thumbnail" src="/storage/contact/{{$image}}" alt="Supporting Image">
				</div>
				@endif
			</div>
		</div>
		<a href="{{ route('welcome') }}" class="btn my-3 rounded-pill btn-primary">Go Back</a>
		
	</div>
@endsection