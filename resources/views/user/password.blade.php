@extends('layouts.fontend_master')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
        <div class="row">

    @include('user.inc.sidebar')

  <div class="col-md-8 mt-1">
    <div class="card">
        <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your Password</h3>
      <div class="card-body">
        <form method="post" action="{{route('update.password.save')}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Old Password</label>
                <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter old password">

                @error('old_password')
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">New Password</label>
                <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="enter new password">

                @error('new_password')
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Re-Type New password">

                @error('confirm_password')
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-danger">Change Password</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
@endsection
