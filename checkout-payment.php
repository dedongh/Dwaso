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
    <title>Payment</title>
    <!-- SEO Meta Tags-->
    <?php include_once "includes/header.php" ?>
</head>
<!-- Body-->
<body>
<!-- Google Tag Manager (noscript)-->


<?php  include_once "includes/nav.php"; ?>

<!-- Page Content-->
<div class="container padding-bottom-3x padding-top-3x mb-2">
    <div class="row">
        <!-- Checkout Adress-->
        <div class="col-xl-9 col-lg-8">
            <div class="steps flex-sm-nowrap mb-5"><a class="step" href="#">
                    <h4 class="step-title"><i class="icon-check-circle"></i>1. Address</h4></a><a class="step" href="#">
                    <h4 class="step-title"><i class="icon-check-circle"></i>2. Delivery</h4></a><a class="step active" href="#">
                    <h4 class="step-title">3. Payment</h4></a><a class="step" href="#">
                    <h4 class="step-title">4. Review</h4></a></div>
            <h4>Choose Payment Method</h4>
            <hr class="padding-bottom-1x">
            <div class="accordion" id="accordion" role="tablist">

                <div class="card">
                    <div class="card-header" role="tab">
                        <h6><a class="collapsed" href="#paypal" data-toggle="collapse"><i class="socicon-paypal"></i>Pay with Mobile Money</a></h6>
                    </div>
                    <div class="collapse show" id="paypal" data-parent="#accordion" role="tabpanel">
                        <div class="card-body">
                            <p>MTN Mobile Money - the safer, easier way to pay</p>
                            <form class="row" method="post" action="MoMo.php">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input class="form-control" type="tel" placeholder="Mobile Number" required>
                                        <span class="bg-danger text-white" id="pmt_error"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <a class="navi-link" href="#"></a>

                                        <button class="btn btn-outline-primary margin-top-none" id="momo"  type="submit">Submit</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab">
                        <h6><a href="#card" data-toggle="collapse"><i class="icon-credit-card"></i>Pay with Credit Card</a></h6>
                    </div>
                    <div class="collapse " id="card" data-parent="#accordion" role="tabpanel">
                        <div class="card-body">
                            <p>We accept following credit cards:&nbsp;&nbsp;
                                <img class="d-inline-block align-middle" src="assets/images/credit-cards.png" style="width: 120px;" alt="Credit Cards"></p>
                            <div class="card-wrapper"></div>
                            <form class="interactive-credit-card row" action="card-payment.php" method="post">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="number" placeholder="Card Number" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" type="text" name="expiry" placeholder="MM/YY" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" type="text" name="cvc" placeholder="CVC" required>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-outline-primary btn-block mt-0" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between paddin-top-1x mt-4">
                <a class="btn btn-outline-secondary" href="delivery"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back</span></a>
                <a class="btn btn-primary" id="chk_pmt" href="review"><span class="hidden-xs-down">Continue&nbsp;</span><i class="icon-arrow-right"></i></a>
            </div>
        </div>
        <!-- Sidebar          -->
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
<!-- Site Footer-->

<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<?php include_once "includes/footer.php"?>
</body>

</html>