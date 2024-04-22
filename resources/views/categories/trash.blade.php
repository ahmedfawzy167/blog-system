@extends('layouts.master')

@section('title')
  {{__('admin.Trashed Categories')}}
@endsection

@section('content')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <h1 class="text-center bg-danger text-light mt-3"><i class="fas fa-trash"></i> {{__('admin.Trashed Categories')}}</h1>
                 @if($trashedCategories->isEmpty())
                 <div class="d-flex justify-content-center">
                  <img src="{{asset('assets/img/trash.jpg')}}" width="500">
                  </div>
                  <h3 class="text-center mt-2">{{ __('admin.No Trashed Categories Found!') }}</h3>

                @else
                 <table class="table table-hover table-bordered ms-2">
                    <thead class="table-dark">
                        <tr>
                            <th>{{__('admin.ID')}}</th>
                            <th>{{__('admin.Name')}}</th>
                            <th>{{__('admin.Image')}}</th>
                            <th>{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                       @foreach($trashedCategories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td><img src="{{asset('storage/'.$category->image)}}" width="200"></td>
                            <td>
                                <form action="{{ route('categories.restore',$category->id) }}" method="post" style="display: inline-block">
                                   @csrf
                                   @method('PUT')
                                   <button type="submit" class="btn btn-outline-success" style="display: inline-block">{{__('admin.Restore')}}</button>
                                </form>
                                 <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#categoryModal">{{__('admin.Delete')}}</button>
                            </td>
                        </tr>

    <!-- Modal -->
     <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="categoryModalLabel">{{__('admin.Delete Category')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{__('admin.Are you Sure you Want to Delete the Category?')}}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-danger btn-lg">{{__('admin.Yes')}}</button>
                <form action="{{ route('categories.delete',$category->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">{{__('admin.No')}}</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
      </tbody>
      </table>
      @endif
        </div>
        </div>
    </div>


@endsection

