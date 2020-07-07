@extends('admin.layouts.master')
@section('content')
	<div><h1>USER LIST</h1></div>
	<p class="text-muted"><i class="fas fa-users"></i> Total: {{$user_total}}</p>
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
						@if($u->role == NULL || $u->role > 1)
							<form action="{{ route('user.edit', $u->id) }}" method="GET" class="d-inline">
				                <button class="btn btn-info">Assign Role</button>
				            </form>

							<form action="{{ route('vendors.create', $u->id) }}" method="GET" class="d-inline">
			                	<button class="btn btn-secondary">Create Vendor</button>
			            	</form>

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