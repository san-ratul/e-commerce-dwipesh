<?php
$categories = App\ProductCategory::all();
?>
<div class="categories-menu">
    <div class="category-heading">
        <h3> All Departments <i class="pe-7s-angle-down"></i></h3>
    </div>
    @if(!$categories->isEmpty())
    <div class="category-menu-list">
        <ul>
            @foreach($categories as $category)
            @if($category->parent == null)
            <li>
                <a href="#">{{$category->name}} <i class="pe-7s-angle-right"></i></a>
                @if(isset($category->children) && !$category->children->isEmpty())
                <div class="category-menu-dropdown" style="width:300px; top:-30px"> 
                    <div class="category-dropdown-style category-common4 mb-40">
                        <h4 class="categories-subtitle">{{$category->name}}</h4>
                        <ul>
                            @foreach($category->children as $childCategory)
                            <li><a href="#">{{$childCategory->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    @endif
</div>