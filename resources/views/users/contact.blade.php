@extends('users.layouts.master')
@section('content')
	<div class="card border-0 shadow container py-4">
		<main class="card-body card-title">
		   <h2 class="text-center">HAVE A PROBLEM?</h2>
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
		   		</div>
		   		<div class="input-group">
		   			<div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">+237</span>
					  </div>
		   			<input type="text" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="681108107" name="user_tel" class="form-control">
		   		</div>
		   		<div>
		   			<label for="name" class="col-form-label">Message</label>
		   			<textarea class="form-control" name="message" rows="4"></textarea>
		   		</div>
		   		<div class="mb-3">
	                <label for="Image">
	                    <strong><i class="fas fa-image"></i> Image:</strong>
	                </label>
	                <input type="file" class="form-control-file border-bottom" name="support_image">
	                <small class="form-text text-muted">Could be screenshots, snapshots, etc. Upload anything that can help us understand your question. You can leave this blank if it's not necessary. MAX size = 2MB (jpg,png)</small>
            	</div>
		   		<input type="submit" value="Send" class=" mt-3 btn mr-4 rounded-pill btn-primary">
		   		@csrf
		   		</form>
		   	</div>
		   </div>
		</main>
	</div>
@endsection