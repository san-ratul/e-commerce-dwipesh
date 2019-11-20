@extends('layouts.user.partials.detailsTop')
@section('content')
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="geo-alert"></div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Cart</h1>
                <div class="table-content table-responsive">
                    @if(isset($products) && !$products->isEmpty())
                    <table>
                        <thead>
                            <tr>
                                <th>remove</th>
                                <th>images</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                @csrf
                                <td class="product-remove">
                                    <form id="cart-delete-form" action="{{ route('cart.delete',$product->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="padding:0px;background:transparent;border:none;cursor:pointer"><i
                                                class="pe-7s-close"></i></button>
                                    </form>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="{{route('product.details',$product->id)}}">
                                        <img src="{{$product->image[0]->image}}" alt=""
                                            style="max-width:70px;max-height:70px">
                                    </a>
                                </td>
                                <td class="product-name"><a href="#">{{$product->name}}</a></td>
                                <td class="product-price-cart"><span class="amount">{{$product->price}} BDT</span></td>
                                <form action="{{route('cart.update',$product->id)}}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <td class="product-quantity">
                                        <input value="{{$product->quantity}}" type="number" min="1" name="quantity">
                                    </td>
                                    <td class="product-subtotal">{{$product->subTotal}} BDT</td>
                                    <td>
                                        <input class="button bg-dark" name="update_cart" value="Update" type="submit"
                                            style="width:100%; color:white">
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-danger">Please add product to cart!</div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                            <h2>Cart totals</h2>
                            <ul>
                                <li>Subtotal<span>{{$cart['subTotal']}} BDT</span></li>
                                <li>Total<span>{{$cart['subTotal']}} BDT</span></li>
                            </ul>
                            <a href="{{url('user/checkout')}}/na/na" id="checkout">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->

@endsection
@section('script')
<script>
    function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition,showError);
            } else {
                $('.geo-alert').html('Please alow location otherwise we will not be able to provide you the nearest pharmacy distance');
            }
        }
        function showPosition(position) {
            document.getElementById("checkout").href="{{url('user/checkout')}}"+"/"+position.coords.latitude+"/"+position.coords.longitude;
        }
        function showError(error) {
            var x = $('.geo-alert');
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.html('<div class="alert alert-danger">Please alow location otherwise we will not be able to detect your address automatically</div>');
                break;
                case error.POSITION_UNAVAILABLE:
                x.html('<div class="alert alert-danger">Location information is unavailable.</div>');
                break;
                case error.TIMEOUT:
                x.html('<div class="alert alert-danger">The request to get user location timed out.</div>');
                break;
                case error.UNKNOWN_ERROR:
                x.html('<div class="alert alert-danger">An unknown error occurred.</div>');
                break;
            }
        }
        (function() {
            getLocation();

        })();

</script>
@endsection
