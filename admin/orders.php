<?php include_once "../db.php";
if (!is_logged_in()) {
    header("Location: admin_login.php");
}

//complete order
if (isset($_GET["complete"]) && $_GET["complete"] == 1) {
    $cart_id = sanitize((int)$_GET["cart_id"]);
    $con->query("update orders set delivered = 1 where id = '{$cart_id}'");
    $_SESSION["success_msg"] = "The order has been Completed";
    header("location: index.php");
}

$txn_id = sanitize((int)$_GET["txn_id"]);
$txnQry = $con->query("select * from transactions where id = '{$txn_id}'");
$txn = $txnQry->fetch_assoc();
$cart_id = $txn["order_id"];
$cartQ = $con->query("select * from orders where id = '{$cart_id}'");
$cart = $cartQ->fetch_assoc();
$items = json_decode($cart["items"], true);

$idArray = array();
$products = array();

foreach ($items as $item) {
    $idArray[] = $item["product_id"];

}
$ids = implode(',', $idArray);
//echo $ids;
$productQry = $con->query("
select i.p_id as 'id', i.title as 'title', c.c_id as 'cid', c.name as 'child',
p.name as 'parent'
from products i
left join categories c on i.c_id = c.c_id
left join categories p on c.parent = p.c_id
where i.p_id in ({$ids});
");
while ($p = $productQry->fetch_assoc()) {
    foreach ($items as $item) {
        if ($item["product_id"] == $p["id"]) {
            $x = $item;
            continue;
        }
    }
    $products[] = array_merge($x, $p);

}
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

    <title>GiLo Orders</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php"; ?>

<br><br>
<h2 class="text-center">Items Ordered</h2>
<table class="table table-condensed table-bordered table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <th>Quantity</th>
        <th>Category</th>
        <th>Size</th>
        <th>Colour</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product["title"]; ?></td>
        <td><?= $product["quantity"] ?></td>
        <td><?= $product["parent"]. ' ~ '.$product["child"] ?></td>
        <td><?= $product["size"] ?></td>
        <td><?= $product["color"] ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>

</table>
<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Order Details</h3>
        <table class="table table-condensed table-striped table-bordered">
            <tbody>
            <tr>
                <td>Sub Total</td>
                <td><?= money($txn["sub_total"]); ?></td>
            </tr>
            <tr>
                <td>Tax</td>
                <td><?= money($txn["tax"]); ?></td>
            </tr>
            <tr>
                <td>Delivery</td>
                <td><?= money(DELIVERY); ?></td>
            </tr>
            <tr>
                <td>Grand Total</td>
                <td><?= money($txn["grand_total"]); ?></td>
            </tr>
            <tr>
                <td>Order Date</td>
                <td><?= pretty_date($txn["txn_date"]); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h3 class="text-center">Delivery Address</h3>
        <address>
            <?= $txn["full_name"]; ?><br>
            <?= $txn["email"]; ?><br>
            <?= $txn["phone"]; ?><br>
            <?= $txn["address1"]; ?><br>
        </address>
    </div>
</div>
<div class="float-right">
    <a href="index.php" class="btn btn-lg btn-secondary">Cancel</a>
    <a href="orders.php?complete=1&cart_id=<?= $cart_id;?>" class="btn btn-outline-primary btn-lg">Complete Order</a>
</div>
</body>
</html>
<?php ob_end_flush(); ?>