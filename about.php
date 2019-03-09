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

    <meta charset="utf-8">
    <title>About Us</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!--Page Content-->
<div class="container padding-bottom-2x padding-top-2x mb-2">
    <div class="row align-items-center padding-bottom-2x">
        <div class="col-md-5">
            <img class="d-block w-270 m-auto" src="assets/images/about/01.jpg" alt="Online Shopping">
        </div>
        <div class="col-md-7 text-md-left text-center">
            <div class="mt-30 hidden-md-up"></div>
            <h2>Search, Select, Buy Online.</h2>
            <p>We bring you quality laptops, smartphones and tablets from your most trusted manufacturers.
                Log on now to enjoy our amazing deals and services only from the best in Ghana</p>
            <a class="text-medium text-decoration-none" href="#">View Products&nbsp;
                <i class="icon-arrow-right"></i>
            </a>
        </div>
    </div>
    <hr>
    <div class="row align-items-center padding-top-2x padding-bottom-2x">
        <div class="col-md-5 order-md-2">
            <img class="d-block  m-auto" src="assets/images/banners/about-02.jpg" alt="Delivery"></div>
        <div class="col-md-7 order-md-1 text-md-left text-center">
            <div class="mt-30 hidden-md-up"></div>
            <h2>Fast Delivery in and around Accra.</h2>
            <p>Get your goods delivered to you in safe hands via our express carriers. You orders are delivered to
                you right on your doorsteps without any hustle or damage to the goods</p>
            <a class="text-medium text-decoration-none" href="#">Delivery Details&nbsp;<i class="icon-arrow-right"></i></a>
        </div>
    </div>
    <hr>
    <div class="row align-items-center padding-top-2x padding-bottom-2x">
        <div class="col-md-5 ">
            <img class="d-block m-auto" src="assets/images/banners/about-04.jpg" alt="Delivery">
        </div>
        <div class="col-md-7  text-md-left text-center">
            <div class="mt-30 hidden-md-up"></div>
            <h2>Shop Offline. Cozy Outlet Stores.</h2>
            <p>Unable to go Online Visit our Outlet store shop location
                For an amazing experience</p>
            <a class="text-medium text-decoration-none" href="#">See Outlet Stores&nbsp;<i class="icon-arrow-right"></i></a>
        </div>
    </div>

 <div class="text-center padding-top-3x mb-30">
        <h2 class="mb-3">Our Core Team</h2>
        <p class="text-muted">People behind your awesome shopping experience.</p>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 mb-30 text-center">
            <img class="d-block w-150 mx-auto img-thumbnail rounded-circle mb-2" src="assets/images/account/01.png" alt="Team">
            <h6 class="mb-1">Gideon Opoku Agyemang</h6>
            <p class="text-sm text-muted mb-3">Founder, CEO</p>
            <div class="social-bar"><a class="social-button shape-circle sb-facebook" href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a></div>
        </div>
        <div class="col-md-4 col-sm-6 mb-30 text-center">
            <img class="d-block w-150 mx-auto img-thumbnail rounded-circle mb-2" src="assets/images/account/01.png" alt="Team">
            <h6 class="mb-1">Bra Emma</h6>
            <p class="text-sm text-muted mb-3">Developer</p>
            <div class="social-bar">
                <a class="social-button shape-circle sb-skype" href="#" data-toggle="tooltip" data-placement="top" title="Skype"><i class="socicon-skype"></i></a>
                <a class="social-button shape-circle sb-github" href="#" data-toggle="tooltip" data-placement="top" title="GitHub"><i class="socicon-github"></i></a>
                <a class="social-button shape-circle sb-email" href="#" data-toggle="tooltip" data-placement="top" title="Email"><i class="socicon-mail"></i></a></div>
        </div>
        <div class="col-md-4 col-sm-6 mb-30 text-center">
            <img class="d-block w-150 mx-auto img-thumbnail rounded-circle mb-2" src="assets/images/account/01.png" alt="Team">
            <h6 class="mb-1">Someone not found yet</h6>
            <p class="text-sm text-muted mb-3">Graphics Designer</p>
            <div class="social-bar"><a class="social-button shape-circle sb-twitter" href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="socicon-twitter"></i></a><a class="social-button shape-circle sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a><a class="social-button shape-circle sb-behance" href="#" data-toggle="tooltip" data-placement="top" title="Behance"><i class="socicon-behance"></i></a></div>
        </div>
    </div>

</div>


<!--footer-->
<?php include_once "includes/footer.php"?>

</body>
</html>