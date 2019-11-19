<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{route('admin.index')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
            </li>
            <li class="menu-title">Manage  User</li><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fa fa-user-plus"></i>Seller Management</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-user"></i><a href="{{route('activeseller.list')}}">Active Seller</a></li>
                    <li><i class="fa fa-user"></i><a href="{{route('inactiveseller.list')}}">Inactive Seller</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fa fa-product-hunt"></i>All Porducts</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-table"></i><a href="{{route('admin.sellerList')}}">Products</a></li>
                </ul>
            </li>      
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
