@extends('admin.layouts.master')
@section('content')
	<h1>APPLICATIONS</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>D.O.B</th>
				<th>Telephone</th>
				<th>Decision</th>
				<th>By</th>
				<th>On</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach($applications as $application)
		<tbody>
			<tr>

				<td>
					@if($application->solve_date == NULL)
					<span>{{$application->user_name}}</span>
					@endif

					@if($application->is_approve == 1)
					<span class="badge badge-success">Approved</span> {{$application->user_name}} 
					@endif

					@if($application->is_reject == 1)
					<span class="badge badge-danger">Rejected</span> {{$application->user_name}}
					@endif

				</td>
				<td>{{$application->user_email}}</td>
				<td>{{$application->date_of_birth}}</td>
				<td>{{$application->user_tel}}</td>
				<td>

					@if($application->is_approve == 1)
					Approved
					@endif

					@if($application->is_reject == 1)
					Rejected
					@endif

				</td>
				<td>{{$application->admin_name}}</td>
				<td>{{$application->solve_date}}</td>
				<td>
					<a href="{{ route('applications.show', $application->id) }}" class="btn btn-dark"><i class="fas fa-eye"></i> View</a>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
{{$applications->links()}}
@endsection