<header class="site-header  navbar-sticky">
    <div class="navbar">

        <nav class="site-menu">

            <ul>
                <li class="active">
                    <a class="active" href="index.php">Home</a>
                </li>
                <li class="has-submenu">
                    <a href="products.php">Products</a>
                    <ul class="sub-menu">
                        <li class="disabled"><a href="archived.php">Archived</a></li>
                    </ul>
                </li>
                <li><a href="brands.php">Brands</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="comments.php">Reviews</a></li>
                <?php if (has_permission("admin")): ?>
                    <li><a href="user_permissions.php">Users</a></li>
                <?php endif;?>
                <li class="has-submenu">
                    <a href="#"><span class="icon-user"></span> <?= $user_data["first"] ?></a>
                    <ul class="sub-menu">
                        <li ><a href="admin_pwd_chg.php">Change Password</a></li>
                        <li ><a href="admin_logout.php">Log Out</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="#" class="dropdown-toggle not_clk" data-toggle="dropdown" >
                        <span class="count-label bg-info text-white not_cnt">0</span>
                        Notifications
                    </a>
                    <ul class="dropdown-menu notes">

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>