@extends('layouts.admin.app')
@section('style')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Add Slider image</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group control-group increment mb-2">
                    <input type="file" name="image" class="form-control">
                </div>
                <input type="submit" name="submit" value="Add Slider" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<div class="card" style="margin-top:20px">
                <div class="card-header">
                    <h3>Slider Images</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($sliders as $slider)
                        <div class="col-md-4 text-center">
                            <img src="{{$slider->image}}" style="height:150px;width:200px; margin:10px auto; border:1px solid #888888"/>
                            <div class="col-md-12 text-center">
                                <form action="{{route('sliderImage.delete',$slider->id)}}" method="post">
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
@endsection
