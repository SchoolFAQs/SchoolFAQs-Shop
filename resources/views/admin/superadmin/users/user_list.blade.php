@extends('admin.layouts.master')
@section('content')
	<div>
		<a href="{{ route('user.create') }}" class="btn btn-dark">Register User</a>
	</div>
	<table class=" my-3 table table-striped table-bordered">
		
		 	<thead class="thead-dark">
		 		<tr>
		 			<th>Name</th>
		 			<th>Email</th>
		 			<th>Role</th>
		 			<th>Action</th>
		 		</tr>
		 	</thead>
		 @foreach($user as $u)
		 	<tbody>
		 		<tr>
		 			<td><i class="fas fa-user"></i> {{$u->name}}</td>
		 			<td><i class="fas fa-envelope"></i> {{$u->email}}</td>
		 			<td>
		 			@if($u->role == '1')
		 				<i class="fas fa-cog"></i> Super Admin
		 			@endif
		 			@if($u->role == '2')
		 				<i class="fas fa-user"></i> Staff
		 			@endif
		 			@if($u->role == '3')
		 				<i class="fas fa-store"></i> Vendor
		 			@endif
		 			</td>
		 			<td>
		 				<form action="{{ route('vendors.create', $u->id) }}" method="GET" class="d-inline">
			                <button class="btn btn-secondary">Create Vendor</button>
			            </form>

						@if($u->role > 1)
			 				<form action="{{ route('user.destroy', $u->id) }}" method="POST" class="d-inline">
			                  <input type="hidden" name="_method" value="DELETE">
			                  <button class="btn btn-danger">Delete</button>
			                  @csrf
			                </form>
		                @endif
		 			</td>
		 		</tr>
		 	</tbody>
		 
	 	@endforeach
	</table>
 {{$user->links()}}

	 
@endsection