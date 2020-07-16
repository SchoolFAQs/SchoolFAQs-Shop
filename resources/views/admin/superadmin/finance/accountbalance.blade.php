@extends('admin.layouts.master')
@section('content')
     <div class="row pb-3">
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h3>Collections Account Balance <i class="fas fa-money-bill"></i></h3>
                    </div>
                    <div class="card-body">
                         <h4>
                              {{number_format($amount)}} FCFA
                         </h4>
                    </div>
               </div>
          </div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h3>Disbursement Account Balance <i class="fas fa-money-bill"></i></h3>
                    </div>
                    <div class="card-body">
                         <h4>
                              # FCFA
                         </h4>
                    </div>
               </div>
          </div>
     </div>
@endsection