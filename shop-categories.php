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

    <title>GiloShop Categories</title>
    <?php include_once "includes/header.php" ?>
   </head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<!-- Page Title-->
<?php
include_once "includes/nav.php";
if (isset($_GET["cat"])) {
    $cat_id = sanitize($_GET["cat"]);
}else{
    $cat_id = '';
}

$sql = "select * from products where c_id = '$cat_id'";
$catQry = $con->query($sql);

$category = get_category($cat_id);
?>

<!--Page Content-->

<div class="container padding-bottom-3x mb-1 padding-top-2x">

    <!-- Shop Toolbar-->
    <div class="shop-toolbar padding-bottom-1x mb-2">
        <div class="column">
            <div class="shop-sorting">
                <label for="sorting">Sort by:</label>
                <select class="form-control" id="sorting">
                    <option>Popularity</option>
                    <option>Low - High Price</option>
                    <option>High - Low Price</option>
                    <option>Average Rating</option>
                    <option>A - Z Order</option>
                    <option>Z - A Order</option>
                </select><span class="text-muted">Showing:&nbsp;</span><span>1 - 16 items</span>
            </div>
        </div>
        <div class="column"></div>
    </div>
    <!-- Products Grid-->
    <div class="row">
        <?php while ($product = $catQry->fetch_assoc()):
            $cat = $product["c_id"];
            $pro_id = $product["p_id"];
            $title = $product["title"];
            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];
            ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="product-card mb-30">
                <a class="product-thumb" href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>">
                    <img src="assets/images/shop/products/<?= $product["image"] ?>" alt="<?= $title ?>"></a>
                <div class="product-card-body">
                    <div class="product-category"><a href="#"><?= $cccc ?></a></div>
                    <h3 class="product-title"><a href="single-item?pid=<?= $pro_id ?>&product=<?= $title ?>"><?= $title ?></a></h3>
                    <h4 class="product-price">
                        ₵<?= number_format($product["price"],2,'.',','); ?>
                    </h4>
                </div>
                <div class="product-button-group">
                    <a pid="<?= $pro_id ?>" id="wishlists" remove_id="<?= $pro_id ?>" class="product-button btn-wishlists " href="#"><i class="icon-heart"></i><span>Wishlist</span></a>
                    <a pid ="<?= $pro_id ?>"  class="product-button btn-compare" href ="#" ><i class="icon-repeat" ></i ><span > Compare</span></a>
                    <a pid ="<?= $pro_id ?>" id="products" class="product-button" href = "#"><i class="icon-shopping-cart" ></i ><span > To Cart </span >
                    </a >
                </div >
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>




<!--footer-->
<?php include_once "includes/footer.php"?>
</body>
</html>