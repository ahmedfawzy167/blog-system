@extends('layouts.master')

@section('title')
  {{__('admin.Home Page')}}
@endsection

 @section('content')

    <div class="container-fluid px-4">
        <h3 class="mt-4"><i class="fas fa-tachometer-alt"></i> {{__('admin.Dashboard')}}</h3>
        <hr>
         <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fas fa-columns"></i> {{__('admin.Number of Posts')}}</div>
                  <div class="card-footer d-flex align-items-center justify-content-between">
                    <h4 class="small text-white stretched-link">{{$posts}}</h4>
                    </div>
                    </div>
                    </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-list"></i>  {{__('admin.All Categories')}}</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <h4 class="small text-white stretched-link">{{$categories}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fas fa-user fa-fw"></i> {{__('admin.Recently Users')}}</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <h4 class="small text-white stretched-link">{{$recentUsers}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        {{__('admin.Sales Revenue')}}
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        {{__('admin.Bar Chart')}}
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>

                    <div class="card">
                        <h2>{{__('admin.Latest Posts This Month')}} <i class="fa-solid fa-calendar-days"></i></h2>
                        <table class="table table-hover table-bordered mt-3">
                            <thead class="table-dark">
                              <tr>
                                <th>{{__('admin.Title')}}</th>
                                <th>{{__('admin.Category')}}</th>
                                <th>{{__('admin.User')}}</th>
                                <th>{{__('admin.Date')}}</th>
                                <th>{{__('admin.Image')}}</th>
                              </tr>
                            </thead>
                             <tbody>
                                @foreach ($postsThisMonth as $post )
                                <tr>
                                    <th>{{$post->title}}</th>
                                    <th>{{$post->category->name}}</th>
                                    <th>{{$post->user->name}}</th>
                                    <th>{{$post->publication_date}}</th>
                                    <th><img src="{{asset('storage/'.$post->image)}}" width="100px"></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            @include('layouts.messages')
            @endsection


