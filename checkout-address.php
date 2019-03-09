<?php
include_once "db.php";
if (!is_cust_logged_in()) {
    cust_login_error_redirect();
}
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
    <title>Billing Address</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; 

$uid = $_SESSION["uid"];
$sql = "select * from user_info where uid = '$uid'";
$res = $con->query($sql);
$row = $res->fetch_assoc();
$fname = $row["first_name"];
$lname = $row["last_name"];
$email = $row["email"];
$phn = $row["phone"];

?>

<!--Page Content-->
<div class="container padding-bottom-3x padding-top-3x mb-1">
    <div class="row">
        <!-- Checkout Address-->
        <div class="col-xl-9 col-lg-8">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step active" href="#"><h4 class="step-title">1. Address</h4></a>
                <a class="step" href="#"><h4 class="step-title">2. Delivery</h4></a>
                <a class="step" href="#"><h4 class="step-title">3. Payment</h4></a>
                <a class="step" href="#"><h4 class="step-title">4. Review</h4></a>
            </div>
            <h4>Delivery Address</h4>
            <hr class="padding-bottom-1x">
            <span class="bg-danger text-white" id="addr_err"></span>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-fn">First Name</label>
                        <input class="form-control" value="<?= ((isset($_POST["checkout_first_name"]))?sanitize($_POST["checkout_first_name"]): $fname) ?>" name="checkout_first_name" type="text" id="checkout-fn">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-ln">Last Name</label>
                        <input class="form-control" value="<?= ((isset($_POST["checkout_last_name"]))?sanitize($_POST["checkout_last_name"]): $lname) ?>" name="checkout_last_name" type="text" id="checkout-ln">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-email">E-mail Address</label>
                        <input class="form-control" value="<?= ((isset($_POST["checkout_email"]))?sanitize($_POST["checkout_email"]): $email) ?>" name="checkout_email" type="email" id="checkout-email">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-phone">Phone Number</label>
                        <input class="form-control" value="<?= ((isset($_POST["checkout_phone"]))?sanitize($_POST["checkout_phone"]): $phn) ?>" name="checkout_phone" type="text" id="checkout-phone">
                    </div>
                </div>
            </div>
            <div class="row padding-bottom-1x">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-address1">Region</label>
                        <select class="form-control" name="checkout_address1" id="checkout-address1">
                            <option value="Greater Accra">Greater Accra</option>
                            <option value="Ashanti Region">Ashanti Region</option>
                            <option value="Volta Region">Volta Region</option>
                            <option value="Central Region">Central Region</option>
                            <option value="Western Region">Western Region</option>
                            <option value="Northern Region">Northern Region</option>
                            <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                            <option value="Eastern Region">Eastern Region</option>
                            <option value="Upper West Region">Upper West Region</option>
                            <option value="Upper East Region">Upper East Region</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="checkout-address2">City</label>
                        <input class="form-control" value="<?= ((isset($_POST["checkout_address2"]))?sanitize($_POST["checkout_address2"]):"") ?>" name="checkout_address2" type="text" id="checkout-address2">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                <a class="btn btn-outline-secondary" href="cart">
                    <i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back To Cart</span>
                </a>
                <a class="btn btn-primary" href="#" id="chk_addr"><span class="hidden-xs-down">Continue&nbsp;</span>
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
                        <span class="d-block text-lg widget-title text-thin mb-2">Limited Time Deals</span>
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
<?php include_once "includes/footer.php" ?>

</body>
</html>