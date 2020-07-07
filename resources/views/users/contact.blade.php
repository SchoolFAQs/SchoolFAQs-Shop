@extends('users.layouts.master')
@section('content')
	<div class="card border-0 shadow container py-4">
		<main class="card-body card-title">
		   <h1 class="display-4 text-center">HAVE A PROBLEM?</h1>
		   <p class="lead text-center text-muted">Send us a message below.</p>
		   <div class="card">
		   	<div class="card-header">
		   		<h4>Contact Form</h4>
		   	</div>
		   	<div class="card-body">
		   		<form action="{{ route('contact.store') }}" method="POST">
		   			<div>
		   			<label for="user_name" class="col-form-label">Name</label>
		   			<input type="text" name="user_name" class="form-control">
		   		</div>
		   		<div>
		   			<label for="tel" class="col-form-label">Phone Number</label>
		   			<input type="text" name="user_tel" class="form-control">
		   		</div>
		   		<div>
		   			<label for="name" class="col-form-label">Message</label>
		   			<textarea class="form-control" name="message" rows="4"></textarea>
		   		</div>
		   		<input type="submit" value="Send" class=" mt-3 btn mr-4 rounded-pill btn-primary">
		   		@csrf
		   		</form>
		   	</div>
		   </div>
		</main>
	</div>
@endsection