@extends('admin.layouts.master')
@section('content')
	<a href="{{ route('user.index') }}" class="btn btn-dark">Create Vendor</a>
<hr>
  	<table class="table table-dark">
    <thead>
      <tr>
        <th>Vendor Name</th>
        <th>Owner</th>
        <th>Email</th>
        <th>Telehone</th>
        <th>Date Created</th>
        <th>Created By</th>
        <th>Action</th>
      </tr>
    </thead>
          @foreach($vendors as $vendor)
          <tbody class="table-light text-dark">
            <tr>
              <td><i class="fas fa-store"></i> {{$vendor->vendor_name}}</td>
              <td><i class="fas fa-user"></i> {{$vendor->user_name}}</td>
              <td><i class="fas fa-envelope"></i> {{$vendor->vendor_email}}</td>
              <td><i class="fas fa-phone"></i> {{$vendor->vendor_tel}}</td>
              <td><i class="fas fa-calendar-day"></i> {{$vendor->created_at}}</td>
              <td><i class="fas fa-users"></i> {{$vendor->admin_name}}</td>
              <td><div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('adminvendors.edit', $vendor->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('adminvendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger">Delete</button>
                  @csrf
                </form>
              </div></td>
            </tr>           
          </tbody>
          @endforeach          
  </table>
  
{{$vendors->links()}}
@endsection
