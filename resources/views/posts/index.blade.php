@extends('layouts.master')

@section('title')
{{__('admin.All Posts')}}
@endsection

@section('content')
        <div class="table-responsive">
          <h1 class="text-center bg-dark text-light mt-2"><i class="fa-solid fa-list"></i> {{__('admin.All Posts')}}</h1>
          <form action="{{ route('posts.index') }}" method="get" class="row mb-4 mt-3">
            @csrf
            <div class="col-10">
                <div class="input-group">
                    <input type="text" name="term" id="term" class="form-control" value="{{ request('term') != "" ? request('term') : '' }}" placeholder="{{__('admin.Search')}}...">
                    <label for="filter" class="ms-2 mt-2">{{__('admin.Filter By')}}:</label>
                    <select name="filter" id="filter" class="form-select ms-2">
                        <option value="title" {{ request('filter') === 'title' ? 'selected' : '' }}>{{__('admin.Title')}}</option>
                        <option value="description" {{ request('filter') === 'description' ? 'selected' : '' }}>{{__('admin.Description')}}</option>
                        <option value="publication_date" {{ request('filter') === 'publication_date' ? 'selected' : '' }}>{{__('admin.Date')}}</option>
                        <option value="user_id" {{ request('filter') === 'user_id' ? 'selected' : '' }}>{{__('admin.User')}}</option>
                        <option value="category_id" {{ request('filter') === 'category_id' ? 'selected' : '' }}>{{__('admin.Category')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">{{__('admin.Search')}}</button>
                 <a href="{{route('posts.index')}}" class="btn btn-secondary">{{__('admin.Reset')}}</a>
            </div>
        </form>
          <table class="table table-hover table-bordered mt-3">
            <thead class="table-dark">
              <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.Title')}}</th>
                <th>{{__('admin.Category')}}</th>
                <th>{{__('admin.User')}}</th>
                <th>{{__('admin.Date')}}</th>
                <th>{{__('admin.Image')}}</th>
                <th>{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($posts as $post)
                 <tr>
                  <td>{{$post->id}}</td>
                  <td>{{$post->title}}</td>
                  <td>{{$post->category->name}}</td>
                  <td>{{$post->user->name}}</td>
                  <td>{{$post->publication_date}}</td>
                  <td><img src="{{asset('storage/'.$post->image)}}" width="100"></td>
                  <td>
                    <a href="{{ route('posts.show',$post->id) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{route('posts.destroy' ,$post->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger" style="display: inline-block"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item {{ $posts->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                      </li>
                      @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}" aria-current="page">
                          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                      @endforeach
                      <li class="page-item {{ $posts->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                      </li>
                    </ul>
                  </nav>
                </div>
        </div>

@include('layouts.messages')
@endsection

