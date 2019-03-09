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
    <title>Contact Us</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!--Page Content-->
<div class="container padding-bottom-2x padding-top-3x mb-2">
    <div class="row">
        <div class="col-md-7">
            <div class="display-3 text-muted opacity-75 mb-30">Customer Service</div>
        </div>
        <div class="col-md-5">
            <ul class="list-icon">
                <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:developersengineerskasa@gmail.com">your Email</a></li>
                <li> <i class="icon-phone text-muted"></i>+233 (123) 4567 890 </li>
                <li> <i class="icon-clock text-muted"></i>1 - 2 business days</li>
            </ul>
        </div>
    </div>
    <hr class="margin-top-2x">
    <div class="row margin-top-2x">
        <div class="col-md-7">
            <div class="display-3 text-muted opacity-75 mb-30">Tech Support</div>
        </div>
        <div class="col-md-5">
            <ul class="list-icon">
                <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:developersengineerskasa@gmail.com">your Email</a></li>
                <li> <i class="icon-phone text-muted"></i>+233 (123) 4567 890 </li>
                <li> <i class="icon-clock text-muted"></i>1 - 2 business days</li>
            </ul>
        </div>
    </div>
    <h3 class="margin-top-3x text-center mb-30">Outlet Stores</h3>
    <div class="row ">
        <div class="col-md-8 col-sm-10 offset-2">
            <div class="card mb-30">
                <div class="google-map" data-height="250" data-address="514 S. Magnolia St. Orlando, FL 32806, USA" data-zoom="15"
                     data-disable-controls="true" data-scrollwheel="false" data-marker="img/map-marker.png"
                     data-marker-title="We are here!" data-styles="[{&quot;featureType&quot;:&quot;administrative.country&quot;,
&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;},{&quot;hue&quot;:&quot;#ff0000&quot;}]}]">
                </div>
                <div class="card-body">
                    <ul class="list-icon">
                        <li> <i class="icon-map-pin text-muted"></i>Shop Recognizable address</li>
                        <li> <i class="icon-phone text-muted"></i>Hotline</li>
                        <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:developersengineerskasa@gmail.com">Your Email</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<?php include_once "includes/footer.php"?>

</body>
</html>