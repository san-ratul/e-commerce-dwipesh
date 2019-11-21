<?php
$sliders = App\Slider::all();
?>
<div class="menu-slider-wrapper">
    <div class="menu-style-3 menu-hover text-center">
        <nav>
            <ul>
                <li><a href="{{route('/')}}">home <i class="pe-7s-angle-down"></i></a>
                   
                </li>
                <li><a href="#">pages </a>
                    
                </li>
                <li><a href="#">shop <i class="pe-7s-angle-down"></i></a>
                </li>
                <li><a href="#">blog <i class="pe-7s-angle-down"></i></a>
                    
                </li>
                <li><a href="#">contact</a></li>
            </ul>
        </nav>
    </div>
    <div class="slider-area">
        <div class="slider-active owl-carousel">
        @if(!$sliders->isEmpty())
        @foreach($sliders as $slider)
            <div class="single-slider single-slider-hm3 bg-img pt-170 pb-173" style="background-image: url('{{$slider->image}}');height:668px;">
                <div class="slider-animation slider-content-style-3 fadeinup-animated text-center">
                    <h2 class="animated" style="color:#fff; margin-button:5px;">Welcome to Easy Bazar</h2>
                    <a class="electro-slider-btn btn-hover" href="#">buy now</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>