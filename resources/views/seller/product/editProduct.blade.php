@extends('layouts.seller.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Update Product</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="alert alert-info">
                <strong>Please add ',' for multiple color or size</strong>
            </div>
            <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="name" class="form-control" name="name" value="{{$product->name}}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control" name="company_name" value="{{ $product->company_name }}">
                    @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category" class="form-control-label">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        <option value="">Please select</option>
                        @if(!$categories->isEmpty())
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{($product->category->id == $category->id)?'selected':''}}>{{$category->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">product Price</label>
                    <input type="number" class="form-control" name="price" value="{{$product->price}}">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">product quantity</label>
                    <input type="quantity" class="form-control" name="quantity" value="{{$product->quantity}}" />
                    @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Product Color</label>
                    <input type="text" class="form-control" name="color" value="{{$product->productDetails->color}}">
                    @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Size</label>
                    <input type="text" class="form-control" name="size" placeholder="enter the product size" value="{{ $product->productDetails->size }}">
                    @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Product Model</label>
                    <input type="text" class="form-control" name="model" value="{{$product->productDetails->model}}">
                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group control-group increment">
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                    </div>
                </div>
                <div class="clone hide">
                    <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" style="height:80px;" value="{{$product->description}}">
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <div class="card" style="margin-top:20px">
                <div class="card-header">
                    <h3>Product Images</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($product->image as $images)
                        <div class="col-md-4 text-center">
                            <img src="{{$images->image}}" style="height:150px;width:200px; margin:10px auto; border:1px solid #888888"/>
                            <div class="col-md-12 text-center">
                                <form action="{{route('image.delete',$images->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-primary btn-sm" value="Delete">
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });

    });
</script>
@endsection