@extends('admin.layouts.master')
@section('content')
  <h1>Rates Center</h1>
  <a href="{{ route('rates.create') }}" class="btn my-2 btn-dark">CREATE RATE</a>

  <table class="table table-dark">
    <thead>
      <tr>
        <th>Rate Name</th>
        <th>Rate Type</th>
        <th>Rate Value</th>
        <th>Expiry Date</th>
        <th>Created By</th>
        <th>Action</th>
      </tr>
    </thead>
      @foreach($rates as $rate)
          <tbody class="table-light text-dark">
            <tr>
             <td>{{$rate->rate_name}}</td>
             <td>
              @if($rate->rate_type == 1)
                  Fixed
              @else
                  Commision
              @endif
            </td>              
             <td>
              @if($rate->rate_type == 1)
              {{$rate->rate_value}}
              @else
              {{$rate->rate_value}}%
              @endif
            </td>                   
             <td>{{$rate->expiry_date}}</td>                                  
             <td>{{$rate->admin_name}}</td>
             <td>
               <div class="d-flex justify-content-around align-items-center">
                <a href="{{ route('rates.edit', $rate->id) }}" class="btn btn-dark mt-2 text-light"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('rates.destroy', $rate->id) }}" method="POST" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button class="btn btn-danger">Delete</button>
                  @csrf
                </form>
              </div>
             </td>
            </tr>           
          </tbody>          
      @endforeach
  </table>    
{{$rates->links()}}

@endsection
