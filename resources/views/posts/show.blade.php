@extends('layouts.master')

@section('title')
   {{__('admin.Show Post')}}
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-danger text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Post Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Post Title')}}: {{$post->title}}</h6>
        <h6 class="list-group-item">{{__('admin.Post Description')}}: {{$post->content}}</h6>
        <h6 class="list-group-item">{{__('admin.Post Category')}}: {{$post->category->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Post Author')}}: {{$post->user->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Post Date')}}: {{$post->publication_date}}</h6>
        <h6 class="list-group-item">{{__('admin.Post Image')}}: <img src="{{asset('storage/'.$post->image)}}" width="100px" class="rounded-circle ms-3"></h6>
        <h6>{{__('admin.For More Blogs Scan the Qr Code:')}}</h6>
        <span class="visible-print ms-4">
           {!! QrCode::size(120)->color(255, 0, 0)->generate('https://pinchofyum.com/') !!}
        </span>
      </ul>
    </div>
  </div>
  <div class="text-center mt-2">
    <a href="{{route('posts.index')}}" class="btn btn-danger text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
