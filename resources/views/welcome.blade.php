@extends('layouts.app')
@section('content')
<div class="pl-200 pr-200 overflow clearfix">
    <div class="categori-menu-slider-wrapper clearfix">
        @include('layouts.partials.categories')
        @include('layouts.partials.slider')
    </div>
</div>
<div class="electro-product-wrapper wrapper-padding pt-95 pb-45">
    <div class="container-fluid">
        <div class="section-title-4 text-center mb-40">
            <h2>Latest Products</h2>
        </div>
        <div class="top-product-style row">

            @if(isset($products) && !$products->isEmpty())
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-wrapper product-border mb-24">
                    <div class="product-img-3">
                        <a href="{{route('product.details',$product->id)}}">
                            <img src="{{$product->image[0]->image}}" alt="" style="height:220px">
                        </a>
                    </div>
                    <div class="product-content-4 text-center">
                        <div class="product-rating-4">
                            <?php
                                $rated = floor($product->rating->average('rating'));
                                $unrated = 5-$rated;
                                while($rated > 0){
                                    echo('<a class="fa fa-star" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                    $rated--;
                                }
                                while($unrated > 0){
                                    echo('<a class="fa fa-star-o" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                    $unrated--;
                                }

                            ?>
                        </div>
                        <h4><a
                                href="{{route('product.details',$product->id)}}">{{substr($product->description,0,20)}}....</a>
                        </h4>
                        <span>{{$product->name}}</span>
                        <span>{{$product->company_name}}</span>
                        <h5>{{$product->price}} &#2547; </h5>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-danger">No product Found</div>
            @endif
        </div>
    </div>
    <!-- Best Selling Products -->
    <div class="special-food-area wrapper-padding-7 pt-115 pb-115">
        <div class="container">
            <div class="section-title-10 text-center mb-65">
                <h2>Best Selling Products</h2>
                <p> This Products are mostly ordered Items in our shop </p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="special-food-active owl-carousel">
                @foreach($bestSellingProducts as $bsp)
                <?php $product = \App\Product::find($bsp->id) ?>
                <div class="single-special-food" style="width: 258.25px;margin: 0px 10px;overflow: hidden;">
                    <a href="{{route('product.details',$product->id)}}"><img src="{{$product->image[0]->image}}"
                            alt="{{$product->name}}" style="width:320px;height:240px"></a>
                    <div class="special-food-content text-center">
                        <div class="product-rating-4">
                            <?php
                                $rated = floor($product->rating->average('rating'));
                                $unrated = 5-$rated;
                                while($rated > 0){
                                    echo('<a class="fa fa-star" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                    $rated--;
                                }
                                while($unrated > 0){
                                    echo('<a class="fa fa-star-o" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></a>');
                                    $unrated--;
                                }

                            ?>
                        </div>
                        <h5><a href="{{route('product.details',$product->id)}}">{{substr($product->name,0,20)}}</a></h5>
                        <p>{{substr($product->description,0,20)}}....</p>
                        <span>{{$product->price}} &#2547;</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Best Selling Products end --}}
    <div class="brand-logo-area-2 wrapper-padding ptb-80">
        <div class="container-fluid">
            <div class="brand-logo-active2 owl-carousel">
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/8.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/9.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/10.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/11.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/12.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/13.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/7.png" alt="">
                </div>
                <div class="single-brand">
                    <img src="frontend/img/brand-logo/8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    @endsection
