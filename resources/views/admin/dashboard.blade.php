@extends('admin.layouts.master')
@section('content')
	<div>
		<h5>HELLO {{Auth()->User()->name}}</h5>
		    
	</div>
@endsection
