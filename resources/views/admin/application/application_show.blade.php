@extends('admin.layouts.master')
@section('content')
	<h1>APPLICATION VIEW</h1>

	<div class="card">
		<div class="card-header">
			{{$application->user_name}}
		</div>	
			<div class="card-body">
				<h4>NAME:</h4>
				<p>{{$application->user_name}}</p>
				<h4>EMAIL:</h4>
				<p>{{$application->user_email}}</p>
				<h4>TELEPHONE:</h4> 
				<p>{{$application->user_tel}}</p>
				<h4>D.O.B</h4>
				<p>{{$application->date_of_birth}}</p>
				<div class="card-footer">
					<div class="d-flex flex-row mt-3">
						<div class="mx-1">
							<a href="{{ route('applications.idcard', $application->id) }}" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i> View ID CARD</a>
						</div>
						<div class="mx-1">
							@if($application->license != NULL)
							<a href="{{ route('applications.license', $application->id) }}" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i> View License</a>
							@endif
						</div>
						{{--<div class="mx-1">
							<a href="{{ route('applications.kyc', $application->id) }}" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i> View KYC FORM</a>
						</div>--}}
					<div class="mx-1">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendMessage">
					  		<i class="fas fa-envelope"></i> Send Message
						</button>
					</div>
				</div>
			</div>	
	</div>

	<div class="d-flex flex-row my-3">
		@if($application->solve_date != NULL)
		<div class="mx-1">
			<span class="badge badge-success p-2">Processed by {{$application->admin_name}}</span> <a href="{{ route('applications.index') }}" class="btn btn-dark">Go Back</a>
		</div>
		@endif
		@if($application->solve_date == NULL)
		<div class="mx-1">
			<a href="{{ route('applications.index') }}" class="btn btn-dark">Go Back</a>
		</div>
		<div class="mx-1">
			<form action="{{ route('applications.approve', $application->id) }}" method="POST">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="action" value="approve">
				<input type="submit" class="btn btn-info" value="Approve">
				@csrf
			</form>
		</div>
		<div class="mx-1">
			<form action="{{ route('applications.reject', $application->id) }}" method="POST">
				<input type="hidden" name="action" value="reject" id="">
				<input type="hidden" name="_method" value="PUT">
				<input type="submit" class="btn btn-danger" value="Reject">
				@csrf
			</form>
		</div>
		@endif
	</div>

	
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
	        	<input type="hidden" name="user_name" value="{{$application->user_name}}">
	        	<input type="hidden" name="user_tel" value="{{$application->user_tel}}">
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