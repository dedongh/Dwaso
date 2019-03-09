<?php
include_once "db.php";

if (!is_cust_logged_in()) {
    cust_login_error_redirect();
}

$ip_add =  getUserIP();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128113546-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128113546-2');
</script>

    <meta charset="utf-8">
    <title>Review your Order </title>
    <!-- Mobile Specific Meta Tag-->
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!--Page Content-->
<div class="container padding-bottom-3x padding-top-3x mb-1">
    <div class="row">
        <!-- Checkout Address-->
        <div class="col-xl-9 col-lg-8">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step " href="#"><h4 class="step-title"><i class="icon-check-circle"></i>1. Address</h4></a>
                <a class="step " href="#"><h4 class="step-title"><i class="icon-check-circle"></i>2. Delivery</h4></a>
                <a class="step" href="#"><h4 class="step-title"><i class="icon-check-circle"></i>3. Payment</h4></a>
                <a class="step active" href="#"><h4 class="step-title">4. Review</h4></a>
            </div>
            <h4>Review Your Order</h4>
            <hr class="padding-bottom-1x">
            <div class="table-responsive shopping-cart">
                <?php
                if (isset($_SESSION["uid"])) {
                    //when user is logged in this query will execute
                    $sql = "select a.p_id, a.title, a.quantity, a.price, a.sizes, a.color, a.memory, a.image, b.id, b.qty from products a, cart b where a.p_id = b.p_id and b.uid='$_SESSION[uid]'";
                } else {
                    //when user is not logged in this query will execute
                    $sql = "select a.p_id, a.title, a.quantity, a.price, a.sizes, a.color, a.memory, a.image, b.id, b.qty from products a, cart b where a.p_id = b.p_id and b.ip_add='$ip_add' and b.uid < 0";
                }
                $query = $con->query($sql);

                $sub_total = 0;
                $nI = 0;
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($query->num_rows > 0):
                        while ($row = $query->fetch_array()):
                            $product_id = $row["p_id"];
                            $product_title = $row["title"];
                            $product_price = $row["price"];
                            $product_left = $row["quantity"];
                            $product_image = $row["image"];
                            $cart_item_id = $row["id"];
                            $qty = $row["qty"];
                            $memory = $row["memory"];
                            $size = $row["sizes"];
                            $color = $row["color"];
                        echo '
                    <tr>
                        <td>
                            <div class="product-item">
                                <a class="product-thumb" href="single-item?pid='.$product_id.'&product='.$product_title.'">
                                    <img src="assets/images/shop/products/' . $product_image . '" alt="' . $product_title . '">
                                </a>
                                <div class="product-info">
                                    <h4 class="product-title">
                                        <a href="single-item?pid='.$product_id.'&product='.$product_title.'">' . $product_title . '<small>x '.$qty.'</small></a></h4>
                                    <span><em>Memory:</em> ' . $memory . '</span><span><em>Color:</em> ' . $color . '</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-lg">'.money($product_price).'</td>
                        <td class="text-center">
                            <a class="btn btn-outline-primary btn-sm" href="cart">Edit</a>
                        </td>
                    </tr>';
                            $sub_total += $qty * $product_price;

                            $grand_total = $sub_total + TAXRATE + DELIVERY;
                            $nI++;
                    endwhile; endif;
                    $_SESSION["grand_total"] = $grand_total;
                    $_SESSION["sub_total"] = $sub_total;
                    $_SESSION["n"] = $nI;
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="shopping-cart-footer">
                <div class="column"></div>
                <div class="column text-lg">
                    <span class="text-muted">Subtotal:&nbsp; </span><span class="text-gray-dark"><?= money($grand_total) ?></span>
                </div>
            </div>
            <div class="row padding-top-1x mt-3">
                <div class="col-sm-6">
                    <h5>Delivering to:</h5>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Client:&nbsp; </span><?= $_SESSION["full_name"]; ?></li>
                        <li><span class="text-muted">Address:&nbsp; </span><?= $_SESSION["address"] ?></li>
                        <li><span class="text-muted">Phone:&nbsp; </span><?= $_SESSION["phone"] ?></li>
                        <li><span class="text-muted">Email:&nbsp; </span><?= $_SESSION["email"] ?></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <h5>Payment method:</h5>
                    <ul class="list-unstyled">
                        <li><span class="text-muted">Payment on Delivery&nbsp; </span></li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                <a class="btn btn-outline-secondary" href="cart">
                    <i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back To Cart</span>
                </a>
                <a class="btn btn-primary" href="complete"><span class="hidden-xs-down">Complete Order&nbsp;</span>
                    <i class="icon-arrow-right"></i>
                </a>
            </div>
        </div>
        <!-- Sidebar-->
        <div class="col-xl-3 col-lg-4">
            <aside class="sidebar">
                <div class="padding-top-2x hidden-lg-up"></div>
                <!-- Order Summary Widget-->
                <section class="widget widget-order-summary">
                    <h3 class="widget-title">Order Summary</h3>
                    <table class="table checkout-prices">

                    </table>
                </section>
                <!-- Featured Products Widget-->
                <h3 class="widget-title">Recently Viewed</h3>
                <section class="widget widget-featured-products viewed">

                </section>
                <!-- Promo Banner-->
                <a class="card border-0 bg-secondary" href="#">
                    <div class="card-body">
                        <span class="d-block text-lg text-thin mb-2">Limited Time Deals</span>
                        <h3>Samsung Galaxy S9+</h3>
                        <p class="d-inline-block bg-warning text-white">&nbsp;&nbsp;Shop Now&nbsp;<i class="icon-chevron-right d-inline-block align-middle"></i>&nbsp;</p>
                    </div>
                    <img class="d-block mx-auto" src="assets/images/shop/widget/02.jpg" alt="Surface Pro">
                </a>
            </aside>
        </div>
    </div>
</div>
<!--footer-->
<?php include_once "includes/footer.php"?>
</body>
</html>