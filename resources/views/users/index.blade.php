@extends('layouts.master')

@section('title')
  {{__('admin.All Users')}}
@endsection

@section('content')
        <div class="table-responsive">
          <h1 class="text-center bg-dark text-light mt-2"><i class="fa-solid fa-list"></i> {{__('admin.All Users')}}</h1>
          <form action="{{ route('users.index') }}" method="get" class="row mb-4 mt-3">
            @csrf
            <div class="col-10">
                <div class="input-group ms-3">
                    <input type="text" name="term" id="term" class="form-control" value="{{ request('term') != "" ? request('term') : '' }}" placeholder="{{__('admin.Search By Name')}}...">
                </div>
            </div>
            <div class="col-2">
                 <button type="submit" class="btn btn-primary">{{__('admin.Search')}}</button>
                 <a href="{{route('users.index')}}" class="btn btn-secondary">{{__('admin.Reset')}}</a>
            </div>
        </form>
          <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
              <tr>
                <th>{{__('admin.ID')}}</th>
                <th>{{__('admin.Name')}}</th>
                <th>{{__('admin.Email')}}</th>
                <th>{{__('admin.Type')}}</th>
                <th>{{__('admin.Role')}}</th>
                <th>{{__('admin.Actions')}}</th>
              </tr>
            </thead>
             <tbody>
                @foreach($users as $user)
                 <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->type->name}}</td>
                  <td>@foreach($user->roles as $role)
                          {{$role->name}}
                      @endforeach
                  </td>
                  <td>
                    <a href="{{ route('users.show',$user->id) }}" class="btn btn-info">{{__('admin.Show')}}</a>
                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success">{{__('admin.Edit')}}</a>
                    <form action="{{route('users.destroy' ,$user->id)}}" method="post" style="display: inline-block">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger" style="display: inline-block">{{__('admin.Delete')}}</button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                      <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}">{{__('pagination.Previous')}}</a>
                      </li>
                      @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}" aria-current="page">
                          <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                      @endforeach
                      <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}">{{__('pagination.Next')}}</a>
                      </li>
                    </ul>
                  </nav>
                </div>
        </div>

@include('layouts.messages')
@endsection

