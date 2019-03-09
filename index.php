<?php
include_once "db.php";
ob_start();
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
    <title>GiLoShop | Your Home of Quality Laptops and Accessories</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>

<?php include_once "includes/nav.php";
$slide = "select * from slider limit 3";
    $srs = $con->query($slide);
    ?>

<!-- Main Slider-->
<section class="hero-slider" style="background-image: url(assets/images/slider/main-bg.jpg);">
    <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        <?php
        if ($srs->num_rows > 0):
            while ($sro = $srs->fetch_assoc()):
                $nm = $sro["name"];
                $logo = $sro["logo"];
                $feat = $sro["feature"];
                $pr = $sro["price"];
                $tag = $sro["tagline"]

        ?>

        <div class="item">
            <div class="container padding-top-3x">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                        <div class="from-bottom"><img class="d-inline-block w-150 mb-4" src="assets/images/slider/<?= $logo?>" alt="">
                            <div class="h2 text-body mb-2 pt-1"><?= $nm?></div>
                            <div class="h2 text-body mb-4 pb-1"><?= $tag?> <span class="text-medium"><?= money($pr) ?></span></div>
                        </div><a class="btn btn-primary scale-up delay-1" href="grid-view">View Offers&nbsp;<i class="icon-arrow-right"></i></a>
                    </div>
                    <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="assets/images/slider/<?= $feat?>" alt=""></div>
                </div>
            </div>
        </div>
<?php endwhile; endif; ?>
    </div>
</section>

<!--Categories-->
<div class="container cunt padding-top-1x ">
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="grid-view">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/04.jpg" alt=""></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/05.jpg" alt=""><img src="assets/images/shop/categories/16.jpg" alt=""></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Smartphones &amp; Tablets</h4>
                   <a class="btn btn-outline-secondary text-primary btn-sm" href="grid-view" style="border: transparent;">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="grid-view">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/01.jpg" alt=""></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/03.jpg" alt=""><img src="assets/images/shop/categories/06.jpg" alt=""></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Computers &amp; Accessories</h4>
                    <a class="btn btn-outline-secondary text-primary btn-sm" href="grid-view" style="border: transparent;">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-30"><a class="card-img-tiles" href="grid-view">
                    <div class="inner">
                        <div class="main-img"><img src="assets/images/shop/categories/19.jpg" alt=""></div>
                        <div class="thumblist"><img src="assets/images/shop/categories/22.jpg" alt=""><img src="assets/images/shop/categories/24.jpg" alt=""></div>
                    </div></a>
                <div class="card-body text-center">
                    <h4 class="h6 card-title">Printers &amp; Video Games</h4>
                    <a class="btn btn-outline-secondary text-primary btn-sm" href="grid-view" style="border: transparent;">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Featured-->

<section class="container cunt bg-white padding-top-1x padding-bottom-1x mb-30">
    <h2 class="h3 text-left">Featured Products</h2>
    <!-- Carousel-->
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true,  &quot;loop&quot;: true, &quot;margin&quot;: 30,
&quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},
&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <!-- Product-->
        <?php
        $pQry = "Select * from products where tags = 'Featured' and deleted = 0";
        $res = $con->query($pQry);

        if ($res->num_rows > 0):
            while ($row = $res->fetch_assoc()):
                $pro_id = $row["p_id"];
                $image = $row["image"];
                $lp = $row["list_price"];
                $price = $row["price"];
                $status = $row["status"];
                $title = $row["title"];
                $cat = $row["c_id"];

                $cc = "select name from categories where c_id = '$cat'";
                $c = $con->query($cc);
                $nm = $c->fetch_assoc();
                $cccc = $nm["name"];

                ?>

                    <div class="product-card">
                    <?php  if ($status != null AND $lp != null) { ?>
                    
                        <div class="product-badge bg-danger"><?= $status ?></div>
                        <?php } ?>
                        <a class="product-thumb" href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>">
                            <img src="assets/images/shop/products/<?= $image ?>" alt=""></a>
                        <div class="product-card-body">
                            <div class="product-category">
                                <a href="shop-categories.php?cat=<?= $cat ?>"><?= $cccc ?></a></div>
                            <h3 class="product-title">
                                <a href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>"><?= $title ?></a></h3>
                                 <div class="rating-stars"> <?= product_rating($pro_id) ?></div>
                              <?= (($status != null AND $lp != null)? '<del>'.money($lp).'</del><h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>' :'<h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>') ?>

                        </div>
                    </div>
              

<?php  endwhile; endif; ?>
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
                <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true,
&quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},
&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                <!-- Product-->
                    <?php
                    $sql1 = "Select * from products where  b_id = '55' and deleted = 0 order by p_id desc  limit 8";
                    $res1 = $con->query($sql1);
                    if ($res1->num_rows > 0):
    while ($row1 = $res1->fetch_assoc()):
        $pro_id = $row1["p_id"];
        $image = $row1["image"];
        $lp = $row1["list_price"];
        $price = $row1["price"];
        $status = $row1["status"];
        $title = $row1["title"];
        $cat = $row1["c_id"];

        $cc = "select name from categories where c_id = '$cat'";
        $c = $con->query($cc);
        $nm = $c->fetch_assoc();
        $cccc = $nm["name"]; ?>

<div class="product-card">
     <?php   if ($status != null AND $lp != null) { ?>

                <div class="product-badge bg-danger"><?= $status ?></div>
     <?php } ?>
                <a class="product-thumb" href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>">
                    <img src="assets/images/shop/products/<?= $image ?>" alt=""></a>
                <div class="product-card-body">
                    <div class="product-category">
                        <a href="shop-categories.php?cat=<?= $cat ?>"><?= $cccc ?></a></div>
                    <h3 class="product-title">
                        <a href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>"><?= $title ?></a></h3>
                        <div class="rating-stars"><?= product_rating($pro_id) ?></div>
                              <?= (($status != null AND $lp != null)? '<del>'.money($lp).'</del><h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>' :'<h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>') ?>

                </div>
            </div>
       

    <?php  endwhile; endif; ?>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile3" role="tabpanel">
            <div class="row">
                <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true,
&quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},
&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                    <!-- Product-->
                    <?php
                    $sql1 = "Select * from products where  b_id = '63' and deleted = 0 order by p_id desc  limit 8";
                    $res1 = $con->query($sql1);
                    if ($res1->num_rows > 0):
                        while ($row1 = $res1->fetch_assoc()):
                            $pro_id = $row1["p_id"];
                            $image = $row1["image"];
                            $lp = $row1["list_price"];
                            $price = $row1["price"];
                            $status = $row1["status"];
                            $title = $row1["title"];
                            $cat = $row1["c_id"];

                            $cc = "select name from categories where c_id = '$cat'";
                            $c = $con->query($cc);
                            $nm = $c->fetch_assoc();
                            $cccc = $nm["name"]; ?>

<div class="product-card">
                                    
                      <?php     if ($status != null AND $lp != null) { ?>
                                
                                    <div class="product-badge bg-danger"><?= $status ?></div>
                    <?php } ?>
                                    <a class="product-thumb" href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>">
                                        <img src="assets/images/shop/products/<?= $image ?>" alt=""></a>
                                    <div class="product-card-body">
                                        <div class="product-category">
                                            <a href="shop-categories.php?cat=<?= $cat ?>"><?= $cccc ?></a></div>
                                        <h3 class="product-title">
                                            <a href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>"><?= $title ?></a></h3>
                                            <div class="rating-stars"><?= product_rating($pro_id) ?></div>
                              <?= (($status != null AND $lp != null)? '<del>'.money($lp).'</del><h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>' :'<h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>') ?>

                                    </div>
                                </div>
                           


                            <?php endwhile; endif; ?>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="settings3" role="tabpanel">
            <div class="row">
                <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: true,
&quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},
&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},
&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                    <!-- Product-->
                    <?php
                    $sql1 = "Select * from products where  b_id  IN (59,58,60,64) and deleted = 0 order by p_id desc  limit 8";
                    $res1 = $con->query($sql1);
                    if ($res1->num_rows > 0):
                        while ($row1 = $res1->fetch_assoc()):
                            $pro_id = $row1["p_id"];
                            $image = $row1["image"];
                            $lp = $row1["list_price"];
                            $price = $row1["price"];
                            $status = $row1["status"];
                            $title = $row1["title"];
                            $cat = $row1["c_id"];

                            $cc = "select name from categories where c_id = '$cat'";
                            $c = $con->query($cc);
                            $nm = $c->fetch_assoc();
                            $cccc = $nm["name"]; ?>
 <div class="product-card">
                         <?php   if ($status != null AND $lp != null) { ?>
                               
                                    <div class="product-badge bg-danger"><?= $status ?></div>
                        <?php } ?>
                                    <a class="product-thumb" href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>">
                                        <img src="assets/images/shop/products/<?= $image ?>" alt=""></a>
                                    <div class="product-card-body">
                                        <div class="product-category">
                                            <a href="shop-categories.php?cat=<?= $cat ?>"><?= $cccc ?></a></div>
                                        <h3 class="product-title">
                                            <a href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>"><?= $title ?></a></h3>
                                        <div class="rating-stars"><?= product_rating($pro_id) ?></div>
                              <?= (($status != null AND $lp != null)? '<del>'.money($lp).'</del><h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>' :'<h4 class="product-price"><span class="text-medium"> '.money($price).'</span> </h4>') ?>

                                    </div>
                                </div>
                           

                            <?php endwhile; endif; ?>

                </div>
            </div>
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
                <div class="days" id="days">00</div><span class="days_ref">Days</span>
            </div>
            <div class="item">
                <div class="hours" id="hours">00</div><span class="hours_ref">Hours</span>
            </div>
            <div class="item">
                <div class="minutes" id="minutes">00</div><span class="minutes_ref">Mins</span>
            </div>
            <div class="item">
                <div class="seconds" id="seconds">00</div><span class="seconds_ref">Secs</span>
            </div>
        </div>
    </div>
</section>
<a class="d-block position-relative mx-auto" href="grid-view" style="max-width: 682px; margin-top: -130px; z-index: 10;">
    <img class="d-block w-100" src="assets/images/banners/shop-banner-02.png" alt="Printers">
</a>

<!--Brands-->
<section class="bg-white padding-top-1x ">
    <div class="container">
    
        <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000,
&quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},
&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">
            <?php
            $bst = "Select * from brands";
            $rst = $con->query($bst);
            if (mysqli_num_rows($rst) > 0) :
                while ($rw = $rst->fetch_assoc()):
                    $image = $rw["image"];
                    $name = $rw["name"]
                    ?>
                    <img class="d-block w-110 opacity-75 m-auto" src="assets/images/brands/<?= $image ?>" alt="">
                <?php endwhile; endif; ?>
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
<script>
    var countdown = function (end, elements, callback) {
        var _second = 1000,
            _minute = _second * 60,
            _hour = _minute * 60,
            _day = _hour * 24,

            end = new Date(end),
            timer,
            calculate = function () {

            var now = new Date(),
                remaining = end.getTime() - now.getTime(),
                data;
                if (isNaN(end)) {
                    console.log('Invalid date/time');
                    return;
                }
                if (remaining <= 0) {
                    clearInterval(timer);

                    if (typeof callback === 'function') {
                        callback()
                    }
                }else {
                    if (!timer) {
                        timer = setInterval(calculate, _second);
                    }
                    data = {
                        'days': Math.floor(remaining / _day),
                        'hours': Math.floor((remaining % _day) / _hour),
                        'minutes': Math.floor((remaining % _hour) / _minute),
                        'seconds': Math.floor((remaining % _minute) / _second),
                    };
                    if (elements.length) {
                        for (x in elements) {
                            var x = elements[x];
                            document.getElementById(x).innerHTML = data[x];
                        }
                    }
                }

            };
        calculate();
    };
    var callbackfunction = function () {
        console.log('Done')
    };
    countdown('01/01/2019 06:30:00 PM', ['days','hours','minutes','seconds'], callbackfunction
    );
</script>
</body>
</html>
<?php ob_end_flush(); ?>