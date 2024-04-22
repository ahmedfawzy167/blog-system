@extends('layouts.master')

@section('title')
{{__('admin.All Categories')}}
@endsection

@section('content')

        <div class="table-responsive">
          <h1 class="text-center bg-dark text-light mt-2"><i class="fa-solid fa-list"></i> {{__('admin.All Categories')}}</h1>
          <table class="table table-hover table-bordered mt-3">
            <thead class="table-dark">
              <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.Name')}}</th>
                <th>{{__('admin.Image')}}</th>
                <th>{{__('admin.Created at')}}</th>
                <th>{{__('admin.Updated at')}}</th>
                <th>{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($categories as $category)
                 <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$category->name}}</td>
                  <td><img src="{{asset('storage/'.$category->image)}}" width="100"></td>
                  <td>{{$category->created_at}}</td>
                  <td>{{$category->updated_at}}</td>
                  <td>
                    <a href="{{ route('categories.show',$category->id) }}" class="btn btn-info">{{__('admin.Show')}}</a>
                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-success">{{__('admin.Edit')}}</a>
                    <form action="{{route('categories.destroy' ,$category->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Trash')}}</button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item {{ $categories->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $categories->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                      </li>
                      @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}" aria-current="page">
                          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                      @endforeach
                      <li class="page-item {{ $categories->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $categories->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                      </li>
                    </ul>
                  </nav>
                </div>
        </div>

@include('layouts.messages')
@endsection

