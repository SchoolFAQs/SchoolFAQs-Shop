@extends('admin.layouts.master')
@section('content')
<h1>Vendor Withdrawal Request</h1>
<table class="table table-dark">
  <thead>
    <tr>
      <th>Vendor Email</th>
      <th>Vendor Number</th>
      <th>Withdraw Amount</th>
      <th>Account Balacne</th>
      <th>Withdraw Date</th>
      <th>Withdraw Status</th>
      <th>Action</th>
    </tr>
  </thead>
  @foreach($withdraw_request as $wr)
    <tbody class="table-light text-dark">
      <tr>
        <td>{{$wr->user_email}}</td>
        <td>{{$wr->user_number}}</td>
        <td>{{$wr->withdraw_amount}}</td>
        <td>{{$wr->balance}}</td>
        <td>{{$wr->withdraw_date}}</td>
        <td>{{$wr->withdraw_status}}</td>
        <td>
           <div class="d-flex justify-content-between align-items-center">
                <div class="mx-1">
                <form action="{{ route('withdraw.approve', $wr->id) }}" method="POST">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="action" value="approve">
                  <input type="submit" class="btn btn-info" value="Approve">
                  @csrf
                </form>
              </div>
              <div class="mx-1">
                <form action="{{ route('withdraw.reject', $wr->id) }}" method="POST">
                  <input type="hidden" name="action" value="reject" id="">
                  <input type="hidden" name="_method" value="PUT">
                  <input type="submit" class="btn btn-danger" value="Reject">
                  @csrf
                </form>      
          </div>
        </td>
      </tr>
    </tbody>
  @endforeach
</table>
@endsection
