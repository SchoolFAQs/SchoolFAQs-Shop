@extends('admin.layouts.master')
@section('content')
	<h1>MY PROFILE</h1>
	<label for="name">Name</label>
	<input type="text" class="form-control" disabled="" value="{{$profile->name}}">

	<label for="email">Email</label>
	<input type="text" class="form-control" disabled="" value="{{$profile->email}}">

	<label for="email">Role</label>
	@if($profile->role == 1)
		<input type="text" class="form-control" disabled="" value="SUPER ADMIN">
	@endif

	@if($profile->role == 2)
		<input type="text" class="form-control" disabled="" value="STAFF">
	@endif

	@if($profile->role == 3)
		<input type="text" class="form-control" disabled="" value="VENDOR">
	@endif

<a href="{{ route('admin.dashboard') }}" class="btn mt-3 btn-dark">Go Back</a>
@endsection