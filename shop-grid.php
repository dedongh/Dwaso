<?php session_start();
include_once "db.php";?>
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

    <title>GiloShop | All Products</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php include_once "includes/nav.php"; ?>
<!-- Page Title-->

<!--Page Content-->
<div class="container padding-bottom-3x mb-1 padding-top-2x">
    <div class="row">
        <!-- Products-->
        <div class="col-lg-9 order-lg-2">
            <!-- Promo banner-->
            <a class="alert alert-default alert-dismissible fade show fw-section mb-30" href="#" style="background-image: url(assets/images/banners/shop-banner-bg.jpg);">
                <span class="alert-close" data-dismiss="alert"></span>
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center">
                    <div class="mx-auto mx-md-0 px-3 pb-2 text-center text-md-left"><span class="d-block text-lg text-thin mb-2">Limited Time Deals</span>
                        <h3 class="text-gray-dark">Lenovo Yoga Y920</h3>
                        <p class="d-inline-block bg-warning text-white">&nbsp;&nbsp;Shop Now&nbsp;<i class="icon-chevron-right d-inline-block align-middle"></i>&nbsp;</p>
                    </div><img class="d-block mx-auto mx-md-0" src="assets/images/banners/shop-banner.png" alt="Surface Pro 4">
                </div>
            </a>
            <!-- Shop Toolbar-->
            <div class="shop-toolbar padding-bottom-1x mb-2">
                <div class="column">
                    <div class="shop-sorting">
                        <label for="sorting">Sort by:</label>
                        <select class="form-control " name="sort" id="sorting">
                            <option value="Popularity">Popularity</option>
                            <option value="l_h">Low - High Price</option>
                            <option value="h_l">High - Low Price</option>
                            <option value="avg_rate">Average Rating</option>
                            <option value="a_z">A - Z Order</option>
                            <option value="z_a">Z - A Order</option>
                        </select>
                        <span class="text-muted">Showing:&nbsp;</span><span>
                       <?= ((isset($_SESSION["start"]) && isset($_SESSION["limit"]))? $_SESSION["start"] ." - ". $_SESSION["limit"] :"1 - 16") ?>  items</span>
                    </div>
                </div>
                <div class="column">
                    <div class="shop-view">
                        <a class="grid-view active" href="#"><span></span><span></span><span></span></a>
                        <a class="list-view" href="list-view"><span></span><span></span><span></span></a>
                    </div>
                </div>
            </div>
            <!-- Products Grid-->
            <div class="get_all_products clearfix"></div>
            <!-- Pagination-->
            <nav class="pagination">
                <div class="column">
                    <ul class="pages page_no">
                        <li class="active"><a href="#">1</a></li>

                    </ul>
                </div>
                <div class="column text-right hidden-xs-down">
                    <a class="btn btn-outline-secondary btn-sm" href="#">Next&nbsp;<i class="icon-chevron-right"></i>
                    </a>
                </div>
            </nav>
        </div>
        <!-- Sidebar-->
        <div class="col-lg-3 order-lg-1">
            <div class="sidebar-toggle position-left">
                <i class="icon-filter"></i>
            </div>
            <aside class="sidebar sidebar-offcanvas position-left">
                <span class="sidebar-close">
                    <i class="icon-x"></i>
                </span>
                <!-- Widget Categories-->
                <?php $nest = "SELECT * FROM categories where parent = 0";
                $nest_que = $con->query($nest);?>
                <section class="widget widget-categories">
                   <h3 class="widget-title">Categories</h3>
                  <ul>
                      <?php
                      if ($nest_que->num_rows >0) :
                          while ($row = $nest_que->fetch_assoc()) :
                              $parent_id = $row["c_id"];
                              $nName = $row["name"];
                              $amt = "SELECT COUNT(*) AS Count FROM products where c_id = '$parent_id'";
                              $rwr = $con->query($amt);
                              $www = $rwr->fetch_assoc();
                              $ttt = $www["Count"];
                              ?>
                              <li class="has-children">
                                  <a href="#" class="category" cid="<?= $parent_id ?>"><?= $nName?></a><span>(<?= $ttt?>)</span>
                                  <ul>
                                      <?php
                                      $child = "SELECT * FROM categories where parent = '$parent_id'";
                                      $nChild = $con->query($child);
                                      while ($nrow = $nChild->fetch_assoc()) :
                                          $cName = $nrow["name"];
                                          $id = $nrow["c_id"];
                                          ?>
                                          <li><a href="#" class="category" cid="<?= $id ?>"><?= $cName?></a></li>
                                      <?php endwhile;?>

                                  </ul>
                              </li>
                          <?php endwhile; endif; ?>
                  </ul>
                </section>

                <!-- Widget Price Range-->
                <section class="widget widget-categories">
                    <h3 class="widget-title">Price Range</h3>
                    <form class="price-range-slider" method="post" data-start-min="0" data-start-max="30000" data-min="0" data-max="30000" data-step="10">
                        <div class="ui-range-slider"></div>
                        <footer class="ui-range-slider-footer">
                            <div class="column">
                                <button class="btn btn-outline-primary btn-sm price_filter" type="submit">Filter</button>
                            </div>
                            <div class="column">
                                <div class="ui-range-values">
                                    <div class="ui-range-value-min">Ghc <span></span>
                                        <input type="hidden" class="price_range">
                                    </div>&nbsp;-&nbsp;
                                    <div class="ui-range-value-max">Ghc <span></span>
                                        <input type="hidden" class="price_range2">
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </form>
                </section>
                <!-- Widget Size Filter-->

                <!-- Widget Brand Filter-->
                <section class="widget widget-categories">
                    <h3 class="widget-title">Filter by Brand</h3>
                    <ul class="get_brand">
                        <!--get brands-->
                    </ul>
                </section>
            </aside>
        </div>
    </div>
</div>
<!--footer-->
<?php include_once "includes/footer.php" ?>
</body>
</html>