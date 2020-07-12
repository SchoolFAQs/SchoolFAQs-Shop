@extends('admin.layouts.master')
@section('content')
    <div class="row pb-3">
     	<div class="col col-lg col-sm-2">
     		<div class="card">
     			<div class="card-header">
     				<h1>Total Orders <i class="fas fa-shopping-cart"></i></h1>
     			</div>
     			<div class="card-body">
     				<h2>
     					{{$totalOrders}} Orders
     				</h2>
     			</div>
     		</div>
     	</div>
     	<div class="col col-lg col-sm-2">
     		<div class="card">
     			<div class="card-header">
     				<h1>Total Income <i class="fa fa-money"></i></h1>
     			</div>
     			<div class="card-body text-success">
     				<h2>
     					{{number_format($totalMoney)}} FCFA
     				</h2>
     			</div>
     		</div>
     	</div>
    
    </div>
                        
                   
 
	<table class="table table-dark">
		<thead>
			<tr>
				<th>Product Name</th>
                    <th>Product Price</th>
				<th>Order Date</th>
				<th>Shop</th>
			</tr>
		</thead>
			@foreach($order as $o)
				@if(Auth()->User()->email == $o->vendor_email)
					<tbody class="table-light text-dark">
						<tr>
							<td><i class="fas fa-book"></i> {{$o->product_name}}</td>
                                   <td><i class="fas fa-money-bill"></i> {{number_format($o->product_price)}} FCFA</td>
							<td><i class="far fa-calender"></i> {{$o->created_at}}</td>
							@foreach($product as $p)
								@if($o->product_id == $p->id)
									<td><i class="fas fa-store"></i> {{$p->vendor->vendor_name}}</td>
								@endif
							@endforeach	
						</tr>						
					</tbody>
				@endif					
			@endforeach
	</table>		
{{$order->links()}}
@endsection
