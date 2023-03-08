@extends('layouts.admin_master')

@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Admin</a>
        <span class="breadcrumb-item active">Profile</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">

        @include('user.inc.sidebar')

  <div class="col-md-8 mt-1">
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{route('updated-image')}}" enctype="multipart/form-data">
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

        <!-- row -->
    </div>
@endsection
