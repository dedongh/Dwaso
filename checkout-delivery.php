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
    <title>Delivery </title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!--Page Content-->
<div class="container padding-bottom-3x padding-top-3x mb-1">
    <div class="row">
        <!-- Checkout Adress-->
        <div class="col-xl-9 col-lg-8">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step " href="address"><h4 class="step-title"><i class="icon-check-circle"></i>1. Address</h4></a>
                <a class="step active" href="#"><h4 class="step-title">2. Delivery</h4></a>
                <a class="step" href="#"><h4 class="step-title">3. Payment</h4></a>
                <a class="step" href="#"><h4 class="step-title">4. Review</h4></a>
            </div>
            <h4>Choose Delivery Method</h4>
            <hr class="padding-bottom-1x">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-default">
                    <tr>
                        <th></th>
                        <th>Delivery method</th>
                        <th>Delivery time</th>
                        <th>Handling fee</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="align-middle">
                            <div class="custom-control custom-radio mb-0">
                                <input class="custom-control-input" checked type="radio" id="locker" name="shipping-method" value="0">
                                <label class="custom-control-label" for="locker"></label>
                            </div>
                        </td>
                        <td class="align-middle"><span class="text-gray-dark">Gilo Delivery Services</span><br>
                            <span class="text-muted text-sm">All Addresses(default zone), Accra & Kumasi</span></td>
                        <td class="align-middle">&mdash;</td>
                        <td class="align-middle">Free</td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <div class="custom-control custom-radio mb-0">
                                <input class="custom-control-input" type="radio" id="global" name="shipping-method" value="27">
                                <label class="custom-control-label" for="global"></label>

                            </div>
                        </td>
                        <td class="align-middle"><span class="text-gray-dark">Store Pickup</span><br>
                            <span class="text-muted text-sm">Come with a valid ID card and your order ID</span>
                            <form method="get" action="checkout-delivery.php">
                            <select class="form-control" name="pickup">
                                <option>select pickup location</option>
                                <option value="Kumasi">Kumasi Adum adjacent Aseda House</option>
                                <option value="Accra">Circle Mall, Accra</option>
                                <option value="Tarkwa">Tarkwa, Umat Campus</option>
                                <option value="Cape Coast">Cape Coast, UCC Campus</option>
                                <option value="Bekwai">Bekwai / Bibiani</option>
                                <option value="Wa">Wa</option>
                                <option value="Obuasi">Obuasi / Sunyani</option>
                            </select>
                            </form>
                        </td>
                        <td class="align-middle">1 - 2 days;</td>
                        <td class="align-middle">Free</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                <a class="btn btn-outline-secondary" href="address">
                    <i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back To Cart</span>
                </a>
                <a class="btn btn-primary" href="payment"><span class="hidden-xs-down">Continue&nbsp;</span>
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