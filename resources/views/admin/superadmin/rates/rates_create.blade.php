@extends('admin.layouts.master')
@section('content')
	<div class="container">
		<h1 class="text-center">Create Rate</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rates.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Rate Name') }}</label>
                            <div class="col-md-6">
                                <input id="rate_name" type="text" class="form-control" name="rate_name">            
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Rate Type') }}</label>

                            <div class="col-md-6">
                                <select id="rate_type" class="form-control @error('rate_type') is-invalid @enderror" name="rate_type" required autocomplete="role">
                                	<option value="1">Fixed</option>
                                	<option value="2">Commision</option>                                              
                                </select>    

                                @error('rate_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Rate Value') }}</label>
                            <div class="col-md-6">
                                <input id="rate_value" type="text" class="form-control" name="rate_value">            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                            <div class="col-md-6">
                                <input id="exp_date" type="date" class="form-control" name="expiry_date">            
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Rate') }}
                                </button>
                                <a href="{{ route('rates.index') }}" class="btn btn-dark">Go Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection