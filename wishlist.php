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

    <title>My Wishlist</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php
include_once "includes/nav.php";
?>

<!-- Page Title-->

<!--Page Content-->
<div class="container padding-bottom-3x mb-2 padding-top-2x">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(assets/images/account/user-cover-img.jpg);"></div>
                <div class="user-info">
                    <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="assets/images/account/01.png" alt="User"></div>
                    <div class="user-data">
                        <h4 class="h5"><?=  ((!empty($cust_data["_name"]))? $cust_data["_name"]:"GiLo Mascot"); ?></h4><span>Joined <?= ((!empty($cust_data["date_joined"]))? pretty_date($cust_data["date_joined"]) :  date("d M Y "))  ?></span>
                    </div>
                </div>
            </aside>
            <nav class="list-group"><a class="list-group-item with-badge" href="order"><i class="icon-shopping-bag"></i>Orders<span class="badge badge-default badge-pill orders">0</span></a>
                <a class="list-group-item" href="user"><i class="icon-user"></i>Profile</a>
                <a class="list-group-item with-badge active" href="#"><i class="icon-heart"></i>Wishlist<span class="badge badge-default badge-pill wished">0</span></a>
            </nav>
        </div>
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <!-- Wishlist Table-->
            <div class="table-responsive wishlist-table mb-0">
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">
                            <a class="btn btn-sm btn-outline-danger clearList" href="#">Clear Wishlist</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="wishlistCheckout">
                    <!--display wishlist info-->

                    </tbody>
                </table>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="inform_me" checked>
                <label class="custom-control-label" for="inform_me">Inform me when item from my wishlist is available</label>
            </div>
        </div>
    </div>
</div>

<!--footer-->
<?php include_once "includes/footer.php"?>
</body>
</html>