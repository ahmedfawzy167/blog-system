@extends('layouts.master')

@section('title')
  Settings
@endsection

@section('content')
    <div class="row">
        <div class="card-body">
            <h1 class="text-center bg-dark text-light mt-2"><i class="fa-solid fa-gear"></i> Configuration Settings</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Logo</th>
                            <th>Location</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>lat</th>
                            <th>long</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td><img src="{{asset('storage/'.$setting->logo)}}" class="rounded-circle" width="60px"></td>
                            <td>{{$setting->location}}</td>
                            <td>{{$setting->email}}</td>
                            <td>{{$setting->phone}}</td>
                            <td>{{$setting->lat}}</td>
                            <td>{{$setting->long}}</td>
                            <td>
                                <a href="{{ route('settings.create') }}" class="btn btn-primary">Add</a>
                                <a href="{{ route('settings.edit',$setting->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{route('settings.destroy' ,$setting->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                     <button type="submit" class="btn btn-danger" style="display: inline-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@include('layouts.messages')
@endsection
