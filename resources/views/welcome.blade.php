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
                            <i class="icofont icofont-star yellow"></i>
                            <i class="icofont icofont-star yellow"></i>
                            <i class="icofont icofont-star yellow"></i>
                            <i class="icofont icofont-star yellow"></i>
                            <i class="icofont icofont-star"></i>
                        </div>
                        <h4><a href="{{route('product.details',$product->id)}}">{{substr($product->description,0,20)}}....</a></h4>
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

    <div class="best-selling-area pb-95">
        <div class="section-title-4 text-center mb-60">
            <h2>Best Selling</h2>
        </div>
        <div class="best-selling-product">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="best-selling-left">
                        <div class="product-wrapper">
                            <div class="product-img-4">
                                <a href="#"><img src="frontend/img/product/electro/9.jpg" alt=""></a>
                                <div class="product-action-right">
                                    <a class="animate-top" title="Add To Cart" href="#">
                                        <i class="pe-7s-cart"></i>
                                    </a>
                                    <a class="animate-left" title="Wishlist" href="#">
                                        <i class="pe-7s-like"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-5 text-center">
                                <div class="product-rating-4">
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                    <i class="icofont icofont-star yellow"></i>
                                </div>
                                <h4><a href="product-details.html">desktop C27F551</a></h4>
                                <span>Headphone</span>
                                <h5>$133.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="best-selling-right">
                        <div class="custom-container">
                            <div class="coustom-row-3">
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/10.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Play Station</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/11.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Joy Stick</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/12.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Awesome Tab</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/13.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <h4><a href="product-details.html">Trimmer C27F401</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/14.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="product-details.html">Timer C27F500</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="#">
                                                <img src="frontend/img/product/electro/15.jpg" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a class="animate-top" title="Add To Cart" href="#">
                                                    <i class="pe-7s-cart"></i>
                                                </a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <h4><a href="product-details.html">Joy Stick</a></h4>
                                            <h5>$145.00</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
