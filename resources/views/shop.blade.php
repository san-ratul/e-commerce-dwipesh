@extends('layouts.user.partials.detailsTop')

@section('content')
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210"
    style="background-image: url({{$products[0]->image[0]->image}})">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center">
            <h2> shop grid</h2>
            <ul>
                <li><a href="#">home</a></li>
                <li>shop grid</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-page-wrapper shop-page-padding ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop-sidebar mr-50">
                    <div class="sidebar-widget mb-50">
                        <h3 class="sidebar-title">Search Products</h3>
                        <div class="sidebar-search">
                            <form action="#">
                                <input placeholder="Search Products..." type="text">
                                <button><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget mb-40">
                        <h3 class="sidebar-title">Filter by Price</h3>
                        <div class="price_filter">
                            <div id="slider-range"></div>
                            <div class="price_slider_amount">
                                <div class="label-input">
                                    <label>price : </label>
                                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                </div>
                                <button type="button">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget mb-45">
                        <h3 class="sidebar-title">Categories</h3>
                        <div class="sidebar-categories">
                            <ul>
                                @if(isset($categories) && !$categories->isEmpty())
                                @foreach($categories as $category)
                                <li><a href="{{route('category',$category->slug)}}">{{$category->name}} <span>{{$category->countCategory}}</span></a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-product-wrapper res-xl res-xl-btn">
                    <div class="shop-bar-area">
                        <div class="shop-product-content tab-content">
                            <div id="grid-sidebar1" class="tab-pane fade active show">
                                <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-lg-6 col-md-6 col-xl-3">
                                        <div class="product-wrapper mb-30">
                                            <div class="product-img">
                                                <a href="{{route('product.details',$product->id)}}">
                                                    <img src="{{$product->image[0]->image}}" alt="{{$product->name}}"
                                                        style="width:234px;height:175px">
                                                </a>
                                                <span>hot</span>
                                            </div>
                                            <div class="product-content">
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
                                                <h4><a href="{{route('product.details',$product->id)}}">{{substr($product->name,0,20)}}
                                                    </a></h4>
                                                <span>{{$product->price}} &#2547;</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
