<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{route('admin.index')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
            </li>
            <li class="menu-title">Product Management</li><!-- /.menu-title -->
            <li>
                <a href="{{route('category.index')}}"><i class="menu-icon fa fa-tasks"></i>Category </a>
                <a href="{{route('product.add')}}"><i class="menu-icon fa fa-plus"></i>Add Product</a>
                <a href="{{route('seller.product',auth()->user()->id)}}"><i class="menu-icon fa fa-product-hunt"></i>Show Products</a>
            </li>
           

        
        

          
           
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
