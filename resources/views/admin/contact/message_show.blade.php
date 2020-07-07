@extends('admin.layouts.master')
@section('content')
	<div class="card">
		<div class="card-header">{{$message->ticket_id}}</div>
		<div class="card-body">
			<p class="card-text">
				{{$message->message}}
			</p>
		</div>
	</div>
	@if($message->is_solved == null)
	<div class="d-flex flex-row mt-3">
		<div class="mx-1">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendMessage">
		  		<i class="fas fa-envelope"></i> Send Message
			</button>
		</div>
		<div class="mx-1">
			<form action="{{ route('adminmessage.update', $message->id) }}" method="POST">
				<input type="hidden" name="admin_name" value="{{Auth()->User()->name}}">
				<input type="submit" class="btn btn-info" value="&#xf00c; Mark as Solved">
				<input type="hidden" name="_method" value="PUT">
				@csrf
			</form>
		</div>
		<div class="mx-1">
			<a href="{{ route('adminmessage.index') }}" class="btn rounded-pill btn-dark">Go Back</a>
		</div>
	</div>
	@else
	<h3 class="badge p-3 badge-success">This was already solved by {{$message->admin_name}}.</h3>
	<a href="{{ route('adminmessage.index') }}" class="btn my-3 rounded-pill btn-dark">Go Back</a>
	@endif
	
	<!-- Modal -->
	<div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessageTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="sendMessageTitle">Send SMS to Customer</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="{{ route('admin.sendmessage') }}" method="POST">
	        	<textarea name="message" id="message" class="form-control" rows="10" placeholder="Type message here. Be polite and straight to the point."></textarea>
	        	<input type="hidden" name="user_name" value="{{$message->user_name}}">
	        	<input type="hidden" name="user_tel" value="{{$message->user_tel}}">
	        	<input type="hidden" name="user_ticket" value="{{$message->ticket_id}}">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <input type="submit" class="btn btn-primary" value="Send SMS">
	        @csrf
        	</form>
	      </div>
	    </div>
	  </div>
	</div>
@endsection