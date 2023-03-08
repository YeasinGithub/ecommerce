@extends('layouts.fontend_master')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Password Reset</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->            
<div class="col-md-6 col-sm-6 sign-in">
    <h4 class="">Forget Password</h4>
    <form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="email address">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Send Password Reset Link') }}</button>

        <a href="{{ route('login') }}" class="forgot-password pull-right">return to login</a>
    </form>                 
</div>
<!-- create a new account -->           </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->

<!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->    </div><!-- /.container -->
</div>
@endsection
