<?php
include_once "db.php";
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


    <title>GiloShop | Cart</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php  include_once "includes/nav.php"; ?>
<!-- Page Title-->

<!--Page Content-->
<div class="container padding-bottom-3x mb-1 padding-top-2x">
    
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
            <tr>
                <th>Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Price ₵</th>
                <th class="text-center">Subtotal ₵</th>
                <th class="text-center">
                    <a class="btn btn-sm btn-outline-danger clearAll" href="#">Clear Cart</a>
                </th>
            </tr>
            </thead>
            <tbody class="cartCheckout">
            <!--display cart info-->
            </tbody>
        </table>
    </div>
    <div class="shopping-cart-footer">
        <div class="column">
            <form class="coupon-form" method="post">
                <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required>
                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button>
            </form>
        </div>
        <div class="column text-lg">
            <span class="text-muted">Total:&nbsp; </span>
            <span class="text-gray-dark ">₵<span class="net_total"></span> </span></div>
    </div>
    <div class="shopping-cart-footer">
        <div class="column"><a class="btn btn-outline-secondary" href="grid-view"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
        <div class="column">
            <!-- verify if user is auth-->
            <a class="btn btn-primary" href="address">Checkout</a>
        </div>
    </div>
    <!-- Related Products Carousel-->
    <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">You May Also Like</h3>
    <!-- Carousel-->
    <?php
    $featured = "Select * from products where tags = 'Featured' and deleted = 0 order by p_id desc limit 8 ";
    $ftQ = $con->query($featured);
    ?>
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false,
&quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},
&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <?php
        if (mysqli_num_rows($ftQ) > 0):
            while ($row = $ftQ->fetch_assoc()):
                $pro_id = $row["p_id"];
                $image = $row["image"];
                $lp = $row["list_price"];
                $price = $row["price"];
                $status = $row["status"];
                $title = $row["title"];
                $cat = $row["c_id"];

                //$format = money($price);

                //$lp = money($lp);

                $cc = "select name from categories where c_id = '$cat'";
                $c = $con->query($cc);
                $nm = $c->fetch_assoc();
                $cccc = $nm["name"];
                if ($status != null AND $lp != null) {
                    echo '
    <div class="product-card">
        <div class="product-badge bg-danger">'.$status.'</div>
        <a class="product-thumb" href="single-item?pid='.$pro_id.'&product='.$title.'">
            <img src="assets/images/shop/products/'.$image.'" alt="'.$title.'">
        </a>
        <div class="product-card-body">
            <div class="product-category"><a href="#">'.$cccc.'</a></div>
            <h3 class="product-title"><a href="single-item?pid='.$pro_id.'&product='.$title.'">'.$title.'</a></h3>
            <h4 class="product-price">
                <del>'.money($lp).'</del>'.money($price).'
            </h4>
        </div>
        <div class="product-button-group">
            <a pid='.$pro_id.' id="wishlists" remove_id='.$pro_id.' class="product-button " href="#">
                <i class="icon-heart"></i><span>Wishlist</span></a>
            <a pid='.$pro_id.' class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a>
            <a pid='.$pro_id.' id="products" class="product-button" href="#" "><i class="icon-shopping-cart"></i><span>To Cart</span>
            </a>
        </div>
    </div>
    ';
                }else{
                    echo '
    <div class="product-card">

        <a class="product-thumb" href="single-item?pid='.$pro_id.'&product='.$title.'">
            <img src="assets/images/shop/products/'.$image.'" alt="'.$title.'">
        </a>
        <div class="product-card-body">
            <div class="product-category"><a href="#">'.$cccc.'</a></div>
            <h3 class="product-title"><a href="single-item?pid='.$pro_id.'&product='.$title.'">'.$title.'</a></h3>
            <h4 class="product-price">
               '.money($price).'
            </h4>
        </div>
        <div class="product-button-group">
            <a pid='.$pro_id.' id="wishlists" remove_id='.$pro_id.' class="product-button " href="#">
                <i class="icon-heart"></i><span>Wishlist</span></a>
            <a pid='.$pro_id.' class="product-button btn-compare" href="#"><i class="icon-repeat"></i><span>Compare</span></a>
            <a pid='.$pro_id.' id="products" class="product-button" href="#" "><i class="icon-shopping-cart"></i><span>To Cart</span>
            </a>
        </div>
    </div>
    ';
                }
                ?>
                <!-- Product-->

            <?php endwhile; endif; ?>
    </div>

</div>

<!--footer-->
<?php include_once "includes/footer.php" ?>
</body>
</html>