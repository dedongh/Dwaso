<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/5/2018
 * Time: 2:16 AM
 */
include_once "db.php";

$ip_add = getUserIP();

//get cart checkout details
if (isset($_POST["getPrice"])) {
    if (isset($_POST["rdV"])) {
        $shipped = $_POST["rdV"];
        $_SESSION["shipped"] = $shipped;

    }else{
        $shipped = 0;
        $_SESSION["shipped"] = $shipped;
    }
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        //when user is logged in this query will execute
        $sql = "select a.p_id, a.price, b.qty from products a, cart b where a.p_id = b.p_id and b.uid='$uid'";
    } else {
        //when user is not logged in this query will execute
        $sql = "select a.p_id, a.price, b.qty from products a, cart b where a.p_id = b.p_id and b.ip_add='$ip_add' and b.uid < 0";
    }
    $query = $con->query($sql);
    $sub_total = 0;


    if (mysqli_num_rows($query) > 0) {
        while ($row = $query->fetch_assoc()) {
            $product_price = $row["price"];
            $qty = $row["qty"];

            $sub_total += ($qty * $product_price);
            $grand_total = $sub_total + TAXRATE + DELIVERY;

        }

        echo ' <tr>
                  <td>Cart Subtotal:</td>
                  <td class="text-gray-dark">'.money($sub_total).'</td>
              </tr>
              <tr>
                  <td>Delivery:</td>
                  <td class="text-gray-dark">'.money(DELIVERY).'</td>
              </tr>
              <tr>
                  <td>Estimated tax:</td>
                  <td class="text-gray-dark">'.money(TAXRATE).'</td>
              </tr>
              <tr>
                  <td></td>
                  <td class="text-lg text-gray-dark">'.money($grand_total).'</td>
              </tr>';
    }
}

//get recently viewed items
if (isset($_POST["getViewed"])) {
    //echo " <h3 class=\"widget-title\">Recently Viewed</h3>";
   $transQry = $con->query("select * from orders where paid = 1 order by id desc limit 5");
    $results = array();
    while ($row = $transQry->fetch_assoc()) {
        $results[] = $row;
    }
    $row_count = $transQry->num_rows;

    $used_ids = array();
    for ($i = 0; $i < $row_count; $i++) {
        $json_items = $results[$i]["items"];
        $items = json_decode($json_items, true);
        foreach ($items as $item) {
            if (!in_array($item["product_id"], $used_ids)) {
                $used_ids[] = $item["product_id"];
            }
        }
    }
    foreach ($used_ids as $id) {
        $proQry = $con->query("select p_id, title, price, image from products where p_id = '$id'");
        $product = $proQry->fetch_assoc();
        $title = $product["title"];
        $image = $product["image"];
        $price = $product["price"];
        echo '

        <div class="entry pb-2">
            <div class="entry-thumb">
                      <a href="#"><img src="assets/images/shop/products/'.$image.'" alt="Product"></a>
                  </div>
                  <div class="entry-content">
                      <h4 class="entry-title">
                          <a href="#">'.$title.'</a></h4><span class="entry-meta">'.money($price).'</span>
             </div>
        </div>
        ';
    }
}

//order by select options
if (isset($_POST["sortGridProducts"])) {
    $sort = $_POST["optGrid"];
    $stmt = "select * from products where deleted = 0";

        if($sort == "l_h"){
            $stmt .= " ORDER BY price ASC ";
        }
        if($sort == "h_l"){
            $stmt .= " ORDER BY price DESC ";
        }
        if($sort == "a_z"){
            $stmt .= " ORDER BY title ASC ";
        }
         if($sort == "z_a"){
            $stmt .= " ORDER BY title DESC ";
         }

    $sortQry = $con->query($stmt);
    echo " <div class=\"row\">";
    while ($res = $sortQry->fetch_assoc()) {
        $pro_id = $res["p_id"];
        $image = $res["image"];
        $lp = $res["list_price"];
        $price = $res["price"];
        $status = $res["status"];
        $title = $res["title"];
        $cat = $res["c_id"];
        $price = money($price);
        $lp = money($lp);
        $rate = product_rating($pro_id);

        $cc = "select name from categories where c_id = '$cat'";
        $c = $con->query($cc);
        $nm = $c->fetch_assoc();
        $cccc = $nm["name"];

        if ($status != null and $lp != null) {
            echo "
            <div class=\"col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\">
                    <div class=\"product-badge bg-danger\">$status</div>
                    <a class=\"product-thumb\" href=\"single-item?pid=$pro_id&product=$title\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid=$pro_id&product=$title\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                            <del>$lp</del>$price
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                        <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlists \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                        <a pid='$pro_id' class=\"product-button btn-compare\" href=\"#\"><i class=\"icon-repeat\"></i><span>Compare</span></a>
                        <a pid='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\"></i><span>To Cart</span>
                        </a>
                    </div>
                </div>
            </div>
            ";
        }
        else{
            echo "
            <div class=\"col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\"> 
                    <a class=\"product-thumb\" href=\"single-item?pid=$pro_id&product=$title\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid=$pro_id&product=$title\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $price
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                        <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlists \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                        <a pid ='$pro_id'  class=\"product-button btn-compare\" href =\"#\" ><i class=\"icon-repeat\" ></i ><span > Compare</span></a>
                        <a pid ='$pro_id' id='products' class=\"product-button\" href = \"#\"><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span >
                        </a >
                    </div >
                </div>
            </div>
            ";
        }
    }
    echo "</div>";
}

//order by select options
if (isset($_POST["sortListProducts"])) {
    $sort1 = $_POST["optList"];
    $stmt1 = "select * from products where deleted = 0";

    if ($sort1 == "l_h") {
        $stmt1 .= " ORDER BY price ASC ";
    }
    if ($sort1 == "h_l") {
        $stmt1 .= " ORDER BY price DESC ";
    }
    if ($sort1 == "a_z") {
        $stmt1 .= " ORDER BY title ASC ";
    }
    if ($sort1 == "z_a") {
        $stmt1 .= " ORDER BY title DESC ";
    }

    echo " <div class=\"row\">";
    $sortQry1 = $con->query($stmt1);
    while ($res1 = $sortQry1->fetch_assoc()) {
        $pro_id = $res1["p_id"];
        $image = $res1["image"];
        $lp = $res1["list_price"];
        $price = $res1["price"];
        $status = $res1["status"];
        $condition = $res1["conditions"];
        $title = $res1["title"];
        $cat = $res1["c_id"];
        $desc = $res1["description"];

        $price = money($price);
        $lp = money($lp);
        $rate = product_rating($pro_id);
        $cc = "select name from categories where c_id = '$cat'";
        $c = $con->query($cc);
        $nm = $c->fetch_assoc();
        $cccc = $nm["name"];

        if ($status != null and $lp != null ) {
            echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid=$pro_id&product=$title\">
                    <div class=\"product-badge bg-info\">$condition</div>
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                    <div class=\"product-card-inner\">
                        <div class=\"product-card-body\">
                            <div class=\"product-category\">
                                <a href=\"#\">$cccc</a>
                            </div>
                            <h3 class=\"product-title\"><a href=\"single-item?pid=$pro_id&product=$title\">$title</a></h3>
                            <div class=\"rating-stars\">$rate</div>
                            <h4 class=\"product-price\">
                                <del>$lp</del>$price
                            </h4>
                            <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                        </div>
                        <div class=\"product-button-group\">
                           <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlists\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                           <a pid ='$pro_id'  class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                           <a pid ='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a>
                        </div>
                    </div>
            </div>
                ";
        } else {
            echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid=$pro_id&product=$title\">
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                <div class=\"product-card-inner\">
                    <div class=\"product-card-body\">
                        <div class=\"product-category\">
                            <a href=\"#\">$cccc</a>
                        </div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid=$pro_id&product=$title\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $price
                        </h4>
                        <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                    </div>
                    <div class=\"product-button-group\">
                         <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlists\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                         <a pid='$pro_id'   class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                         <a pid= '$pro_id' id=\"products\" class=\"product-button\" href=\"#\" ><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a >
                        
                </div>
                </div>
            </div>
                ";
        }
    }
    echo "</div>";
}


