@extends('layouts.master')

@section('title')
  {{__('admin.Edit Post')}}
@endsection

@section('content')

 <div class="container">
    <h1 class="text-center bg-dark text-white mt-3"><i class="fa-solid fa-pen-to-square"></i> {{__('Edit Post')}}</h1>
    <form action="{{ route('posts.update',$post->id) }}" method="post" class="row" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group col-12 mt-3">
       <label for="title"><i class="fa-solid fa-file-signature"></i> {{__('admin.Post Title')}}</label>
       <input type="text" name="title" id="title" value="{{$post->title}}" class="form-control mt-2 @error('title') is-invalid @enderror">
       @error('title')
        <strong class="invalid-feedback">{{ $message }}</strong>
       @enderror
      </div>

      <div class="form-group col-12 mt-3">
        <label for="content"><i class="fa-solid fa-audio-description"></i> {{__('admin.Post Content')}}</label>
        <textarea name="content" id="summernote" rows="8" class="form-control mt-2 @error('content') is-invalid @enderror">{{$post->content}}</textarea>
        @error('content')
         <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
       </div>

      <div class="form-group col-6 mt-3">
        <label for="image"><i class="fa-solid fa-image"></i> {{__('admin.Post Image')}}</label>
        <img src="{{asset('storage/'.$post->image)}}" width="55px" class="rounded-circle">
        <input type="file" name="image" id="image" class="form-control mt-2 @error('image') is-invalid @enderror">
        @error('image')
         <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
       </div>

       <div class="form-group col-6 mt-5">
        <label for="publication_date"><i class="fa-solid fa-calendar-days"></i> {{__('admin.Post Date')}}</label>
        <input type="datetime-local" name="publication_date" value="{{$post->publication_date}}" id="publication_date" class="form-control mt-2 @error('publication_date') is-invalid @enderror">
        @error('publication_date')
         <strong class="invalid-feedback">{{ $message }}</strong>
        @enderror
       </div>

       <div class="form-group col-6 mt-3">
        <label for="category_id"><i class="fas fa-book-open"></i> {{__('admin.Post Category')}}</label>
        <select name="category_id" id="category_id" class="form-select mt-2">
          @foreach($categories as $category)
           <option value="{{$category->id}}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group col-6 mt-3">
        <label for="user_id"><i class="fa-solid fa-user"></i> {{__('admin.Post Author')}}</label>
        <select name="user_id" id="user_id" class="form-select mt-2">
          @foreach($users as $user)
           <option value="{{$user->id}}" {{$post->user_id == $user->id ? 'selected' : ''}} >{{$user->name}}</option>
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
