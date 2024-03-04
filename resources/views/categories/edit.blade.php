@extends('layouts.master')

@section('title')
  {{__('admin.Edit Category')}}
@endsection

@section('content')

 <div class="container">
    <h1 class="text-center bg-dark text-white mt-3"><i class="fa-solid fa-pen-to-square"></i> {{__('admin.Edit Category')}}</h1>
    <form action="{{ route('categories.update',$category->id) }}" method="post" class="row" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group col-12 mt-3">
       <label for="name"><i class="fa-solid fa-file-signature"></i> {{__('admin.Category Name')}}</label>
       <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control mt-2 @error('name') is-invalid @enderror">
       @error('name')
        <strong class="invalid-feedback">{{ $message }}</strong>
       @enderror
      </div>

      <div class="form-group col-12 mt-3">
        <label for="image"><i class="fa-solid fa-image"></i> {{__('admin.Category Image')}}</label>
        <input type="file" name="image" id="image" class="form-control mt-2 @error('image') is-invalid @enderror">
        @error('image')
         <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
       </div>

      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg">{{__('admin.Update')}}</button>
        <button type="reset" class="btn btn-secondary btn-lg">{{__('admin.Reset')}}</button>
      </div>

</form>
</div>

@endsection
