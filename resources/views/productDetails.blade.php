<?php
 $sizes= explode(',',$product->productDetails->size);
 $colors= explode(',',$product->productDetails->color);
?>
@extends('layouts.user.partials.detailsTop')
@section('content')
<!-- header end -->
<div class="breadcrumb-area pt-205 pb-210"
    style="background-image: url('{{$product->image[0]->image}}'); background-repeat:no-repeat;background-size:cover">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>product details</h2>
            <ul>
                <li><a href="{{url('/')}}">home</a></li>
                <li> product details </li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details ptb-100 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-70">
                        <div class="product-details-large tab-content">
                            <?php $i=1; ?>
                            @foreach($product->image as $image)
                            <div class="tab-pane {{($i==1)?'active show':''}} fade" id="pro-details{{$i++}}"
                                role="tabpanel" style="max-width:350px">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{$image->image}}">
                                        <img src="{{$image->image}}" alt="{{$product->name}}">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-details-small nav mt-12" role=tablist>
                            <?php $i=1; ?>
                            @foreach($product->image as $image)
                            <a class="{($i==1)?'active':''}} mr-12" href="#pro-details{{$i++}}" data-toggle="tab"
                                role="tab" aria-selected="true">
                                <img src="{{$image->image}}" alt="{{$product->name}}" style="max-width: 100px">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-content">
                    <h3>{{$product->name}}</h3>
                    <div class="rating-number">
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
                        <div class="quick-view-number">
                            <span>{{$product->rating->count('rating')}} Ratting (S)</span>
                        </div>
                    </div>
                    <div class="details-price">
                        <span>{{$product->price}} BDT</span>
                    </div>
                    <form action="{{route('cart.add',$product->id)}}" method="POST">
                        @csrf
                        <div class="quick-view-select">
                            <div class="select-option-part">
                                <label>Size*</label>
                                <select class="select" name="size">
                                    <option value="">- Please Select -</option>
                                    @foreach($sizes as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-option-part">
                                <label>Color*</label>
                                <select class="select" name="color">
                                    <option value="">- Please Select -</option>
                                    @foreach($colors as $color)
                                    <option value="{{$color}}">{{$color}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="quickview-plus-minus">
                            <div class="cart-plus-minus">
                                <input type="text" value="1" name="quantity" class="cart-plus-minus-box" min="1">
                            </div>
                            <div class="quickview-btn-cart">
                                <input type="submit" value="Add to Cart" class="btn-hover-black bg-dark text-white">
                            </div>
                        </div>
                    </form>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <?php
                                $categories = [$product->category->name];
                                while($product->category->parent != null){
                                    array_push($categories,$product->category->parent->name);
                                    $product->category = $product->category->parent;
                                }
                                $categories = array_reverse($categories);
                            ?>
                            <li class="categories-title">Categories :</li>
                            @foreach($categories as $category)
                            <li><a href="#">{{$category}} >></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-description-review-area pb-90">
    <div class="container">
        <div class="product-description-review text-center">
            <div class="description-review-title nav" role=tablist>
                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                    Description
                </a>
                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                    Reviews ({{$product->rating->count('rating')}})
                </a>
            </div>
            <div class="description-review-text tab-content">
                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                    <p>{{$product->description}}</p>
                </div>
                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                    @if(isset($product->rating))
                    <div class="row justify-content-center">
                        @foreach($product->rating as $rating)
                        <div class="alert alert-info col-md-10 mt-2">
                            <?php
                                $rated = $rating->rating;
                                $unrated = 5-$rated;
                                while($rated > 0){
                                    echo('<span class="fa fa-star" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></span>');
                                    $rated--;
                                }
                                while($unrated > 0){
                                    echo('<span class="fa fa-star-o" style="font-size: 20px;color: #ffd119 !important;margin:5px 2.5px"></span>');
                                    $unrated--;
                                }

                            ?>
                            <p><strong>{{$rating->orderDetails->order->user->name}}</strong> - {{$rating->feedback}}
                                <span class="blockquote-footer">{{$rating->created_at->diffForHumans()}}</span></p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
