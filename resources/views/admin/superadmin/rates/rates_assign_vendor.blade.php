@extends('admin.layouts.master')
@section('content')
<div class="container">
  <h1 class="text-center my-3"> ASSIGN RATE</h1>
  <form method="POST" action="{{ route('vendorrate.save') }}" class="form-group">
    <label><h5>Vendor Name</h5></label>
    <input type="text" class="form-control my-2 py-3" name="vendor_name" readonly="" value="{{$vendor->vendor_name}}">

    <label><h5>User Name</h5></label>
    <input type="text" class="form-control my-2 py-3" readonly="" name="user_name" value="{{$vendor->user_name}}">
    <input type="hidden" value="{{$vendor->id}}" name="vendor_id">

      <select id="rate" class="form-control" name="rate_id" required autocomplete="rate">
        @foreach($rates as $rate)
          <option value="{{$rate->id}}">{{$rate->rate_name}} - {{$rate->rate_value * 100}}%</option>
        @endforeach                                                 
      </select>   
      <input type="submit" class="btn btn-dark my-2">
    @csrf   
  </form>
</div>
@endsection 