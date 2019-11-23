@extends('layouts.user.partials.detailsTop')
@section('content')
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <form action="{{route('user.order.place')}}" method="post" id="checkout-form">
                    @csrf
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Name <span class="required">*</span></label>
                                    <input type="text" value="{{old('name') ?? auth()->user()->name}}" name="name" disabled required />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" placeholder="Apartment, suite, unit etc. (optional)" value="{{old('address_line_1')}}"
                                        name="address_line_1" required />
                                    @error('address_line_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                <input type="text" value="{{$location}}" name="address_line_2" value="{{old('address_line_2')}}" required />
                                    @error('address_line_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" value="{{auth()->user()->email}}" name="email" value="{{old('email')}}" disabled
                                        required />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" value="{{auth()->user()->phone}}" name="phone"  value="{{old('phone')}}"  disabled
                                        required />
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Transaction ID <span class="required">*</span></label>
                                    <input type="text" name="trx_id" value="{{old('trx_id')}}" required />
                                    @error('trx_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>Ship to Another Person?</label>
                                    <input id="ship-box" type="checkbox" name="others" />
                                </h3>
                            </div>
                            <div id="ship-box-info" class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Name <span class="required">*</span></label>
                                        <input type="text" placeholder="" name="s_name"  value="{{old('s_name')}}" />
                                        @error('s_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)"
                                            name="s_address_line_1" value="{{old('s_address_line_1')}}" />
                                        @error('s_address_line_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input type="text" placeholder="Street address" name="s_address_line_2" value="{{old('s_address_line_2')}}"/>
                                        @error('s_address_line_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" placeholder="Contact Number" name="s_phone" value="{{old('s_phone')}}"/>
                                        @error('s_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="order-notes">
                                <div class="checkout-form-list mrg-nn">
                                    <label>Order Notes</label>
                                    <textarea id="checkout-mess" cols="30" rows="10" name="note"
                                        placeholder="Notes about your order, e.g. special notes for delivery.">{{old('notes')}}</textarea>
                                    @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="cart_item">
                                    <td class="product-name">
                                        {{$product->name}} <strong class="product-quantity"> ×
                                            {{$product->quantity}}</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">{{$product->subTotal}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Cart Subtotal</th>
                                    <td><span class="amount">{{$cart['subTotal']}} BDT</span></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><strong><span class="amount">{{$cart['subTotal']}} BDT</span></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div class="panel-group" id="faq">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true"
                                                data-parent="#faq" href="#payment-1">Bkash</a></h5>
                                    </div>
                                    <div id="payment-1" class="panel-collapse collapse show">
                                        <div class="panel-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                aria-expanded="false" data-parent="#faq" href="#payment-2">DBBL</a></h5>
                                    </div>
                                    <div id="payment-2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5 class="panel-title"><a class="collapsed" data-toggle="collapse"
                                                aria-expanded="false" data-parent="#faq" href="#payment-3">Nagad</a>
                                        </h5>
                                    </div>
                                    <div id="payment-3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input type="submit" value="Place order" onclick="event.preventDefault();
                                document.getElementById('checkout-form').submit()"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
