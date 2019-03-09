<?php
include_once "db.php";
require_once "send-mail.php";
if (!is_cust_logged_in()) {
    cust_login_error_redirect();
}

$ip_add =  getUserIP();
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
    <title>Checkout </title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->
<?php  include_once "includes/nav.php"; ?>
<!-- Page Title-->
<div class="padding-top-2x">
    
</div>
<?php
if (isset($_SESSION["uid"])) {
    $uid = $_SESSION["uid"];
    $fn = $_SESSION["full_name"];
    $email = $_SESSION["email"];
    $phone = $_SESSION["phone"];
    $adr1 = $_SESSION["address"];
    $sub_total = $_SESSION["sub_total"];
    $gt = $_SESSION["grand_total"];
    if ($_SESSION["n"] > 1)
        $s = "s";
    else
        $s = "";
    $desc = $_SESSION["n"] . " item".$s. " bought from GILO Shop GH Ltd";
    $tax = TAXRATE;
    $rand = substr(md5(mt_rand()), 0, 9);
    $rand = strtoupper($rand);

    $sql1 = "SELECT p.title, p.price, c.qty,c.uid, c.p_id, c.color, c.size
from products p  JOIN cart c 
ON p.p_id = c.p_id";
    $res = $con->query($sql1);
    while ($row = $res->fetch_assoc()){
        $response[] = array(
            "product_id" => $row["p_id"],
            "title" =>$row["title"],
            "price" =>$row["price"],
            "quantity" =>$row["qty"],
            "user_id" =>$row["uid"],
            "color" =>$row["color"],
            "size" =>$row["size"]
        );
    }
    $items = json_encode($response);

    $exp_date = date("Y-m-d H:i:s", strtotime("+30 days"));
    $qry = "insert into orders(items, ip_add, uid, expire_date) 
VALUES ('$items','$ip_add','$uid','$exp_date')";
    $con->query($qry);
    $cart_id = $con->insert_id;


    $sql = "insert into transactions(`charge_id`, order_id, `uid`, `full_name`, `email`, `phone`, `address1`, 
`sub_total`, `tax`, `grand_total`, `description`, `txn_type`) 
values ('$rand','$cart_id','$uid','$fn','$email','$phone','$adr1','$sub_total','$tax','$gt','$desc','POD')";
    $con->query($sql);

    $del = $con->query("delete from cart where ip_add = '$ip_add'
and uid ='$uid'");

    $msg = " Thanks for shopping with us... your order ID is ".$rand;
    $rec = $_SESSION["email"];
    $nm = $_SESSION["full_name"];
    $subj = "Your Order has been received";
    sendMailToUser($rec,$nm,$subj,$msg);

    $msg1 = "A new order was placed by ". $nm. " with order ID ".$rand." and transaction ID N/A";
    $rec1 = "info@giloshop.com";
    $nms = $_SESSION["full_name"];
    $subj1 = "New Order Received Giloshop.com";
    sendMailToUser($rec1,$nms,$subj1,$msg1);

    unset($_SESSION["full_name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["phone"]);
    unset($_SESSION["address"]);
    unset($_SESSION["sub_total"]);
    unset($_SESSION["grand_total"]);
    unset($_SESSION["n"]);


}

?>
<!--Page Content-->
<div class="container padding-bottom-3x mb-2">
    <div class="card text-center">
        <div class="card-body padding-top-2x">
            <h3 class="card-title">Thank you for your order!</h3>
             <p class="card-text">Your Order ID is <span class="text-medium"><?= $rand ?></span> </p>
            <p class="card-text">Your order has been placed and will be processed as soon as possible.</p>

            <p class="card-text">Please take note of your order ID for Item collection </p>
            <p class="card-text">You will be receiving an email shortly with confirmation of your order. You can now:
            </p>
            <div class="padding-top-1x padding-bottom-1x">
                <a class="btn btn-outline-secondary" href="grid-view">Go Back Shopping</a>
                <a class="btn btn-outline-primary" href="order-tracking"><i class="icon-map-pin"></i>&nbsp;Track order</a>
            </div>
        </div>
    </div>
</div>

<!--footer-->
<?php include_once "includes/footer.php" ?>
</body>
</html>