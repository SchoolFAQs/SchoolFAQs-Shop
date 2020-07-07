@extends('admin.layouts.master')
@section('content')
				<h4>ADMIN</h4>
				<p>
					@if($message->admin_id == Auth()->User()->id)
     				{{Auth()->User()->name}}
	     			@endif
	     			@if($message->admin_id != Auth()->User()->id)
	     				{{$message->admin_id}}
	     			@endif
				</p>
				<h4>MESSAGE TYPE:</h4>
				<p>{{$message->message_type}}</p>
				<h4>MESSAGE PURPOSE:</h4>
				<p>{{$message->message_purpose}}</p>
				<h4>MESSAGE:</h4> 
				<p>{{$message->message}}</p>
				<h4>CUSTOMER NAME:</h4>
				<p>{{$message->customer_name}}</p>
				<h4>CUSTOMER TEL:</h4>
				<p>{{$message->customer_tel}}</p>
				<h4>Date</h4>
				<p>{{$message->created_at}}</p>
		<a href="{{ route('sms.index') }}" class="btn btn-dark">Go Back</a>

@endsection