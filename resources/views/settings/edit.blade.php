@extends('layouts.master')

@section('title')
 Edit Setting
@endsection

@section('content')

<div class="card">
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container card-body">
  <h1 class="text-center bg-dark text-white"><i class="fa-solid fa-pen-to-square"></i> Edit Setting</h1>
  <form action="{{route('settings.update',$setting->id)}}" method="post" enctype="multipart/form-data" class="row">
    @method('PUT')
    @csrf

    <div class="form-group col-md-6">
      <label for="logo">Logo</label>
      <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
      @error('image')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="location">Location</label>
      <input type="text" name="location" id="location" value="{{$setting->location}}" class="form-control @error('location') is-invalid @enderror">
      @error('location')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" name="email" value="{{$setting->email}}" id="email" class="form-control @error('email') is-invalid @enderror">
      @error('email')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="col-6">
      <label for="phone">Phone</label>
      <input type="number" name="phone" value="{{$setting->phone}}" id="phone" class="form-control @error('phone') is-invalid @enderror">
      @error('phone')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="lat">Lat</label>
        <input type="text" name="lat" value="{{$setting->lat}}" id="lat" class="form-control @error('lat') is-invalid @enderror">
        @error('lat')
          <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
        </div>

        <div class="form-group col-md-6">
         <label for="long">Long</label>
         <input type="text" name="long" value="{{$setting->long}}" id="long" class="form-control @error('long') is-invalid @enderror">
         @error('long')
          <strong class="invalid-feedback">{{ $message }}</strong>
         @enderror
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Update</button>
            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
        </div>
</form>
</div>
</div>

@endsection
