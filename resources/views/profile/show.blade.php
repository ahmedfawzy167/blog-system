@extends('layouts.master')

@section('title')
   Show Profile
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-dark text-white"><i class="fa-solid fa-eye"></i> Administrator Details</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">Name: {{$admin->name}}</h6>
        <h6 class="list-group-item">Email: {{$admin->email}}</h6>
        <h6 class="list-group-item">Role: {{$admin->role->name}}</h6>
      </ul>
    </div>
  </div>
  <div class="text-center mt-2">
    <a href="{{route('profile.edit')}}" class="btn btn-dark text-white">Edit Profile</a>
 </div>


@endsection
