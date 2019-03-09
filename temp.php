<?php
include_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Gideon's Specs</title>
    <?php include_once "includes/header.php"?>
</head>
<body>

<header class="site-header navbar-sticky ">
    <!--TopBar-->
    <div class="topbar d-flex justify-content-between">
        <!--Logo-->
        <div class="site-branding d-flex">
            <a class="site-logo align-self-center" href="home">
                <img src="assets/images/logo/logo.jpg" alt="GiLo">
            </a>
        </div>
        <!--Search / Categories-->
        <div class="search-box-wrap d-flex">
            <div class="search-box-inner align-self-center">
                <div class="search-box d-flex">
                    <div class="btn-group categories-btn">
                        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-menu text-lg"></i>&nbsp;Categories</button>
                        <div class="dropdown-menu mega-dropdown">
                            <!--get category from db-->
                            <div class="get_category"></div>
                        </div>
                    </div>
                    <form class="input-group" method="post" action="search">
                            <span class="input-group-btn">
                                <button type="submit"><i class="icon-search"></i></button>
                            </span>
                        <input class="form-control" name="search" type="search" placeholder="Search for Products">
                    </form>
                </div>
            </div>
        </div>
        <!--Toolbar-->
        <div class="toolbar d-flex">
            <div class="toolbar-item visible-on-mobile mobile-menu-toggle">
                <a href="#">
                    <div><i class="icon-menu"></i>
                        <span class="text-label">Menu</span>
                    </div>
                </a>
            </div>
            <div class="toolbar-item hidden-on-mobile">
                <a href="#">
                    <div>
                            <span class="compare-icon"><i class="icon-repeat"></i>
                                <span class="count-label uCart">0</span>
                            </span><span class="text-label">Compare</span>
                    </div>
                </a>
            </div>
            <div class="toolbar-item hidden-on-mobile">
                <?php if (isset($_SESSION["uid"])){ ?>
                    <a href="#">
                        <div>
                            <i class="icon-user"></i>
                            <span class="text-label"><?=  $cust_data["display_name"]; ?></span>
                        </div>
                    </a>
                    <div class="toolbar-dropdown text-center px-3">
                        <p class="text-label"><a href="#">Profile</a></p>
                        <p><a href="order">Orders</a></p>
                        <p><a href="wishlist">Wishlist</a></p>
                        <p><a href="user">Change Password</a></p>
                        <p><a href="logout.php">Logout</a></p>

                    </div>

                <?php } else { ?>

                    <a href="sign-in.php">
                        <div>
                            <i class="icon-user"></i>
                            <span class="text-label">Sign In / Up</span>
                        </div>
                    </a>
                    <div class="toolbar-dropdown text-center px-3">
                        <p class="text-xs mb-3 pt-2">Sign in to your account or register new one to have full control over your orders, receive bonuses and more.</p>
                        <a class="btn btn-primary btn-sm btn-block" href="sign-in.php">Sign In</a>
                        <p class="text-xs text-muted mb-2">New customer?&nbsp;
                            <a href="sign-in.php">Register</a>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="toolbar-item">
                <a href="#">
                    <div>
                            <span class="cart-icon"><i class="icon-shopping-cart"></i>
                                <span class="count-label badges">0</span>
                            </span>
                        <span class="text-label">Cart</span>
                    </div>
                </a>
                <div class="toolbar-dropdown cart-dropdown widget-cart hidden-on-mobile cart_product">
                    <!--display cart items-->
                </div>
            </div>
        </div>
        <!--Mobile Menu-->
        <div class="mobile-menu">
            <!--Search Box-->
            <div class="mobile-search">
                <form class="input-group" method="post" action="search">
                        <span class="input-group-btn">
                            <button type="submit"><i class="icon-search"></i></button>
                        </span>
                    <input class="form-control" name="search" type="search" placeholder="Search Products">
                </form>
            </div>
            <!--Toolbar-->
            <div class="toolbar">
                <div class="toolbar-item">
                    <a href="#">
                        <div>
                                <span class="compare-icon"><i class="icon-repeat"></i>
                                    <span class="count-label">0</span>
                                </span>
                            <span class="text-label">Compare</span>
                        </div>
                    </a>
                </div>
                <div class="toolbar-item">
                    <a href="sign-in.php">
                        <div>
                            <i class="icon-user"></i>
                            <span class="text-label">Sign In / Up</span>
                        </div>
                    </a>
                </div>
            </div>
            <!--Slideable (Mobile)  Menu-->
            <nav class="slideable-menu">
                <ul class="menu" data-initial-height="385">
                    <li class="has-children active"><span>
                                <a href="home">Home</a></span>
                    </li>
                    <li class="has-children"><span>
                                <a href="grid-view">Shop</a><span class="sub-menu-toggle"></span></span>
                        <ul class="slideable-submenu">
                            <li><a href="grid-view">Products</a></li>
                            <li><a href="cart">Cart</a></li>
                            <li><a href="address">Checkout</a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                            <span><a href="#">Categories</a>
                                <span class="sub-menu-toggle"></span>
                            </span>
                        <ul class="slideable-submenu">
                            <li class="cat_tool"></li>
                        </ul>
                    </li>
                    <li class="has-children"><span>
                            <a href="#">Account</a><span class="sub-menu-toggle"></span></span>
                        <?php if (isset($_SESSION["uid"])) { ?>
                            <ul class="slideable-submenu">
                                <li><a href="order">Orders List</a></li>
                                <li><a href="wishlist">Wishlist</a></li>
                                <li><a href="user">Profile Page</a></li>
                            </ul>
                        <?php } else{ ?>
                            <ul class="slideable-submenu">
                                <li><a href="sign-in">Login / Register</a></li>
                                <li><a href="password-recovery">Password Recovery</a></li>
                            </ul>
                        <?php } ?>
                    </li>

                    <li class="has-children"><span>
                                <a href="about">About Us</a><span class="sub-menu-toggle"></span></span>
                        <ul class="slideable-submenu">
                            <li><a href="contact">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</header>

<!-- Main Slider-->
<section class="hero-slider" style="background-image: url(assets/images/slider/main-bg.jpg);">
    <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        <div class="item">
            <div class="container padding-top-3x">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                        <div class="from-bottom"><img class="d-inline-block w-150 mb-4" src="assets/images/slider/logo02.png" alt="Puma">
                            <div class="h2 text-body mb-2 pt-1">Google Home - Smart Speaker</div>
                            <div class="h2 text-body mb-4 pb-1">starting at <span class="text-medium">Gh₵129.00</span></div>
                        </div><a class="btn btn-primary scale-up delay-1" href="shop-grid-ls.html">View Offers&nbsp;<i class="icon-arrow-right"></i></a>
                    </div>
                    <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="assets/images/slider/02.png" alt="Puma Backpack"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="container padding-top-3x">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                        <div class="from-bottom"><img class="d-inline-block w-150 mb-3" src="assets/images/slider/logo01.png" alt="Sony">
                            <div class="h2 text-body mb-2 pt-1">Modern Powerful Laptop</div>
                            <div class="h2 text-body mb-4 pb-1">for only <span class="text-medium">Gh₵1,459.99</span></div>
                        </div><a class="btn btn-primary scale-up delay-1" href="shop-single.html">Shop Now&nbsp;<i class="icon-arrow-right"></i></a>
                    </div>
                    <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="assets/images/slider/01.png" alt="Chuck Taylor All Star II"></div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="container padding-top-3x">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                        <div class="from-bottom"><img class="d-inline-block w-150 mb-3" src="assets/images/slider/logo03.png" alt="Motorola">
                            <div class="h2 text-body mb-2 pt-1">Beats Studio by Dr.Dre</div>
                            <div class="h2 text-body mb-4 pb-1">for only <span class="text-medium">Gh₵349.50</span></div>
                        </div><a class="btn btn-primary scale-up delay-1" href="shop-single.html">Shop Now&nbsp;<i class="icon-arrow-right"></i></a>
                    </div>
                    <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="assets/images/slider/03.png" alt="Moto 360"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Categories-->
<div class="container padding-top-1x ">
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="shop-grid-ls.html">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/04.jpg" alt="Category"></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/05.jpg" alt="Category"><img src="assets/images/shop/categories/06.jpg" alt="Category"></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Smartphones &amp; Tablets</h4>
                    <p class="text-xs text-muted">Starting from &nbsp;<span class='card-label'>GH₵ 78.00</span></p><a class="btn btn-outline-primary btn-sm" href="shop-grid-ls.html">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="shop-grid-ls.html">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/04.jpg" alt="Category"></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/05.jpg" alt="Category"><img src="assets/images/shop/categories/06.jpg" alt="Category"></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Computers &amp; Accessories</h4>
                    <p class="text-xs text-muted">Starting from &nbsp;<span class='card-label'>GH₵ 78.00</span></p><a class="btn btn-outline-primary btn-sm" href="shop-grid-ls.html">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="shop-grid-ls.html">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/04.jpg" alt="Category"></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/05.jpg" alt="Category"><img src="assets/images/shop/categories/06.jpg" alt="Category"></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Slightly Used Phones &amp; Laptops</h4>
                    <p class="text-xs text-muted">Starting from &nbsp;<span class='card-label'>GH₵ 78.00</span></p><a class="btn btn-outline-primary btn-sm" href="shop-grid-ls.html">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Featured-->
<section class="container cunt bg-white padding-top-1x padding-bottom-1x mb-30">
    <h2 class="h3 text-left">Featured Products</h2>
    <!-- Carousel-->
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true,  &quot;loop&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <!-- Product-->
        <div class="product-card">
            <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                    Gh₵ 49.99
                </h4>
            </div>
        </div>
        <!-- Product-->
        <div class="product-card">
            <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star"></i>
            </div>
            <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                    <del>Gh₵ 62.00</del>Gh₵ 49.99
                </h4>
            </div>
        </div>
        <!-- Product-->
        <div class="product-card">
            <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                   Gh₵ 49.99
                </h4>
            </div>
        </div>
        <!-- Product-->
        <div class="product-card">
            <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                    <del>Gh₵ 62.00</del>Gh₵ 49.99
                </h4>
            </div>
        </div>
        <!-- Product-->
        <div class="product-card">
            <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                    Gh₵ 49.99
                </h4>
            </div>
        </div>
        <!-- Product-->
        <div class="product-card">
            <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i>
            </div>
            <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
            <div class="product-card-body">
                <div class="product-category"><a href="#">Smart home</a></div>
                <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                <h4 class="product-price">
                    <del>Gh₵ 62.00</del>Gh₵ 49.99
                </h4>
            </div>
        </div>

    </div>
    <div class="text-center">
        <a class="btn btn-outline-secondary" href="grid-view">View All Products</a>
    </div>
</section>

<!--Recommended Products-->
<section class="container cunt bg-white padding-top-2x  mb-30">
    <h2 class="h3 pb-3 text-left">Recommended Products</h2>
    <ul class="nav nav-tabs justify-content-center" role="tablist">
        <li class="nav-item"><a class="nav-link active" href="#home3" data-toggle="tab" role="tab"><img src="assets/images/brands/01.jpg" alt="e" width="50" height="50"></a></li>
        <li class="nav-item"><a class="nav-link" href="#profile3" data-toggle="tab" role="tab"><img src="assets/images/brands/07.png" alt="e" width="50" height="50"></a></li>
        <li class="nav-item"><a class="nav-link" href="#settings3" data-toggle="tab" role="tab"><img src="assets/images/brands/03.png" alt="e" width="50" height="50"></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="home3" role="tabpanel">
            <div class="row">
                <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true,  &quot;loop&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                    <!-- Product-->
                    <div class="product-card">
                        <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/04.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile3" role="tabpanel">
            <div class="row">
                <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true,  &quot;loop&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                    <!-- Product-->
                    <div class="product-card">
                        <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <div class="product-badge bg-danger">Sale</div><a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>
                    <!-- Product-->
                    <div class="product-card">
                        <a class="product-thumb" href="shop-single.html"><img src="assets/images/shop/products/07.jpg" alt="Product"></a>
                        <div class="product-card-body">
                            <div class="product-category"><a href="#">Smart home</a></div>
                            <h3 class="product-title"><a href="shop-single.html">Echo Dot (2nd Generation)</a></h3>
                            <h4 class="product-price">
                                <del>Gh₵ 62.00</del>Gh₵ 49.99
                            </h4>
                        </div>
                    </div>

                </div>
            </div>        </div>
        <div class="tab-pane fade" id="settings3" role="tabpanel">
            <p>Aboa me nim deir me di b3hy3 ho</p>
        </div>
    </div>
</section>

<!--Hot Deals-->
<section class="fw-section padding-top-4x padding-bottom-8x" style="background-image: url(assets/images/banners/mac.jpg);">
    <span class="overlay" style="opacity: .7;"></span>
    <div class="container text-center">
        <div class="d-inline-block bg-danger text-white text-lg py-2 px-3 rounded">Limited Time Offer</div>
        <div class="display-4 text-white py-4">Apple MacBook Pro 2018</div>
        <!--<div class="d-inline-block w-200 pt-2">
            <img class="d-block w-100" src="assets/images/banners/applogo.png" alt="Canon"></div>-->
        <div class="pt-5"></div>
        <div class="countdown countdown-inverse" data-date-time="07/30/2018 12:00:00">
            <div class="item">
                <div class="days">00</div><span class="days_ref">Days</span>
            </div>
            <div class="item">
                <div class="hours">00</div><span class="hours_ref">Hours</span>
            </div>
            <div class="item">
                <div class="minutes">00</div><span class="minutes_ref">Mins</span>
            </div>
            <div class="item">
                <div class="seconds">00</div><span class="seconds_ref">Secs</span>
            </div>
        </div>
    </div>
</section>
<a class="d-block position-relative mx-auto" href="shop-grid-ls.html" style="max-width: 682px; margin-top: -130px; z-index: 10;">
    <img class="d-block w-100" src="assets/images/banners/shop-banner-02.png" alt="Printers">
</a>
<!--Brands-->
<section class="bg-white padding-top-1x padding-bottom-2x">
    <div class="container">
        <h2 class="h3 text-center mb-30 pb-3">Popular Brands</h2>
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000,
&quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},
&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/01.jpg" alt="IBM">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/02.png" alt="Sony">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/03.png" alt="HP">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/04.jpg" alt="Canon">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/5b7cef4b78ccb7.88802229.jpg" alt="Bosh">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/06.png" alt="Dell">
            <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/07.png" alt="Samsung">
        </div>
    </div>
</section>

<!-- Services-->
<section class="container padding-top-3x padding-bottom-2x">
    <div class="row">
        <div class="col-md-3 col-sm-6 text-center mb-30">
            <img class="d-block  img-thumbnail rounded mx-auto mb-4" src="assets/images/services/05.png" alt="Shipping" >
            <h6 class="mb-2">Fast Nation Wide Delivery</h6>
            <p class="text-sm text-muted mb-0">Free shipping for all orders over ₵1,000</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30">
            <img class="d-block  img-thumbnail rounded mx-auto mb-4" src="assets/images/services/06.png" alt="Money Back" >
            <h6 class="mb-2">Money Back Guarantee</h6>
            <p class="text-sm text-muted mb-0">We return money within 30 days</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30">
            <img class="d-block img-thumbnail rounded mx-auto mb-4" src="assets/images/services/07.png" alt="Support" >
            <h6 class="mb-2">24/7 Customer Support</h6>
            <p class="text-sm text-muted mb-0">Friendly 24/7 customer support</p>
        </div>
        <div class="col-md-3 col-sm-6 text-center mb-30">
            <img class="d-block img-thumbnail rounded mx-auto mb-4" src="assets/images/services/08.png" alt="Payment">
            <h6 class="mb-2">Secure Online Payment</h6>
            <p class="text-sm text-muted mb-0">We possess SSL / Secure Certificate</p>
        </div>
    </div>
</section>

<?php include_once "includes/footer.php"?>
</body>
</html>