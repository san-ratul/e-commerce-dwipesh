@extends('layouts.seller.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add Product Details</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <div class="alert alert-info">
                <strong>Please add ',' for multiple color or size</strong>
            </div>
            <form action="{{route('productDetails.add')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Product Color</label>
                    <input type="text" class="form-control" name="color" placeholder="enter the product color" value="{{ old('color') }}">
                    @error('color')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Size</label>
                    <input type="text" class="form-control" name="size" placeholder="enter the product size" value="{{ old('size') }}">
                    @error('company_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Product Model</label>
                    <input type="text" class="form-control" name="model" placeholder="enter the product model">
                    @error('model')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
