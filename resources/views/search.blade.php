@extends('layouts.master')

@section('title')
{{__('admin.Search User')}}
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-dark text-white"><i class="fa-solid fa-eye"></i> {{__('admin.You Are Searching For...')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.User Name')}}: {{$user->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Email')}}: {{$user->email}}</h6>
        <h6 class="list-group-item">{{__('admin.User Type')}}: {{$user->type->name}}</h6>
        <h6 class="list-group-item">{{__('admin.User Role')}}: @foreach ($user->roles as $role)
           {{$role->name}}
        @endforeach
       </h6>

      </ul>
    </div>
  </div>


@endsection
