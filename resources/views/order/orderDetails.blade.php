<?php
    if(auth()->user()->is_admin){
        $extend = 'layouts.admin.app';
    }else if(auth()->user()->is_seller){
        $extend = 'layouts.seller.app';
    }else{
        $extend = 'layouts.user.app';
    }
?>

@extends($extend)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order By {{$order->user->name}}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Email: </strong>{{$order->user->email}}</p>
                            <p><strong>Phone: </strong>{{$order->user->phone}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipped To {{$order->shipped->s_name}}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Phone: </strong>{{$order->shipped->s_phone}}</p>
                            <p><strong>Address Line 1: </strong>{{$order->shipped->s_address_line_1}}</p>
                            <p><strong>Address Line 2: </strong>{{$order->shipped->s_address_line_2}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Order Details for {{$order->id}}</div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="varification_pending" class="table table-striped table-bordered"
                                    style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product Title</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            @if(auth()->user()->is_seller)
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $orderDetail)
                                        <tr>
                                            <td style="max-width:100px">
                                                <a href="{{route('product.details',$orderDetail->product->id)}}">
                                                    <img src="{{$orderDetail->product->image[0]->image}}"
                                                        alt="{{$orderDetail->product->name}}<" class="w-100">
                                                </a>
                                            </td>
                                            <td>{{$orderDetail->product->name}}</td>
                                            <td>{{$orderDetail->color ?? 'N/A'}}</td>
                                            <td>{{$orderDetail->size ?? 'N/A'}}</td>
                                            <td>{{$orderDetail->product->price}} BDT</td>
                                            <td>{{$orderDetail->quantity}}</td>
                                            <td>
                                                <p class="text-success text-center">{{$orderDetail->status}}</p>
                                                @if($orderDetail->status == 'Shipped' && !auth()->user()->is_seller &&
                                                !auth()->user()->is_admin)
                                                <p>Please enter your feedback</p>
                                                <div class="text-center">
                                                    <div class='starrr' id='star1'></div>
                                                </div>
                                                <form action="{{route('user.product.rating',$orderDetail->id)}}"
                                                    method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control rating" value=""
                                                            name="rating">
                                                        @error('rating')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea name="feedback" id="feedback" cols="30" rows="5"
                                                            class="form-control"></textarea>
                                                        @error('feedback')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <input type="submit" value="Provide Feedback"
                                                        class="btn btn-success">
                                                </form>
                                                @endif
                                                @if($orderDetail->status == 'Completed')
                                                <div class="starrr" style="margin-left:10px">
                                                    <?php
                                                        $rated = $orderDetail->rating->rating;
                                                        $unrated = 5-$rated;
                                                        while($rated > 0){
                                                            echo('<a class="fa fa-star"></a>');
                                                            $rated--;
                                                        }
                                                        while($unrated > 0){
                                                            echo('<a class="fa fa-star-o"></a>');
                                                            $unrated--;
                                                        }

                                                    ?>
                                                </div>
                                                <p>{{$orderDetail->rating->feedback}}</p>
                                                @endif
                                            </td>
                                            @if(auth()->user()->is_seller)
                                            <td>
                                                @if($orderDetail->status == 'Order Placed')
                                                <a href="{{route('seller.confirmOrder',$orderDetail->id)}}"
                                                    class="btn btn-success">Confirm Order</a>
                                                <a href="{{route('seller.cancelOrder',$orderDetail->id)}}"
                                                    class="btn btn-danger mt-2">Cancel Order</a>
                                                @elseif($orderDetail->status == 'Order Confirmed')
                                                <a href="{{route('seller.productShipped',$orderDetail->id)}}"
                                                    class="btn btn-success mt-2">Product Shipped</a>
                                                @elseif($order->status == 'Order Cancled')
                                                <p class="text-danger text-center">{{$orderDetail->status}}</p>
                                                @else
                                                <p class="text-success text-center">{{$orderDetail->status}}</p>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var $ = jQuery
    $('#star1').starrr({
        change: function(e, value){
            if (value) {
                $('.rating').val(value);
            }
        }
    });
</script>
@endsection
