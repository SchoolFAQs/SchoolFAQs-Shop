@extends('users.layouts.master')
@section('content')
<h1 class="text-center mt-4">
    Fill the Form Below
</h1>

<hr>
<div class="d-flex justify-content-around">

    <form action="{{ route('vendor.application') }}" class="form-group my-2 col-xl-8 col-lg-10 col-md-7 col-12  p-3" method="POST" enctype="multipart/form-data" autocomplete="on">

        <div class="main-form">
            <div class="mb-3">
                <label for="name"><strong>* <i class="fas fa-user"></i> Name:</strong></label>
                <input type="text" name="user_name" class="border-bottom form-control" placeholder="Enter your name">
            </div>

            <div class="mb-3">
                <label for="name">
                    <strong>* <i class="fas fa-envelope"></i> Email:</strong>
                </label>
                <input type="text" name="user_email"  class="border-bottom form-control" placeholder="Enter your email"></input>
            </div>

            <div class="mb-3">
                <label for="tel">
                    <strong>* <i class="fas fa-calendar-day"></i> Date of Birth:</strong>
                </label>
                <input type="Date" required class="form-control border-bottom input-phone my-1" name="date_of_birth">
                <small class="form-text text-muted">Your Date of Birth</small>
            </div>

            <div class="mb-3">
                <label for="tel">
                    <strong>* <i class="fas fa-phone-alt"></i> Phone number:</strong>
                </label>
                <input type="tel" placeholder="681108107" required class="form-control border-bottom input-phone my-1" name="user_tel">
                <small class="form-text text-muted">It should be your mobile money number too.</small>
            </div>

            <div class="mb-3">
                <label for="id_card"><strong>* <i class="fas fa-id-card"></i> Upload your ID Card below (both front and back):</strong></label>
                <input type="file" class="form-control-file border-bottom" name="id_card">
                <small class="form-text text-muted">MAX size = 2MB (must be pdf)</small>
            </div>

            <div class="mb-3">
                <label for="license">
                    <strong><i class="fas fa-image"></i> Upload any Business Document (License, writing license etc):</strong>
                </label>
                <input type="file" class="form-control-file border-bottom" name="license">
                <small class="form-text text-muted">MAX size = 2MB (must be pdf)</small></label>
            </div>


            {{--<div class="mb-3">
                <label for="form_b">
                    <strong>* <i class="fas fa-image"></i> Download and fill the KYC form below and re-upload it:</strong>
                </label>
                <div class="mb-1">
                	<a href="#">KYC Form</a>
                </div>
                <input type="file" class="form-control-file border-bottom" name="kyc_form">
                <small class="form-text text-muted">MAX size = 2MB (must be pdf)</small>
            </div>--}}

            <div class="d-flex justify-content-end">
                <a href="{{ route('welcome') }}" class="btn mr-2 rounded-pill btn-danger">Cancel</a>
                <input type="submit" name="submit" class="btn rounded-pill btn-primary">
            </div>
        </div>

        @csrf
    </form>

</div>
@endsection