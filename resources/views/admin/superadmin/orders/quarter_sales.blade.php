@extends('admin.layouts.master')
@section('content')
<div>
     <h1>Quarter Sales</h1>
</div>
<hr>
    <div class="row pb-3">
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h2>Total Orders <i class="fas fa-shopping-cart"></i></h2>
                    </div>
                    <div class="card-body">
                         <h3>
                              {{$totalOrders}} Orders
                         </h3>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h2>Total Sales <i class="fa fa-money"></i></h2>
                    </div>
                    <div class="card-body text-success">
                         <h3>
                              {{number_format($totalMoney)}} FCFA
                         </h3>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h2>VAT <i class="fa fa-money"></i></h2>
                    </div>
                    <div class="card-body text-success">
                         <h3>
                              {{number_format($totalVat)}} FCFA
                         </h3>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h2>Net Income <i class="fa fa-money"></i></h2>
                    </div>
                    <div class="card-body text-success">
                         <h3>
                              {{number_format($totalNetIncome)}} FCFA
                         </h3>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h2>Income <i class="fa fa-money"></i></h2>
                    </div>
                    <div class="card-body text-success">
                         <h3>
                              {{number_format($totalIncome)}} FCFA
                         </h3>
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
                    <th>Payment</th>
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
                                   @foreach($o->products as $op)
                                        <td><i class="fas fa-book"></i> {{$op->product_name}}</td>
                                        <td><i class="fa fa-money"></i> {{number_format($op->product_price * $vat)}} FCFA</td>
                                   <td><i class="far fa-calendar-alt"></i> {{$o->created_at}}</td>
                                   <td><i class="far fa-"></i> {{$o->payment_status}}</td>
                                   @if($o->is_downloaded == 1)
                                   <td><i class="fas fa-download text-success"></i> Yes</td>
                                   @else
                                   <td><i class="fas fa-download text-danger"></i> No</td>
                                   @endif
                                   <td><i class="fas fa-clock"></i> {{$o->downloaded_at}}</td>
                                        <td><i class="fas fa-store"></i> {{$op->vendor->vendor_name}}</td>
                                        <td><i class="fas fa-user"></i> {{$op->vendor->user_name}}</td>
                                   @endforeach         
                              </tr>                              
                         </tbody>                      
               @endforeach
     </table>       		
@endsection
