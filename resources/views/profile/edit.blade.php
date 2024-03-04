@extends('layouts.master')

@section('title')
   Profile
@endsection

@section('content')
<div class="card">

 <h4 class="card-header bg-dark text-white text-center mt-3"><i class="fa-solid fa-gear"></i> Edit Profile</h4>
  <div class="card-body">
   <form method="POST" action="{{route('profile.update',$admin->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group mt-2">
        <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
        <input type="email" class="form-control mt-2 @error('email') is-invalid @enderror" id="email" name="email">
        @error('email')
         <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
      </div>

     <div class="form-group mt-2">
      <label for="current_password"><i class="fa-solid fa-lock"></i> Current Password</label>
      <input type="password" class="form-control mt-2 @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
      @error('current_password')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

<div class="form-group mt-2">
  <label for="new_password"><i class="fas fa-unlock-alt"></i> New Password</label>
  <input type="password" class="form-control mt-2 @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
    @error('new_password')
      <strong class="invalid-feedback">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group mt-2">
  <label for="new_password_confirmation"><i class="fas fa-clipboard-check"></i> Confirm Password</label>
  <input type="password" class="form-control mt-2 @error('new_password') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
  @error('new_password_confirmation')
    <strong class="invalid-feedback">{{ $message }}</strong>
  @enderror
</div>

<div class="text-center mt-2">
  <button type="submit" class="btn btn-dark text-white btn-lg">Save Changes</button>
</div>

</form>

</div>
</div>
@include('layouts.messages')
@endsection
