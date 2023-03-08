<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <!-- <img src="{{ asset(Auth::user()->image) }}" class="card-img-top" alt="..." style="border-radius: 50%"> -->
        <img src="{{ asset(Auth::user()->image) }}" class="card-img-top" height="100%" width="100%" style="border-radius: 50%">
  <ul class="list-group list-group-flush">
    <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
    <a href="{{route('image')}}" class="btn btn-primary btn-sm btn-block">Update Image</a>
    <a href="{{route('change-password')}}" class="btn btn-primary btn-sm btn-block">Update Password</a>
        <a href="{{ route('logout') }}" 
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="btn btn-danger btn-sm btn-block"> 
         Log Out
      </a>
  </ul>
</div>
  </div>