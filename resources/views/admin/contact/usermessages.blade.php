@extends('admin.layouts.master')
@section('content')
<h1>MESSAGE CENTER</h1>
<h6 class="text-muted">Total: {{$message_count}} <i class="fas fa-envelope"></i></h6>
<h6 class="text-muted">My Usage: {{$admin_sms_count}} Messages Sent.</h6>
<table class="table">
	<thead>
		<tr>
			<th><i class="fas fa-ticket-alt"></i> Ticket</th>
			<th><i class="fas fa-envelope"></i> Message</th>
			<th><i class="fas fa-calendar-day"></i> Date</th>
			<th>Admin</th>
			<th>On</th>
			<th>Action</th>
		</tr>
	</thead>
	@foreach($messages as $message)
		<tbody>
			<tr>
				@if($message->is_solved == 1)
				<td><span class="badge badge-success">SOLVED</span> {{$message->ticket_id}}</td>
				@else
				<td>{{$message->ticket_id}}</td>
				@endif
				<td> {{Str::limit($message->message, $limit = 30, $end = '...')}}</td>
				<td>{{$message->created_at}}</td>
				<td>{{$message->admin_name}}</td>
				<td>{{$message->solve_date}}</td>
				<td><div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('adminmessage.show', $message->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-eye"></i> View</a>
              </div>
          </td>
			</tr>
		</tbody>
	@endforeach
</table>



@endsection