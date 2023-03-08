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
        <h3 class="text-center"> <span class="text-danger">Hi..!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update Your profile</h3>
      <div class="card-body">
        <form method="post" action="{{route('update-image')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{Auth::user()->image}}" name="old_image">
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" class="form-control">

                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-danger">upload</button>
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
