@extends('admin.layouts.master')
@section('content')
<div>
     <h1>Year Sales</h1>
</div>
<hr>
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
     				<h1>Total Sales <i class="fa fa-money"></i></h1>
     			</div>
     			<div class="card-body text-success">
     				<h2>
     					{{number_format($totalMon)}} FCFA
     				</h2>
     			</div>
     		</div>
     	</div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h1>Income <i class="fa fa-money"></i></h1>
                    </div>
                    <div class="card-body text-success">
                         <h2>
                              {{number_format($totalMoney)}} FCFA
                         </h2>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h1>VAT <i class="fa fa-money"></i></h1>
                    </div>
                    <div class="card-body text-success">
                         <h2>
                              {{number_format($vat_value)}} FCFA
                         </h2>
                    </div>
               </div>
          </div>
    </div>
                                        
	<table class="table table-dark">
		<thead>
			<tr>
                    <th>Customer Name</th>
                    <th>Customer Tel</th>
				<th>Product Name</th>
                    <th>Product Price</th>
				<th>Order Date</th>
                    <th>DL</th>
                    <th>AT</th>
				<th>Vendor</th>
                    <th>Owner</th>
			</tr>
		</thead>
			@foreach($order as $o)
					<tbody class="table-light text-dark">
						<tr>
                                   <td><i class="fas fa-user"></i> {{$o->customer_name}}</td>
                                   <td><i class="fas fa-phone"></i> {{$o->customer_tel}}</td>
							<td><i class="fas fa-book"></i> {{$o->product_name}}</td>
                                   <td><i class="fa fa-money"></i> {{number_format($o->product_price)}} FCFA</td>
							<td><i class="far fa-calendar-alt"></i> {{$o->created_at}}</td>
                                   @if($o->is_downloaded == 1)
                                   <td><i class="fas fa-download text-success"></i> Yes</td>
                                   @else
                                   <td><i class="fas fa-download text-danger"></i> No</td>
                                   @endif
                                   <td><i class="fas fa-clock"></i> {{$o->downloaded_at}}</td>
							@foreach($product as $p)
								@if($o->product_id == $p->id)
									<td><i class="fas fa-store"></i> {{$p->vendor->vendor_name}}</td>
                                             <td><i class="fas fa-user"></i> {{$p->vendor->user_name}}</td>
								@endif
							@endforeach	
						</tr>						
					</tbody>					
			@endforeach
	</table>		
@endsection
