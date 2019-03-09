<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/2/2018
 * Time: 10:20 AM
 */

include_once "db.php";

//get user IP address
$ip_add =  getUserIP();

//fetch category from database
if (isset($_POST["category"])) {
    $cat_query = "SELECT * FROM categories where parent = 0 ";
    $run_query = $con->query($cat_query);
    echo " <div class=\"row\">";
    if (mysqli_num_rows($run_query) > 0) {
        while ($row = $run_query->fetch_assoc()){
            $cid = $row["c_id"];
            $cat_name = $row["name"];
            $cat_image = $row["image"];
            echo "
            <div class='col-sm-4'>
                <a class='d-block navi-link text-center mb-30' cid='$cid' href='shop-categories.php?cat=$cid'>
                    <img src='assets/images/shop/header-categories/$cat_image'>
                    <span class='text-gray-dark'>$cat_name</span>
                </a>
            </div>      
             ";
        }
        echo " </div>";
    }
}

//without image
if (isset($_POST["cat_tool"])) {
    $toll = "SELECT * FROM categories where parent = 0";
    $res = $con->query($toll);
    if (mysqli_num_rows($res) > 0) {
        while ($row = $res->fetch_assoc()) {
            $cid = $row["c_id"];
            $cat_name = $row["name"];

            $toll2 = "select * from categories where parent = '$cid'";
            $res2 = $con->query($toll2);
            echo "<li class=\"has-children\">
            <a href=\"shop-categories.php?cat=$cid\" cid=\'$cid\'>$cat_name</a>
                      
            <ul class=\"sub-menu hidden-on-mobile\">
            
           ";
            while ($tChild = $res2->fetch_assoc()) {
                $childID = $tChild["c_id"];
                $childName =  $tChild["name"];

                echo "
                <li><a href=\"shop-categories.php?cat=$childID\">$childName</a></li>
           
            ";
            }
            echo ' </ul>
           </li>';

        }
    }
}

//fetch brands
if (isset($_POST["brands"])) {
    $brand_query = "SELECT * FROM brands";
    $run = $con->query($brand_query);

    if (mysqli_num_rows($run) > 0) {
        while ($row = $run->fetch_assoc()) {
            $bid = $row["b_id"];
            $brand_name = $row["name"];

            $amt = "SELECT COUNT(*) AS Count FROM products where b_id = '$bid' and deleted = 0";
            $rwr = $con->query($amt);
            $www = $rwr->fetch_assoc();
            $ttt = $www["Count"];
            echo '
            <li><a href="#" class="selectBrand" bid="'.$bid.'">'.$brand_name.'</a><span>('.$ttt.')</span></li>
            ';

        }
    }
}



//get all products
if (isset($_POST["getAllProducts"])) {

    $limit = 16;
    //$_SESSION["limit"] = $limit;
    $cout = $con->query("select count(*) as count from products where deleted = 0");
    $cou = $cout->fetch_assoc();
    $cw = $cou["count"];
    $_SESSION["limit"] = $cw;
    if (isset($_POST["setPage"])) {
        $pageno = $_POST["pageNumber"];
        $start = ($pageno * $limit) - $limit;
       // $_SESSION["start"] = $start;
        $_SESSION["start"] = $limit;
    }else{
        $start = 0;
        $_SESSION["start"] = 1;
    }
    $sql = "select * from products where deleted = 0 limit $start, $limit";
    $res = $con->query($sql);
    echo " <div class=\"row\">";
    if (mysqli_num_rows($res) > 0) {
        while ($row = $res->fetch_assoc()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $title = $row["title"];
            $cat = $row["c_id"];


            $format = money($price);
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
                            <del>$lp</del>$format
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
                           $format
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
}

//getListProducts
if (isset($_POST["getListProducts"])) {
    $cout = $con->query("select count(*) as count from products where deleted = 0");
    $cou = $cout->fetch_assoc();
    $cw = $cou["count"];
    $_SESSION["limit"] = $cw;
    $limit = 16;

    if (isset($_POST["setPage2"])) {
        $pageno = $_POST["pageNumber2"];
        $start = ($pageno * $limit) - $limit;
        $_SESSION["start"] = $start;
    }else{
        $start = 0;
        $_SESSION["start"] = 1;
    }
    $sql = "select * from products where deleted = 0 limit $start, $limit";
    $res = $con->query($sql);
    echo " <div class=\"row\">";
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $condition = $row["conditions"];
            $title = $row["title"];
            $cat = $row["c_id"];
            $desc = $row["description"];

            $format = money($price);
            $lp = money($lp);
            $rate = product_rating($pro_id);

            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];
            if ($status != null or $lp != null ) {
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
                                <del>$lp</del>$format
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
                           $format
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
}

//add to cart

if (isset($_POST["addToCart"])) {
    $p_id = $_POST["proId"];

    if (isset($_POST["quant"])) {
        $quantity = $_POST["quant"];
    }else{
        $quantity = 1;
    }
    if (isset($_POST["color"])) {
        $colour = $_POST["color"];
    }else{
        $colour = "";
    }
    if (isset($_POST["size"])) {
        $siz = $_POST["size"];
    }else{
        $siz = "";
    }
    if (isset($_POST["available"])) {
        $qty_avail = $_POST["available"];
        if ($quantity > $qty_avail) {
            echo "EXCEEDED";
            exit();
        }
    }

    //user logged in
    if (isset($_SESSION["uid"])) {
        $user_id = $_SESSION["uid"];
        $sql = "select * from cart where p_id = '$p_id' and uid = '$user_id'";
        $cart_query = $con->query($sql);
        $count = mysqli_num_rows($cart_query);
        if ($count > 0) {
            $sql = "update cart set qty = '$quantity', color = '$colour', size = '$siz' where ip_add = '$ip_add' and uid = '$user_id' and p_id = '$p_id'";
            $con->query($sql);
            echo "Exists";
        } else {
            $sql = "insert into cart(p_id, ip_add, uid, qty, color, size) values ('$p_id','$ip_add','$user_id','$quantity','$colour','$siz')";
            if ($con->query($sql)) {
                echo "Success";
            }
        }
    } else {
        //user not logged in
        $sql = "select id from cart where ip_add = '$ip_add' and p_id = '$p_id' and uid = -1";
        $query = $con->query($sql);
        if (mysqli_num_rows($query) > 0) {
            $sql = "update cart set qty = '$quantity', color = '$colour', size = '$siz' where ip_add = '$ip_add' and uid = -1 and p_id = '$p_id'";
            $con->query($sql);
            echo "Exists";
            exit();
        }
        $sql = "insert into cart(p_id, ip_add, uid, qty, color, size) values ('$p_id','$ip_add','-1','$quantity','$colour','$siz')";
        if ($con->query($sql)) {
            echo "Success";
            exit();
        }
    }
}

//count items in cart
if (isset($_POST["count_item"])) {
    //count logged in user items using session id
    if (isset($_SESSION["uid"])) {
        $sql = "select count(*) as count_item from cart where uid = '$_SESSION[uid]'";
    } else {
        //count user cart items using unique ip address
        $sql = "select count(*) as count_item from cart where ip_add = '$ip_add' and uid < 0";
    }
    $query = $con->query($sql);
    $row = $query->fetch_array();
    $res = $row["count_item"];
    echo $res;
    exit();
}

//display cart items in dropdown menu
if (isset($_POST["Common"])) {
    if (isset($_SESSION["uid"])) {
        //when user is logged in this query will execute
        $uid = $_SESSION["uid"];
        $sql = "select a.p_id, a.title, a.quantity, a.price, a.memory, a.image, b.id, b.qty, b.color, b.size from products a, cart b where a.p_id = b.p_id and b.uid='$uid'";
    } else {
        //when user is not logged in this query will execute
        $sql = "select a.p_id, a.title, a.quantity, a.price, a.memory,  a.image, b.id, b.qty, b.color, b.size from products a, cart b where a.p_id = b.p_id and b.ip_add='$ip_add' and b.uid < 0";
    }
    $query = $con->query($sql);

    $sub_total = 0;
    $nI = 0;

    if (isset($_POST["getCartItem"])) {
        //display cart item in dropdown menu
        if (mysqli_num_rows($query) > 0) {
            $n=0;
            while ($row = $query->fetch_array()) {

                $product_id = $row["p_id"];
                $product_title = $row["title"];
                $product_price = $row["price"];
                $product_image = $row["image"];
                $cart_item_id = $row["id"];
                $qty = $row["qty"];
                $pqty = $row["quantity"];



                echo '
                <div class="entry">
                       <div class="entry-thumb">
                           <a href="single-item?pid='.$product_id.'&product='.$product_title.'">
                               <img src="assets/images/shop/products/'.$product_image.'" alt="'.$product_title.'">
                           </a>
                       </div>
                       <div class="entry-content">
                           <h4 class="entry-title">
                               <a href="single-item?pid='.$product_id.'&product='.$product_title.'">'.substr($product_title, 0,25).'...</a>
                           </h4>
                           <span class="entry-meta"><span class="qty1" >'.$qty.'</span> x <span>'.money($product_price).'</span>
                           
                       </div>
                       <div class="entry-delete remove" remove_id="'.$product_id.'"><i class="icon-x"></i></div>
                </div>
           
                ';
                $sub_total += ($qty * $product_price);
                $grand_total = $sub_total + TAXRATE;
                $nI++;
            }

            echo '
            <div class="text-right">
                 <p class="text-muted">Subtotal:  <span class=\'text-gray-dark py-2 mb-0 \'>'.money($sub_total) .'</span> &nbsp;</p>
            </div>
               <div class="d-flex">
                   <div class="pr-2 w-50">
                       <a class="btn btn-secondary btn-sm btn-block mb-0" href="cart">Expand Cart</a>
                   </div>
                   <div class="pl-2 w-50">
                       <a class="btn btn-primary btn-sm btn-block mb-0" href="address">Checkout</a>
                   </div>
               </div>
            ';

        } else {
            echo "<p>Cart is empty</p>";
        }
    }
    //display items on cart page
    if (isset($_POST["checkOutDetails"])) {
        if (mysqli_num_rows($query) > 0) {
            while ($row = $query->fetch_array()) {

                $product_id = $row["p_id"];
                $product_title = $row["title"];
                $product_price = $row["price"];
                $product_left = $row["quantity"];
                $product_image = $row["image"];
                $cart_item_id = $row["id"];
                $qty = $row["qty"];
                $pqty = $row["quantity"];
                $size = $row["memory"];
                $memory = $row["size"];
                $color = $row["color"];

                if ($memory == null) {
                    $memory = "<span class='text-danger'>N/A</span>";
                }
                if ($color == null) {
                    $color = "<span class='text-danger'>N/A</span>";
                }

                echo '
                <tr>
                
                <td>
                    <div class="product-item">
                        <a class="product-thumb" href="single-item?pid='.$product_id.'&product='.$product_title.'">
                            <img src="assets/images/shop/products/' . $product_image . '" alt="' . $product_title . '">
                        </a>
                        <div class="product-info">
                            <h4 class="product-title"><a href="single-item?pid='.$product_id.'&product='.$product_title.'">' . $product_title . '</a></h4>
                            <span class="trial"><em>Memory: </em> ' . $memory . '</span><span><em>Color:</em> ' . $color . '</span>
                            
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <div class="count-input">
                       <input pid="'.$product_id.'" class="form-control form-control-sm qty" id="qty-'.$product_id.'" type="number" min="1" max="'.$pqty.'" value="'.$qty.'">
                      <input type="hidden" id="left-'.$product_id.'" value="'.$product_left.'">
                    </div>
                </td>
                <td class="text-center text-lg ">
               <div class="count-input">
                       <input class="form-control form-control-sm price" type="text" value="'.$product_price.'" readonly>
                    </div>
                </td>
                <td class="text-center text-lg ">
                   <div class="count-input">
                       <input class="form-control form-control-sm total" type="text" value="'.$product_price.'" readonly>
                    </div>
                </td>
                <td class="text-center">
                 
                    <a class="remove-from-cart remove" remove_id="'.$product_id.'" href="#" data-toggle="tooltip" title="Remove item">
                        <i class="icon-x"></i>
                    </a>
                    <a class="update-from-cart update" update_id="'.$product_id.'"  href="#" data-toggle="tooltip" title="Update item">
                        <i class="icon-check-circle"></i>
                    </a>
                                                 
                </td>
                
            </tr>
                ';

                $sub_total += $qty * $product_price;

                $grand_total = $sub_total + TAXRATE;
                $nI++;

            }
            if ($nI > 1)
                $s = "s";
            else
                $s = "";
            echo '
             <input type="hidden" name="sub_total" value="'.$sub_total.'">
              <input type="hidden" name="tax" value="'.TAXRATE.'">
            <input type="hidden" name="grand_total" value="'.$grand_total.'">
            <input type="hidden" name="description" value="'.$nI.' item'.$s.' from GiLo Shop Ltd">
            ';
            //redirect if user is not logged in
            if (!isset($_SESSION["uid"])) {
                //sign in
            } elseif (isset($_SESSION["uid"])) {
                //checkout
            }
        } else {
            echo "<p>Cart is empty</p>";
        }
    }
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
    $remove_id = $_POST["rid"];
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND uid = '$uid'";
    }else{
        $sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
    }
    if($con->query($sql)){
        echo "Removed";
        exit();
    }
}

//delete all products from cart
if (isset($_POST["deleteAll"])) {
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $del = "DELETE FROM cart WHERE uid = '$uid'";
    }else{
        $del = "delete from cart where ip_add = '$ip_add'";
    }
    $qry = $con->query($del);
    if ($qry) {
        echo "Cleared";
    }
}

//update cart
if (isset($_POST["updateCartItem"])) {
    $update_id = $_POST["update_id"];
    $qty = $_POST["qty"];
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND uid = '$uid'";
    }else{
        $sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
    }
    if($con->query($sql)){
        echo "updated";
        exit();
    }
}

//wishlist
if (isset($_POST["wishlistCheckout"])) {
    if (isset($_SESSION["uid"])) {
        //when user is logged in this query will execute
        $uid = $_SESSION["uid"];
        $sql = "select a.p_id, a.title, a.color, a.memory, a.price, a.availability, a.image, b.w_id from products a, wishlist b where a.p_id = b.p_id and b.uid='$uid'";
    } else {
        //when user is not logged in this query will execute
        $sql = "select a.p_id, a.title, a.color, a.memory, a.price, a.availability, a.image, b.w_id from products a, wishlist b where a.p_id = b.p_id and b.ip_add='$ip_add' and b.uid < 0";
    }
    $query = $con->query($sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = $query->fetch_array()) {
            $product_id = $row["p_id"];
            $title = $row["title"];
            $price = $row["price"];
            $avail = $row["availability"];
            $image = $row["image"];
            $col = $row["color"];
            $mem = $row["memory"];
            $format = money($price);
            $rate = product_rating($product_id);

            if (strtolower($avail) == 'in stock' || 'available') {
                echo '
            <tr>
                  <td>
                       <div class="product-item">
                           <a class="product-thumb" href="single-item?pid='.$product_id.'&product='.$title.'">
                           <img src="assets/images/shop/products/'.$image.'" alt="'.$title.'">
                           </a>
                           <div class="product-info">
                               <h4 class="product-title"><a href="single-item?pid='.$product_id.'&product='.$title.'">'.$title.'&nbsp;'.$mem.'&nbsp;'.$col.'</a></h4>
                               <div class=\"rating-stars\">'.$rate.'</div>
                               <div class="text-lg mb-1">'.$format.'</div> 
                               <div class="text-sm">Availability:
                                   <div class="d-inline text-success">'.$avail.'</div>
                               </div>
                           </div>
                       </div>
                   </td>
                   
                   <td class="text-center">
                       <a class="remove-from-cart del-wish" remove_id="'.$product_id.'" href="#" data-toggle="tooltip" title="Remove item">
                           <i class="icon-x"></i>
                       </a>
                  </td>
            </tr>
            ';
            }else{
                echo '
            <tr>
                  <td>
                       <div class="product-item">
                           <a class="product-thumb" href="single-item?pid='.$product_id.'&product='.$title.'">
                           <img src="assets/images/shop/products/'.$image.'" alt="'.$title.'">
                           </a>
                           <div class="product-info">
                               <h4 class="product-title"><a href="single-item?pid='.$product_id.'&product='.$title.'">'.$title.'&nbsp;'.$mem.'&nbsp;'.$col.'</a></h4>
                               <div class=\"rating-stars\">'.$rate.'</div>
                               <div class="text-lg mb-1"> '.$format.'</div> 
                               <div class="text-sm">Availability:
                                   <div class="d-inline text-warning">'.$avail.'</div>
                               </div>
                           </div>
                       </div>
                   </td>
                    
                   <td class="text-center">
                       <a class="remove-from-cart del-wish" remove_id="'.$product_id.'" href="#" data-toggle="tooltip" title="Remove item">
                           <i class="icon-x"></i>
                       </a>
                  </td>
            </tr>
            ';
            }

        }
    }
}

//remove from wishlist
if (isset($_POST["removeItemFromWishlist"])) {
    $del_id = $_POST["deleteId"];
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $sql = "DELETE FROM wishlist WHERE p_id = '$del_id' AND uid = '$uid'";
    }else{
        $sql = "DELETE FROM wishlist WHERE p_id = '$del_id' AND ip_add = '$ip_add'";
    }
    if($con->query($sql)){
        echo "wished";
        exit();
    }
}

//counting wishlist items
if (isset($_POST["count_wish"])) {
    //count logged in user items using session id
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $sql = "select count(*) as count_item from wishlist where uid = '$uid'";
    } else {
        //count user cart items using unique ip address
        $sql = "select count(*) as count_item from wishlist where ip_add = '$ip_add' and uid < 0";
    }
    $query = $con->query($sql);
    $row = $query->fetch_array();
    $res = $row["count_item"];
    echo $res;
    exit();
}
//counting order items
if (isset($_POST["count_orders"])) {
    //count logged in user items using session id
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $sqlO = "select count(*) as count_item from orders where uid = '$uid'";
    } else {
        //count user cart items using unique ip address
        $sqlO = "select count(*) as count_item from orders where ip_add = '$ip_add' and uid < 0";
    }
    $query1 = $con->query($sqlO);
    $row1 = $query1->fetch_array();
    $res1 = $row1["count_item"];
    echo $res1;
    exit();
}

//clear all wishlist items
if (isset($_POST["wishClear"])) {
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
        $del = "DELETE FROM wishlist WHERE uid = '$uid'";
    }else{
        $del = "delete from wishlist where ip_add = '$ip_add'";
    }

    $qry = $con->query($del);
    if ($qry) {
        echo "wishCleared";
    }
}

// add items to wishlist
if (isset($_POST["addToWish"])) {
    $p_id = $_POST["pId"];
    //logged in user
    if (isset($_SESSION["uid"])) {
        $user_id = $_SESSION["uid"];
        $sql = "insert into wishlist(p_id,uid,ip_add) values ('$p_id','$user_id','$ip_add')";
        if ($con->query($sql)) {
            echo "addedToWish";
        }
    }else{
        //logged out user
        $sql = "insert into wishlist(p_id,uid,ip_add) values ('$p_id','-1','$ip_add')";
        if ($con->query($sql)) {
            echo "addedToWish";
        }
    }
}

//pagination for grid view
if (isset($_POST["page"])) {
    $sql = "select * from products where deleted = 0";
    $query = $con->query($sql);
    $count = mysqli_num_rows($query);
    $pageno = ceil($count / 16);
    for ($i = 1; $i <= $pageno; $i++) {

            echo '
         <li><a href="#" id="page" page="'.$i.'">'.$i.'</a></li>
        ';

    }
}
//pagination for list view
if (isset($_POST["list_page"])) {
    $sql = "select * from products where deleted = 0";
    $query = $con->query($sql);
    $count = mysqli_num_rows($query);
    $pageno = ceil($count / 16);
    for ($i = 1; $i <= $pageno; $i++) {

        echo '
         <li><a href="#" id="listpage" page="'.$i.'">'.$i.'</a></li>
        ';

    }
}

//brand and category selection grid page
if (isset($_POST["getCategory"]) || isset($_POST["selectBrand"])) {
    if (isset($_POST["getCategory"])) {
        $id = $_POST["cat_id"];
        $sql = "select * from products where c_id = '$id' and deleted = 0";
    }else if (isset($_POST["selectBrand"])) {
        $id = $_POST["brand_id"];
        $sql = "select * from products where b_id = '$id' and deleted = 0";
    }
    $query = $con->query($sql);
    echo " <div class=\"row\">";
    if (mysqli_num_rows($query) > 0) {
        while ($row = $query->fetch_array()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $title = $row["title"];
            $cat = $row["c_id"];

            $format = money($price);
            $lp = money($lp);
            $rate = product_rating($pro_id);

            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];

            if ($status != null AND $lp != null) {
                echo "
            <div class=\"col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\">
                    <div class=\"product-badge bg-danger\">$status</div>
                    <a class=\"product-thumb\" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                         <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                            <del>$lp</del>$format
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                    <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                        <a pid='$pro_id' class=\"product-button btn-compare\" href=\"#\"><i class=\"icon-repeat\"></i><span>Compare</span></a>
                        <a pid='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\"></i><span>To Cart</span>
                        </a>
                    </div>
                </div>
            </div>
            ";

            }else{
                echo "
            <div class=\"col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\"> 
                    <a class=\"product-thumb\" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                         <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $format
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                        <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
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

}

//list view
if (isset($_POST["listCat"]) || isset($_POST["selBrand"])) {
    if (isset($_POST["listCat"])) {
        $id = $_POST["catId"];
        $sql = "select * from products where c_id = '$id' and deleted = 0";
    }
    else if ($_POST["selBrand"]) {
        $id = $_POST["brandId"];
        $sql = "select * from products where b_id = '$id' and deleted = 0";
    }
    $res = $con->query($sql);
    echo " <div class=\"row\">";
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $condition = $row["conditions"];
            $title = $row["title"];
            $cat = $row["c_id"];
            $desc = $row["description"];

            $format = money($price);
            $lp = money($lp);
            $rate = product_rating($pro_id);

            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];
            if ($condition != null || $lp != null) {
                echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                    <div class=\"product-badge bg-info\">$condition</div>
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                    <div class=\"product-card-inner\">
                        <div class=\"product-card-body\">
                            <div class=\"product-category\">
                                <a href=\"#\">$cccc</a>
                            </div>
                            <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                             <div class=\"rating-stars\">$rate</div>
                            <h4 class=\"product-price\">
                                <del>$lp</del>$price
                            </h4>
                            <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                        </div>
                        <div class=\"product-button-group\">
                           <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                           <a pid ='$pro_id'  class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                           <a pid ='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a>
                        </div>
                    </div>
            </div>
                ";
            } else {
                echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                <div class=\"product-card-inner\">
                    <div class=\"product-card-body\">
                        <div class=\"product-category\">
                            <a href=\"#\">$cccc</a>
                        </div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                         <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $format
                        </h4>
                        <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                    </div>
                    <div class=\"product-button-group\">
                         <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                         <a pid='$pro_id'  class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                         <a pid= '$pro_id' id='products' class=\"product-button\" href=\"#\" ><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a >
                     
                </div>
                </div>
            </div>
                ";
            }
        }
        echo "</div>";
    }
}

//filter products by price on grid view
if (isset($_POST["price_min_range"]) || isset($_POST["price_max_range"])) {
        $min = $_POST["price_min_range"];
        $max = $_POST["price_max_range"];

    $sql = "select * from products where price between " .$min. " and " .$max." and deleted = 0 order by price asc";
    $query = $con->query($sql);
    echo " <div class=\"row\">";
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $title = $row["title"];
            $cat = $row["c_id"];

            $format =money($price);
            $lp = money($lp);
            $rate = product_rating($pro_id);

            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];

            if ($status != null AND $lp != null) {
                echo "
            <div class=\"col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\">
                    <div class=\"product-badge bg-danger\">$status</div>
                    <a class=\"product-thumb\" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                            <del>$lp</del>$format
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                    <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                        <a pid='$pro_id' class=\"product-button btn-compare\" href=\"#\"><i class=\"icon-repeat\"></i><span>Compare</span></a>
                        <a pid='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\"></i><span>To Cart</span>
                        </a>
                    </div>
                </div>
            </div>
            ";

            }else{
                echo "
            <div class=\" col-md-4 col-sm-6\">
                <div class=\"product-card mb-30\"> 
                    <a class=\"product-thumb\" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                        <img src=assets/images/shop/products/$image alt=\"$title\"></a>
                    <div class=\"product-card-body\">
                        <div class=\"product-category\"><a href=\"#\">$cccc</a></div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $format
                        </h4>
                    </div>
                    <div class=\"product-button-group\">
                        <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist \" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
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
}

//filter products by price on list view
if (isset($_POST["min_range"]) || isset($_POST["max_range"])) {
    $min = $_POST["min_range"];
    $max = $_POST["max_range"];

    $sql = "select * from products where price between " .$min. " and " .$max." and deleted = 0 order by price asc";
    $res = $con->query($sql);

    echo " <div class=\"row\">";
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $pro_id = $row["p_id"];
            $image = $row["image"];
            $lp = $row["list_price"];
            $price = $row["price"];
            $status = $row["status"];
            $condition = $row["conditions"];
            $title = $row["title"];
            $cat = $row["c_id"];
            $desc = $row["description"];

            $format = money($price);
            $lp = money($lp);
            $rate = product_rating($pro_id);

            $cc = "select name from categories where c_id = '$cat'";
            $c = $con->query($cc);
            $nm = $c->fetch_assoc();
            $cccc = $nm["name"];
            if ($condition != null || $lp != null) {
                echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                    <div class=\"product-badge bg-info\">$condition</div>
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                    <div class=\"product-card-inner\">
                        <div class=\"product-card-body\">
                            <div class=\"product-category\">
                                <a href=\"#\">$cccc</a>
                            </div>
                            <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                            <div class=\"rating-stars\">$rate</div>
                            <h4 class=\"product-price\">
                                <del>$lp</del>$price
                            </h4>
                            <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                        </div>
                        <div class=\"product-button-group\">
                           <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                           <a pid ='$pro_id'  class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                           <a pid ='$pro_id' id='products' class=\"product-button\" href=\"#\"><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a>
                        </div>
                    </div>
            </div>
                ";
            } else {
                echo "
                <div class=\"product-card product-list mb-30\">
                <a class=\"product-thumb \" href=\"single-item?pid='.$pro_id.'&product='.$title.'\">
                    <img src=\"assets/images/shop/products/$image\" alt=\"$title\">
                </a>
                <div class=\"product-card-inner\">
                    <div class=\"product-card-body\">
                        <div class=\"product-category\">
                            <a href=\"#\">$cccc</a>
                        </div>
                        <h3 class=\"product-title\"><a href=\"single-item?pid='.$pro_id.'&product='.$title.'\">$title</a></h3>
                        <div class=\"rating-stars\">$rate</div>
                        <h4 class=\"product-price\">
                           $format
                        </h4>
                        <p class=\"text-sm text-muted hidden-xs-down my-1\">$desc</p>
                    </div>
                    <div class=\"product-button-group\">
                         <a pid='$pro_id' id='wishlists' remove_id='$pro_id' class=\"product-button btn-wishlist\" href=\"#\"><i class=\"icon-heart\"></i><span>Wishlist</span></a>
                         <a pid='$pro_id'  class=\"product-button btn-compare\" href=\"#\" ><i class=\"icon-repeat\" ></i><span> Compare</span></a>
                         <a pid= '$pro_id' id='products' class=\"product-button\" href=\"#\" ><i class=\"icon-shopping-cart\" ></i ><span > To Cart </span ></a >
                        
                </div>
                </div>
            </div>
                ";
            }
        }
        echo "</div>";
    }
}




