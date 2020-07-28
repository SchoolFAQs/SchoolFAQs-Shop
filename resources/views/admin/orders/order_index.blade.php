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
     				<h2 id="tot_mon">
                        {{number_format($totalIncome)}} FCFA
                    </h2>
     			</div>
     		</div>
     	</div>
    </div>
                        
                   
 
	<table id="ord" class="table table-dark">
		<thead>
			<tr>
				<th>Product Name</th>
                    <th>Total Price (FCFA)</th>
                    <th>NET Price (FCFA)</th>
                    <th>VAT (FCFA)</th>
                    <th>Income</th>
				<th>Order Date</th>
				<th>Shop</th>
                    <th>RATE</th>
			</tr>
		</thead>
			@foreach($orders as $order)
				@if(Auth()->User()->email == $order->vendor_email)
					<tbody class="table-light text-dark">
                        <tr>
                            @foreach($order->products as $op)
                                <td><i class="fas fa-book"></i> {{$op->product_name}}</td>
                                <td><i class="fas fa-money-bill"></i> {{number_format($op->product_price * $vat)}}</td>
                                <td><i class="fas fa-money-bill"></i> {{number_format($vat*$op->product_price/$vat)}}</td>
                                <td><i class="fas fa-money-bill"></i> {{number_format($op->product_price*$vat - $vat*$op->product_price/$vat)}}</td>
                                

                                @if($order->product_id == $op->id)
                                    <td class="my_income">{{number_format($vat*$op->product_price/$vat * (1-$op->vendor->rate))}}</td>
                                @endif

                                <td><i class="far fa-calender"></i> {{$order->created_at}}</td>

                                @if($order->product_id == $op->id)
                                    <td><i class="fas fa-store"></i> {{$op->vendor->vendor_name}}</td>
                                    <td>{{$op->vendor->rate * 100}}%</td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                @endif
            @endforeach
    </table>		
{{ $orders->links() }}
    <script language="javascript" type="text/javascript">
         /*   var tds = document.getElementById('ord').getElementsByTagName('td');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'my_income') {
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById('tot_mon').innerHTML += sum;
     </script>
@endsection
