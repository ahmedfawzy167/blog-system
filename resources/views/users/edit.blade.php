@extends('layouts.master')

@section('title')
{{__('admin.Edit User')}}
@endsection

@section('content')

<div class="container">
  <h1 class="text-center bg-dark text-white mt-4"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit User')}}</h1>
  <form action="{{ route('users.update',$user->id) }}" method="post" class="row">
    @csrf
    @method('PUT')

     <div class="form-group col-md-12 mt-2">
      <label for="name"><i class="fa-solid fa-file-signature"></i> {{__('admin.User Name')}}</label>
      <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control mt-2 @error('name') is-invalid @enderror">
      @error('name')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group col-md-6 mt-2">
      <label for="email"><i class="fa-solid fa-envelope"></i> {{__('admin.Email')}}</label>
      <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control mt-2 @error('email') is-invalid @enderror">
       @error('email')
         <strong class="invalid-feedback">{{ $message }}</strong>
       @enderror
    </div>

    <div class="form-group col-md-6 mt-2">
        <label for="password"><i class="fa-solid fa-lock"></i> {{__('admin.Password')}}</label>
        <input type="password" name="password" id="password" value="{{$user->password}}" class="form-control mt-2 @error('password') is-invalid @enderror">
        @error('password')
         <strong class="invalid-feedback">{{ $message }}</strong>
       @enderror
    </div>

      <div class="form-group col-md-6 mt-2">
        <label for="type_id"><i class="fa-solid fa-user"></i> {{__('admin.Type')}}</label>
        <select name="type_id" id="type_id" class="form-select mt-2">
          @foreach($types as $type)
           <option value="{{$type->id}}" {{$user->type_id == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-md-6 mt-2">
        <label for="role_id"><i class="ion-arrow-expand"></i> {{__('admin.Role')}}</label>
        <select name="role_id" id="role_id" class="form-select mt-2">
          @foreach($roles as $role)
           <option value="{{$role->id}}">{{$role->name}}</option>
          @endforeach
        </select>
      </div>

    <div class="text-center mt-3">
      <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
      <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
    </div>

</form>
</div>
@endsection
