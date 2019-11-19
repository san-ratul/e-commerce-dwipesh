@extends('layouts.admin.app')
    @section('content')
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">Prodcut List</div>
          <div class="card-body">
          @if(isset($products) && $products->isEmpty())
            <div class="alert alert-danger">No Product add yet!</div>
          @else
          <div class="x_content">
            <table id="productshow" class="table table-striped table-bordered" style="text-align:center;">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>product name</th>
                  <th>Company Name</th>
                  <th>Price</th>
                  <th>quantiy</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>


              <tbody>
                  @foreach($products as $product)
                  <tr>
                  <td>{{$product->category->name}}</td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->company_name}}</td>
                  <td>{{$product->price}} BDT/Pcs</td>
                  <td>{{$product->quantiy}} BDT/Pcs</td>
                  <td>{{substr($product->description,0,16)}}....</td>
                  <td><img src="{{$product->image[0]->image}}" style="max-width:100px;"/></td>
                  <td>
                  <form action="{{route('admin.deleteproduct',$product->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="delete" class="btn btn-danger btn btn-sm">
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
            $('#productshow').DataTable();
        } );
    </script>
@endsection
