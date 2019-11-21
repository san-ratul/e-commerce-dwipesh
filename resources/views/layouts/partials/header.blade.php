<header>
    <div class="header-top-wrapper-2 border-bottom-2">
        <div class="header-info-wrapper pl-200 pr-200">
            <div class="header-contact-info">
                <ul>
                    <li><i class="pe-7s-call"></i> +011 2231 4545</li>
                    <li><i class="pe-7s-mail"></i> <a href="#">easybazar@gmail.com</a></li>
                </ul>
            </div>
            <div class="electronics-login-register">
                <ul>
                    <li><a href="{{route('login')}}"><i class="pe-7s-users"></i>My Account</a></li>
                    <li><a data-toggle="modal" data-target="#exampleCompare" href="#"><i class="pe-7s-repeat"></i>Compare</a></li>
                    <li><a href="wishlist.html"><i class="pe-7s-like"></i>Wishlist</a></li>
                    <li><a href="#"><i class="pe-7s-flag"></i>US</a></li>
                    <li><a class="border-none" href="#"><span>$</span>USD</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom pt-40 pb-30 clearfix">
        <div class="header-bottom-wrapper pr-200 pl-200">
            <div class="logo-3">
                <a href="{{url('/')}}">
                    <!-- <img src="frontend/img/logo/logo-3.png" alt="" > -->
                    <h2 style="font-weight:bold;">Easy Bazar</h2>
                </a>
            </div>
            <div class="categories-search-wrapper">
                <div class="all-categories">
                    <div class="select-wrapper">
                        <select class="select">
                            <option value="">All Categories</option>
                            <option value="">Smartphones </option>
                            <option value="">Computers</option>
                            <option value="">Laptops </option>
                            <option value="">Camerea </option>
                            <option value="">Watches</option>
                            <option value="">Lights </option>
                            <option value="">Air conditioner</option>
                        </select>
                    </div>
                </div>
                <div class="categories-wrapper">
                    <form action="#">
                        <input placeholder="Enter Your key word" type="text">
                        <button type="button"> Search </button>
                    </form>
                </div>
            </div>
            <div class="trace-cart-wrapper">
                <div class="trace same-style">
                    <div class="same-style-icon">
                        <a href="#"><i class="pe-7s-plane"></i></a>
                    </div>
                    <div class="same-style-text">
                        <a href="#">Product <br>trace</a>
                    </div>
                </div>
                <div class="categories-cart same-style">
                    <div class="same-style-icon">
                        <a href="#"><i class="pe-7s-cart"></i></a>
                    </div>
                    <div class="same-style-text">
                        <a href="cart.html">My Cart <br>02 Item</a>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area electro-menu d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="#">HOME</a>
                            </li>
                            <li><a href="#">pages</a>
                            </li>
                            <li><a href="#">shop</a>

                            </li>
                            <li><a href="#">BLOG</a>
                            </li>
                            <li><a href="#"> Contact </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>