<?php
include_once "db.php";
include_once "send-mail.php";
function sql_inject($input)
{
    global $con;
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlentities($input);
    $input = htmlspecialchars($input);
    $input = $con->real_escape_string($input);

    return $input;
}
function count_rating($num,$pid)
{
    global $con;
    $stmt = "SELECT COUNT(*) as count from reviews WHERE rating = $num and p_id = $pid and status = 1";
    $res = $con->query($stmt);
    $count = $res->fetch_assoc();
    return $count["count"];
}
if (isset($_GET["pid"]) && isset($_GET["product"])) {
    $id = sql_inject($_GET["pid"]);
    $name = sql_inject($_GET["product"]);
    $stmt = "select * from products where p_id = '$id' and deleted = 0";
}
$results = $con->query($stmt);
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

    <title><?= htmlspecialchars_decode($name); ?></title>
    <?php include_once "includes/header.php" ?>
</head>
<body class="bg-white">
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php include_once "includes/nav.php"; ?>
<!-- Page Title-->
<!--Page Content-->
<div class="container padding-top-2x">
    <div class="row">
        <?php
        if ($results->num_rows > 0) :
            $n = 0;
            while ($row = $results->fetch_assoc()):
                $pro_id = $row["p_id"];
                $image = $row["image"];
                $title = $row["title"];
                $lp = $row["list_price"];
                $price = $row["price"];
                $cat_id = $row["c_id"];
                $desc = $row["description"];
                $cond = $row["conditions"];
                $color = $row["color"];
                $memory = $row["memory"];
                $qty = $row["quantity"];
                $features = $row["features"];

                $color_array = explode(",", $color);
                $size_array = explode(",", $memory);
                //$format = number_format($price,2,'.',',');

                $cat_qry = "select name from categories where c_id = '$cat_id'";
                $exe = $con->query($cat_qry);
                $cat_res = $exe->fetch_assoc();
                $cat_name = $cat_res["name"];




                ?>
                <!-- Product Gallery-->
                <div class="col-md-6">

                    <div class="product-gallery">
                        <div class="gallery-wrapper">
                        </div><span class="product-badge bg-info"><?= $cond ?></span>
                        <div class="product-carousel owl-carousel gallery-wrapper">
                            <div class="gallery-item" data-hash="1<?= $pro_id?>"><a href="assets/images/shop/products/<?= $image?>" data-size="1000x667"><img src="assets/images/shop/products/<?= $image?>" alt=""></a></div>
                            <?php
                            $sql = "select * from gallery where p_id = '$pro_id'";
                            $res = $con->query($sql);
                            $rw = $res->fetch_assoc();
                            $photos = explode(",", $rw["image"]);

                            foreach ($photos as $photo):
                            $n++;
                                ?>
                                <div class="gallery-item" data-hash="<?= $n?>"><a href="assets/images/shop/products/<?= $photo?>" data-size="1000x667">
                                        <img src="assets/images/shop/products/<?= $photo ?>" alt=""></a></div>
                            <?php endforeach;?>
                        </div>
                        <ul class="product-thumbnails">
                            <li class="active"><a href="#1<?= $pro_id?>"><img src="assets/images/shop/products/<?= $image?>" alt="" style="object-fit: contain;height: 100px;"></a></li>
                            <?php
                            $n = 0;
                            foreach ($photos as $photo):
                            $n++;
                                ?>
                                <li><a href="#<?= $n?>"><img src="assets/images/shop/products/<?= $photo ?>" alt="" style="object-fit: contain;height: 100px;"></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
                <!-- Product Info-->

                <div class="col-md-6">
                    <div class="padding-top-2x mt-2 hidden-md-up"></div>
                    <div class="sp-categories pb-3"><i class="icon-tag"></i><a href="shop-categories.php?cat=<?= $cat_id ?>"><?= $cat_name ?></a></div>
                    <h3 class="mb-3"><span style="color: #312E67;  font-size: 19px;"><?= $title ?></span></h3>
                     <div class="rating-stars"><?= product_rating($pro_id) ?></div>

                    <?php
                    
                        echo '<span class="h3 d-block" style="color: #ffa000;">'.money($price).'</span>';
                

                    ?>


                    <span class=""><?= htmlspecialchars_decode($features) ?>
                        <a href='#details' class='scroll-to'>View product details</a></span>
                    <input type="hidden" name="qty_avail" id="qty_avail" value="<?= $qty; ?>">
                    <div class="row margin-top-1x">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="size">Choose color</label>
                                <select class="form-control" id="color">
                                    <?php
                                    foreach ($color_array as $col) {
                                        echo ' <option value="'.$col.'">'.$col.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="color">Sizes</label>
                                <select class="form-control" id="size">
                                    <?php

                                    foreach ($size_array as $mem){
                                        echo ' <option value="'.$mem.'" >'.$mem.'</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-end pb-4">
                        <div class="col-sm-4">
                            <div class="form-group mb-0">
                                <label for="quant">Quantity</label>
                                <input class="form-control form-control-sm" id="quant" value="1"  type="number" min="1" max="<?= $qty ?>" name="quantity">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="pt-4 hidden-sm-up"></div>
                            <button pid="<?= $pro_id ?>" id="products" class="btn btn-outline-primary btn-block m-0"><i class="icon-bag"></i> Add to Cart</button>
                        </div>
                    </div>

                    <div class="pt-1 mb-4"><span class="text-medium">Available :</span> <?= $qty ?></div>
                    <hr class="mb-2">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div class="mt-2 mb-2">
                            <button pid="<?= $pro_id ?>"  remove_id="<?= $pro_id ?>" id="wishlists" class="btn btn-outline-secondary btn-sm "><i class="icon-heart"></i>&nbsp;To Wishlist</button>
                        
                        </div>
                    </div>
                </div>

    </div>
</div>
<div class="container padding-bottom-1x mb-1">
    <!-- Related Products Carousel-->
    <h3 class="text-left">You May Also Like</h3>
    <!-- Carousel-->
     <?php
    $featured = "Select * from products where tags = 'Featured' and deleted = 0 order by p_id desc limit 8 ";
    $ftQ = $con->query($featured);
    ?>
    <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false,&quot;loop&quot;: true,
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

                $format = money($price);
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
                <del>'.money($lp).'</del>'.$format.'
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
               '.$format.'
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
<!-- Product Details-->

<?php endwhile; endif;
$qry = $con->query("SELECT AVG(rating) as rating FROM reviews WHERE p_id = '$id' and status = 1");
$rqy = $qry->fetch_assoc();
$ser = round($rqy["rating"], 1);
?>
<!-- Reviews-->
<div class="container padding-top-2x">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-default">
                <div class="card-body">
                    <div class="text-center">
                        <div class="d-inline align-baseline display-3 mr-1"><?= $ser ?></div>
                        <div class="d-inline align-baseline text-sm text-warning mr-1">
                            <div class="rating-stars">
                             <?php
                              echo product_rating($id);
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        <label class="text-medium text-sm">5 stars <span class='text-muted'>- <?= count_rating(5,$id); ?></span></label>
                        <div class="progress margin-bottom-1x">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= (count_rating(5,$id)/5)*100; ?>%; height: 2px;" aria-valuenow="<?= count_rating(5,$id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <label class="text-medium text-sm">4 stars <span class='text-muted'>- <?= count_rating(4,$id); ?></span></label>
                        <div class="progress margin-bottom-1x">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= (count_rating(4,$id)/5)*100; ?>%; height: 2px;" aria-valuenow="<?= count_rating(4,$id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <label class="text-medium text-sm">3 stars <span class='text-muted'>- <?= count_rating(3,$id); ?></span></label>
                        <div class="progress margin-bottom-1x">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= (count_rating(3,$id)/5)*100; ?>%; height: 2px;" aria-valuenow="<?= count_rating(3,$id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <label class="text-medium text-sm">2 stars <span class='text-muted'>- <?= count_rating(2,$id); ?></span></label>
                        <div class="progress margin-bottom-1x">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= (count_rating(2,$id)/5)*100; ?>%; height: 2px;" aria-valuenow="<?= count_rating(2,$id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <label class="text-medium text-sm">1 star <span class='text-muted'>- <?= count_rating(1,$id); ?></span></label>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= (count_rating(1,$id)/5)*100; ?>%; height: 2px;" aria-valuenow="<?= count_rating(1,$id); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <?php
                    if (is_cust_logged_in()) { ?>
                        <div class="pt-2"><a class="btn btn-warning btn-block" href="#" data-toggle="modal" data-target="#leaveReview">Leave a Review</a></div>
                    <?php } else{
                        echo "<div class='alert alert-primary alert-dismissible fade show text-center margin-bottom-1x'>
                        <i class=\"icon-bell\"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Please:</span> Only Logged in Users are allowed to review
                 
                        </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="padding-bottom-1x">Latest Reviews</h3>
             <?php
            $revSql = "select * from reviews where p_id = '$id' and status = 1 order by id desc ";
            $revRes = $con->query($revSql);
            if ($revRes->num_rows > 0) {
                while ($resRow = $revRes->fetch_assoc()) {
                    $revUID = $resRow["uid"];
                    $revSubj = $resRow["subject"];
                    $revRev = $resRow["review"];
                    $revRate = $resRow["rating"];
                    $revUser = $con->query("select first_name, last_name from user_info where uid = '$revUID'");
                    while ($revRow = $revUser->fetch_assoc()) {
                        $revFullName = $revRow["first_name"] . " " . $revRow["last_name"];

                    }
                    echo ' <div class="comment">
                <div class="comment-author-ava"><img class="txtAva" data-name="'.$revFullName.'"></div>
                <div class="comment-body">
                    <div class="comment-header d-flex flex-wrap justify-content-between">
                        <h4 class="comment-title">'.$revSubj.'</h4>
                        <div class="mb-2">
                            <div class="rating-stars">
                               '.individual_ratings($revRate).'
                            </div>
                        </div>
                    </div>
                    <p class="comment-text">'.$revRev.'</p>
                    <div class="comment-footer"><span class="comment-meta">'.$revFullName.'</span></div>
                </div>
            </div> ';

                }
                echo '<a class="btn btn-secondary btn-block" href="#">View All Reviews</a>';
            }else{
                echo "<div class=\"alert alert-primary alert-dismissible fade show text-center margin-bottom-1x\">
<i class=\"icon-bell\"></i>&nbsp;&nbsp;<span class=\'text-medium\'>No Reviews:</span>for this product yet
</div>  ";
            }
            ?>
        </div>
    </div>
</div>


<?php
if (isset($_SESSION["uid"])) {
    $uid = $_SESSION["uid"];
}else{
    $uid = "";
}

$sql = "select * from user_info where uid = '$uid'";
$res = $con->query($sql);
$row = $res->fetch_assoc();
$fname = $row["first_name"] . " ".$row["last_name"];
$email = $row["email"];
$phn = $row["phone"];
$errors = array();

if (isset($_POST["rev"])) {
    $rev = sanitize($_POST["review"]);
    $subj = sanitize($_POST["subj"]);
    $rate = sanitize($_POST["rate"]);
    
    $sql2 = $con->query("select * from reviews where uid = '$uid' and p_id = '$id'");
    $alReg = $sql2->num_rows;
    if ($alReg > 0) {
        $errors[] = "Please you have already reviewed this product";
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    }else{
        $stmt = $con->query("insert into reviews(uid, subject, review, rating, p_id) values ('$uid','$subj','$rev','$rate','$id')");
        $adSubj = "New Review on ".$name;
        $ver = $rev." <br> click on this <a href='giloshop.com/admin'>link</a> to confirm or delete review";
        sendMailToUser("info@giloshop.com",$fname,$adSubj,$ver);
        echo "<div class=\"alert alert-primary alert-dismissible fade show text-center margin-bottom-1x\">
<span class=\"alert-close\" data-dismiss=\"alert\"></span><i class=\"icon-bell\"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Review:</span>Submitted Successful... Awaiting confirmation
</div>  ";
    }
}
?>

<!-- Leave a Review-->
<form class="modal fade" action="shop-single.php?pid=<?= $id ?>&product=<?= $_GET["product"]; ?>" method="post" id="leaveReview" tabindex="-1">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Leave a Review</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-name">Your Name</label>
                            <input class="form-control" value="<?= $fname ?>" name="fulNm" type="text" id="review-name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-email">Your Email</label>
                            <input class="form-control" value="<?= $email ?>" name="eMail" type="email" id="review-email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-subject">Subject</label>
                            <input class="form-control" value="" name="subj" type="text" id="review-subject" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-rating">Rating</label>
                            <select class="form-control" name="rate" id="review-rating">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-message">Review</label>
                    <textarea class="form-control" name="review" id="review-message" rows="8" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" name="rev" type="submit">Submit Review</button>
            </div>
        </div>
    </div>
</form>
<!--footer-->

<!-- Back To Top Button-->
<!-- Photoswipe container-->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
            <button class="pswp__button pswp__button--share" title="Share"></button>
            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
          <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
          </div>
        </div>
      </div>
    </div>
<?php include_once "includes/footer.php" 
?>

</body>
</html>