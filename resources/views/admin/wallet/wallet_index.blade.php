@extends('admin.layouts.master')
@section('content')
	<div>
		<h1>MY WALLET</h1>
		<div class="row pb-3">
     	<div class="col col-lg col-sm-2">
     		<div class="card">
     			<div class="card-header">
     				<h4>Account Balance <i class="fas fa-money-bill"></i></h4>
     			</div>
     			<div class="card-body">
     				@if(empty($my_balance))
					    <h5 class="text-success">
					    	{{number_format($myBalance)}} FCFA
	     				</h5>
     				@else
						<h5 class="text-success">
							{{number_format($my_balance->balance)}} FCFA
						</h5>
					@endif										
     			</div>
     		</div>
     	</div>
     </div>
     <div class="my-2">
     	<a href="" data-toggle="modal" data-target="#Withdraw" class="btn btn-primary">Cash out</a>
     </div>
		<table class="table table-dark">
			<thead>
				<tr>
					<th>Name</th>
					<th>Telephone</th>
					<th>Account Balance</th>
					<th>Withdrawal Amount</th>
					<th>Withdrawal Date</th>
					<th>Withdrawal Status</th>
				</tr>
			</thead>
			@foreach($my_wallet as $mw)
			<tbody class="table-light text-dark">
				<tr>
					<td>{{$mw->user_email}}</td>
					<td>{{$mw->user_number}}</td>
					<td>{{number_format($mw->balance)}}</td>
					<td>{{number_format($mw->withdraw_amount)}}</td>
					<td>{{$mw->withdraw_date}}</td>
					<td>{{$mw->withdraw_status}}</td>
				</tr>
			</tbody>
			@endforeach
		</table>   
	</div>

	<!-- Withdraw Modal -->
<div class="modal fade" id="Withdraw" tabindex="-1" role="dialog" aria-labelledby="WithdrawTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="WithdrawTitle">Withdraw</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('vendorrequest.wallet') }}" method="POST">
	        	<input type="text" readonly="" class="form-control my-1" name="user_name" value="{{Auth()->User()->name}}">
	        	<div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">+237</span>
                </div>
	        	<input type="text" class="form-control my-1" name="withdraw_number" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="eg: 681108107">
	        	</div>
	        	<div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Amount</span>
                </div>
	        	<input type="text" class="form-control my-1" name="amount" placeholder="e.g 100">
	        	</div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-primary" value="Withdraw">
	        @csrf
        </form>
      </div>
    </div>
  </div>
</div>
@endsection