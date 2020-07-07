@extends('admin.layouts.master')
@section('content')
<h1>SMS CENTER</h1>
<div class="row pb-3">
     	<div class="col col-lg col-sm-2">
     		<div class="card">
     			<div class="card-header">
     				<h3>SMS Units Left <i class="fas fa-envelope"></i></h3>
     			</div>
     			<div class="card-body">
     				<h4>
     					{{$sms_units}} SMS Left
     				</h4>
     				<p>{{$description}}</p>
     			</div>
     		</div>
     	</div>
     	<div class="col col-lg col-sm-2">
     		<div class="card">
     			<div class="card-header">
     				<h3>Total SMS Sent <i class="fa fa-envelope"></i></h3>
     			</div>
     			<div class="card-body">
     				<h4>
     					{{number_format($message_count)}} Messages
     				</h4>
     			</div>
     		</div>
     	</div>
          <div class="col col-lg col-sm-2">
               <div class="card">
                    <div class="card-header">
                         <h3>ADMIN SMS USAGE <i class="fa fa-envelope"></i></h3>
                    </div>
                    <div class="card-body">
                         <table class="table">
                              <thead>
                                   <tr>
                                        <th>Name</th>
                                        <th>Count</th>
                                   </tr>
                              </thead>
                              @foreach($admin_usage_count as $ac)
                              <tbody>
                                   <tr>
                                        <td>
                                             @if($ac->admin_id == Auth()->User()->id)
                                                  {{Auth()->User()->name}}
                                             @endif
                                             @if($ac->admin_id == 'System')
                                                  {{$ac->admin_id}}
                                             @endif
                                             @if($ac->admin_id != '1' && $ac->admin_id != 'System')
                                                  <?php
                                                       $user = \App\User::find($ac->admin_id);
                                                  ?>
                                                       {{ $user->name }}
                                             @endif
                                        </td>
                                        <td>{{$ac->total}}</td>
                                   </tr>
                              </tbody>
                              @endforeach
                         </table>                                                                                            

                    </div>
               </div>
          </div>
     </div>

     <table class="table">
     	<thead>
     		<tr>
     			<th>Admin</th>
     			<th>Type</th>
     			<th>Purpose</th>
     			<th>Customer Name</th>
     			<th>Date</th>
     			<th>Action</th>
     		</tr>
     	</thead>
     	@foreach($messages as $message)
     	<tbody>
     		<tr>
     			<td>
     			@if($message->admin_id == Auth()->User()->id)
     				{{Auth()->User()->name}}
     			@endif
     			@if($message->admin_id != Auth()->User()->id)
     				{{$message->admin_id}}
     			@endif
     			</td>
     			<td>{{$message->message_type}}</td>
     			<td>{{$message->message_purpose}}</td>
     			<td>{{$message->customer_name}}</td>
     			<td>{{$message->created_at}}</td>
     			<td><a href="{{ route('sms.show', $message->id) }}" class="btn btn-dark"><i class="fas fa-eye"></i> View</a></td>
     		</tr>
     	</tbody>
     	@endforeach
     </table>
     {{$messages->links()}}
@endsection