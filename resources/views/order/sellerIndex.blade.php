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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Orders</div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="seller_order" class="table table-striped table-bordered"
                                    style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Product Details</th>
                                            <th>Specifications</th>
                                            <th>Notes & Status</th>
                                            <th>User Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(auth()->user()->orderDetails as $orderDetail)
                                        @if($orderDetail->order->status == 'Payment Varified')
                                        <tr>
                                            <td>{{$orderDetail->created_at->format('d-m-Y')}}</td>
                                            <td style="max-width:100px">
                                                <a href="{{route('product.details',$orderDetail->product->id)}}">
                                                    <p><strong>Title: </strong>{{$orderDetail->product->name}}</p>
                                                    <img src="{{$orderDetail->product->image[0]->image}}"
                                                        alt="{{$orderDetail->product->name}}<" class="w-100">
                                                </a>
                                            </td>
                                            <td>
                                                <p><strong>Color: </strong>{{$orderDetail->color ?? 'N/A'}}</p>
                                                <p><strong>Size: </strong>{{$orderDetail->size ?? 'N/A'}}</p>
                                                <p><strong>Price: </strong>{{$orderDetail->product->price}} BDT</p>
                                                <p><strong>Quantity: </strong>{{$orderDetail->quantity}}</p>
                                            <td>
                                                <p><strong>Note:</strong> {{$orderDetail->order->note ?? 'N/A'}}</p>
                                                <p><strong>Status:</strong> {{$orderDetail->status}}</p>
                                            </td>
                                            <td>
                                                <p><strong>Name: </strong> {{$orderDetail->order->user->name}} </p>
                                                <p><strong>Phone: </strong> {{$orderDetail->order->user->phone}} </p>
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
                                                @elseif($orderDetail->status == 'Order Cancled')
                                                <p class="text-danger text-center">{{$orderDetail->status}}</p>
                                                @else
                                                <p class="text-success text-center">{{$orderDetail->status}}</p>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Processed Orders</div>
                        <div class="card-body">
                            <div class="x_content">
                                <table id="seller_processed_order" class="table table-striped table-bordered"
                                    style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Product Details</th>
                                            <th>Specifications</th>
                                            <th>Notes & Status</th>
                                            <th>User Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(auth()->user()->orderDetails as $orderDetail)
                                        @if($orderDetail->order->status == "Order Processed:Full"||
                                        $orderDetail->order->status == "Order Processed:Partial")
                                        <tr>
                                            <td>{{$orderDetail->created_at->format('d-m-Y')}}</td>
                                            <td style="max-width:100px">
                                                <a href="{{route('product.details',$orderDetail->product->id)}}">
                                                    <p><strong>Title: </strong>{{$orderDetail->product->name}}</p>
                                                    <img src="{{$orderDetail->product->image[0]->image}}"
                                                        alt="{{$orderDetail->product->name}}<" class="w-100">
                                                </a>
                                            </td>
                                            <td>
                                                <p><strong>Order ID: </strong>{{$orderDetail->order->id ?? 'N/A'}}</p>
                                                <p><strong>Color: </strong>{{$orderDetail->color ?? 'N/A'}}</p>
                                                <p><strong>Size: </strong>{{$orderDetail->size ?? 'N/A'}}</p>
                                                <p><strong>Price: </strong>{{$orderDetail->product->price}} BDT</p>
                                                <p><strong>Quantity: </strong>{{$orderDetail->quantity}}</p>
                                            <td>
                                                <p><strong>Note:</strong> {{$orderDetail->order->note ?? 'N/A'}}</p>
                                                <p><strong>Status:</strong> {{$orderDetail->status}}</p>
                                            </td>
                                            <td>
                                                <p><strong>Name: </strong> {{$orderDetail->order->user->name}} </p>
                                                <p><strong>Phone: </strong> {{$orderDetail->order->user->phone}} </p>
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
                                                @elseif($orderDetail->status == 'Order Cancled')
                                                <p class="text-danger text-center">{{$orderDetail->status}}</p>
                                                @else
                                                <p class="text-success text-center">{{$orderDetail->status}}</p>
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
                                            @endif
                                        </tr>
                                        @endif
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
<script type="text/javascript">
    var $ = jQuery;
    $('#seller_order').DataTable({
        lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "All"]],
        order: [0,'desc'],
    });
    $('#seller_processed_order').DataTable({
        lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "All"]],
        order: [0,'desc'],
    });

</script>
@endsection
