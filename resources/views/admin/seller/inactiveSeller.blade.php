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
            <table id="inactive" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th> Name</th>
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
                  <form  action="{{route('active.seller',$user->id)}}" method="post" >
                  @csrf
                  @method('PATCH')
                  <input type="submit" value="active" class="btn btn-primary btn-sm">
                  </form>
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
            $('#inactive').DataTable();
        } );
    </script>
@endsection