@extends('layouts.seller.app')
@section('content')
<div class="card">
    <div class="card-header"><h3>Update seller Information</h3></div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="{{route('seller.update',$user->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="">seller  Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">seller Email</label>
                <input type="email" class="form-control" name="email"  value="{{$user->email}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password" value="{{null}}" placeholder="enter the  password">
                 @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                 <label for="">seller Contact</label>
                 <input type="text" class="form-control" name="phone" value="{{$user->phone}}" placeholder="enter the student Contact">
                 @error('contact')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection