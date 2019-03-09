<?php
$sql = "select * from categories where parent != 0";
$res = $con->query($sql);

?>
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
                        <button class="btn btn-secondary dropdown-toggle clk_text" data-toggle="dropdown">
                            <i class="icon-menu text-lg"></i>&nbsp;Categories</button>
                         <div class="dropdown-menu">
                            <ul class="sub-menu cat_clk list-unstyled">
                                <?php
                                while ($row = $res->fetch_assoc()) {
                                    $name = $row["name"];
                                    echo "<li>$name</li>";
                                }
                                    ?>

                            </ul>
                        </div>
                    </div>
                    <form class="input-group" method="get" action="search">
                            <span class="input-group-btn">
                                <button type="submit"><i class="icon-search"></i></button>
                            </span>
                             <input type="hidden" name="cat_search" class="cat_search">
                        <input class="form-control" name="search" type="search" value="<?= ((isset($_GET["search"])) ? $_GET["search"]:"") ?>" placeholder="Search for Products">
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
                <a href="wishlist">
                    <div>
                            <span class="compare-icon"><i class="icon-heart"></i>
                                <span class="count-label wished">0</span>
                            </span><span class="text-label">Wishlist</span>
                    </div>
                </a>
            </div>
            <div class="toolbar-item hidden-on-mobile">
                <?php if (isset($_SESSION["uid"])){ ?>
                    <a href="#">
                       <div><img style="margin: 28px; width: 50px;border-radius: 50%; overflow: hidden;" class="txtAva" data-name="<?=  $cust_data["display_name"]; ?>"></div>

                    </a>
                     <div class="toolbar-dropdown cart-dropdown widget-cart text-center px-3">
                        <div class="entry">
                                <h4 class="entry-title"><a href="user">Profile</a></h4>
                        </div>
                        <div class="entry">
                                <h4 class="entry-title"><a href="order">Orders</a></h4>
                        </div>
                        <div class="entry">
                                <h4 class="entry-title"><a href="wishlist">Wishlist</a></h4>
                        </div>
                        <div class="entry">
                                <h4 class="entry-title"><a href="user">Change Password</a></h4>
                        </div>
                        <div class="entry">
                                <h4 class="entry-title"><a href="logout.php">Logout</a></h4>
                        </div>
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
                <a href="cart">
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
                <form class="input-group" method="get" action="search">
                        <span class="input-group-btn">
                            <button type="submit"><i class="icon-search"></i></button>
                        </span>
                    <input class="form-control" name="search" value="<?= ((isset($_GET["search"])) ? $_GET["search"]:"") ?>" type="search" placeholder="Search Products">
                </form>
            </div>
            <!--Toolbar-->
            <div class="toolbar">
                <div class="toolbar-item">
                    <a href="wishlist">
                        <div>
                                <span class="compare-icon"><i class="icon-heart"></i>
                                    <span class="count-label wished">0</span>
                                </span>
                            <span class="text-label">Wishlist</span>
                        </div>
                    </a>
                </div>
                <div class="toolbar-item">
<?php if (isset($_SESSION["uid"])){ ?>
                    <a href="user">
                        <div>
                            <i class="icon-user"></i>
                            <span class="text-label">Hello,<?=  $cust_data["display_name"]; ?></span>
                        </div>
                    </a>
                    <?php } else { ?>
                    <a href="sign-in.php">
                        <div>
                            <i class="icon-user"></i>
                            <span class="text-label">Sign In / Up</span>
                        </div>
                    </a>
                    <?php } ?>
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