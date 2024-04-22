@extends('layouts.master')

@section('title')
New Setting
@endsection

@section('content')


<div class="card">
  @if($errors->any())
   <div class="alert alert-danger">
     <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
     </ul>
   </div>
@endif

<div class="container card-body">

    <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-gear"></i> Add New Setting</h1>
    <form action="{{route('settings.store')}}" method="post" enctype="multipart/form-data" class="row">
     @csrf

    <div class="form-group col-md-6">
      <label for="logo">Logo</label>
      <input type="file" name="logo" id="logo" class="form-control @error('image') is-invalid @enderror">
      @error('image')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="location">Location</label>
      <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror">
      @error('location')
       <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
      @error('email')
       <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
    </div>

    <div class="col-6">
      <label for="phone">Phone</label>
      <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
      @error('phone')
        <strong class="invalid-feedback">{{ $message }}</strong>
      @enderror
      </div>

      <div class="form-group col-md-6">
        <label for="lat">Lat</label>
        <input type="text" name="lat" id="lat" class="form-control @error('lat') is-invalid @enderror">
        @error('lat')
          <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
        </div>

        <div class="form-group col-md-6">
         <label for="long">Long</label>
         <input type="text" name="long" id="long" class="form-control @error('long') is-invalid @enderror">
         @error('long')
           <strong class="alert alert-danger">{{ $message }}</strong>
         @enderror
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-lg">Add</button>
            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
        </div>
</form>
</div>
</div>
@endsection
