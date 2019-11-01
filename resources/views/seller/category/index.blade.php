@extends('layouts.seller.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center ">Add Category</h3>
                    </div>
                    <hr>
                    <form action="{{route('category.add')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name" class="control-label mb-1">Category Name</label>
                            <input id="category_name" name="name" type="text" class="form-control" aria-required="true"
                                   aria-invalid="false" value="{{old('name')}}">
                            @error('name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                            <input id="category_slug" name="slug" type="text" class="form-control" aria-required="true"
                                   aria-invalid="false" value="{{old('slug')}}">
                            @error('slug')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="parent_category" class=" form-control-label">Select</label>
                            <select name="parent_id" id="parent_category" class="form-control" value="{{old('parent_id')}}">
                                <option value="">Please select</option>
                                @if(!$categories->isEmpty())
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('parent_id')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <i class="fa fa-plus-circle"></i>&nbsp;
                                <span id="payment-button-amount">Add Category</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(!$categories->isEmpty())
                        <div class="card-title">
                            <h3 class="text-center ">All Category</h3>
                        </div>
                        <hr>
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr class="text-center">
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>{{($category->parent)?$category->parent->name:'-'}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No categories found!
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
@endsection
