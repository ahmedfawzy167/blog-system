@extends('layouts.master')

@section('title')
{{__('admin.Show Category')}}
@endsection

@section('content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-dark text-white"><i class="fa-solid fa-eye"></i> {{__('admin.Category Details')}}</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">{{__('admin.Category Name')}}: {{$category->name}}</h6>
        <h6 class="list-group-item">{{__('admin.Category Image')}}: <img src="{{asset('storage/'.$category->image)}}" width=100></h6>
        <h6 class="list-group-item">{{__('admin.Related Posts')}}:
            @foreach ($category->posts as $post)
             <div class="ms-4">
                <li>{{$post->title}}</li>
            @endforeach
           </div>
        </h6>

      </ul>
    </div>
  </div>
  <div class="text-center mt-3">
    <a href="{{route('categories.index')}}" class="btn btn-dark text-white">{{__('admin.Back to List')}}</a>
 </div>


@endsection
