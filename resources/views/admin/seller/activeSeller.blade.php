@extends('layouts.admin.app')
@section('content')
<div class="container-fluid">
        <div class="card">
          <div class="card-header">All Seller</div>
          <div class="card-body">
          @if($users->isEmpty())
            <div class="alert alert-danger">No Admin Requests yet!</div>
          @else
          <div class="x_content">
            <table id="active_sellers" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($users as $user)
                  <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>
                <form action="{{route('deactive.seller',$user->id)}}" method="post">
                @csrf
                      @method('PATCH')
                    <div class="form-group">
                      <textarea type="text" class="form-control" name="reason" rows="2" cols="10"  placeholder="Enter the Deactive Reason"></textarea>
                      @error('reason')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <input type="submit" value="Deactive" class="btn btn-danger btn-sm">
               </form>
			   </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          @endif
          </div>
        </div>
      </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $('#active_sellers').DataTable();
        } );
    </script>
@endsection