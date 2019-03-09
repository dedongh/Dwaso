<?php include_once "../db.php";
if (!is_logged_in()) {
    header("Location: admin_login.php");
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GiLo Admin Dashboard</title>
        <?php include_once "includes/header.php" ?>
    </head>
<body>
<?php include_once "includes/nav.php"; ?>

<p>Admin Dashboard</p>
<?php
$txnQry1 = "select t.id, t.order_id, t.uid, t.full_name, t.description, t.txn_date, t.grand_total,
t.charge_id, c.items, c.paid, c.delivered
from transactions t
        left  join orders c on t.order_id = c.id
where c.paid = 0 and c.delivered  = 0
order by t.txn_date desc ";

$txnRes1 = $con->query($txnQry1);
if (isset($_GET["paid"])) {
    $id = (int)$_GET["id"];
    $paid = (string)$_GET["paid"];
    $stmt = $con->query("update orders set paid = '$paid' where id='$id'");
    header("location: index.php");
}
?>
<div class="col-md-12">
    <h3 class="text-center">Orders Pending Payment</h3>
    <table class="table table-condensed table-bordered table-striped">
        <thead>
        <tr>
            <th class="text-center"></th><th>Order ID</th><th class="text-center">Name</th><th class="text-center">Description</th><th class="text-center">Total</th><th class="text-center">Date</th>
            <th class="text-center">Paid</th>
        </tr>

        </thead>
        <tbody>
        <?php while ($order1 = $txnRes1->fetch_assoc()): ?>
            <tr>
                <td class="text-center"><a href="orders.php?txn_id=<?= $order1["id"];?>" class="btn btn-sm btn-info">Details</a></td>
                <td class="text-center"><b><?= $order1["charge_id"]?></b></td>
                <td class="text-center"><?= $order1["full_name"] ?></td>
                <td class="text-center"><?= $order1["description"] ?></td>
                <td class="text-center"><?= money($order1["grand_total"]) ?></td>
                <td class="text-center"><?= pretty_date($order1["txn_date"]) ?></td>
                <td class="text-center">
                    <a href="index.php?paid=<?= (($order1["paid"] == 0)?'1':'0');?>&id=<?= $order1["id"]; ?> " class="btn btn-sm btn-outline-info">
                        <span class="icon-<?= (($order1["paid"] == 1)? 'minus':'plus') ?>"></span>
                    </a>
                    <?= (($order1["paid"] == 0)?'Payment not received':'Payment Received') ?>
                    <span class="text-info"><br>toggle the + button if payment has been received</span>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php
$txnQry = "select t.id, t.order_id, t.uid, t.full_name, t.description, t.txn_date, t.grand_total,
t.charge_id, c.items, c.paid, c.delivered
from transactions t
        left  join orders c on t.order_id = c.id
where c.paid = 1 and c.delivered  = 0
order by t.txn_date desc ";

$txnRes = $con->query($txnQry);
?>
<div class="col-md-12">
    <h3 class="text-center">Orders to Deliver</h3>
    <table class="table table-condensed table-bordered table-striped">
        <thead>
        <tr>
            <th class="text-center"></th><th>Order ID</th><th class="text-center">Name</th><th class="text-center">Description</th><th class="text-center">Total</th><th class="text-center">Date</th>
        </tr>

        </thead>
        <tbody>
        <?php while ($order = $txnRes->fetch_assoc()): ?>
        <tr>
            <td class="text-center"><a href="orders.php?txn_id=<?= $order["id"];?>" class="btn btn-sm btn-info">Details</a></td>
            <td class="text-center"><b><?= $order["charge_id"]?></b></td>
            <td class="text-center"><?= $order["full_name"] ?></td>
            <td class="text-center"><?= $order["description"] ?></td>
            <td class="text-center"><?= money($order["grand_total"]) ?></td>
            <td class="text-center"><?= pretty_date($order["txn_date"]) ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div class="row">
<!--Sales by month-->
    <?php
    $thisYr = date("Y");
    $lastYr = $thisYr - 1;

    $thisYrQ = $con->query("select grand_total, txn_date from transactions where YEAR(txn_date) = '{$thisYr}'");
    $lastYrQ = $con->query("select grand_total, txn_date from transactions where YEAR(txn_date) = '{$lastYr}'");

    $current = array();
    $last = array();
    $currentTotal = 0;
    $lastTotal = 0;
    while ($x = $thisYrQ->fetch_assoc()) {
        $month = date("m", strtotime($x["txn_date"]));
        if (!array_key_exists($month, $current)) {
            $current[(int)$month] = $x["grand_total"];
        }else{
            $current[(int)$month] += $x["grand_total"];
        }
        $currentTotal += $x["grand_total"];
    }
    while ($y = $lastYrQ->fetch_assoc()) {
        $month = date("m", strtotime($y["txn_date"]));
        if (!array_key_exists($month, $current)) {
            $last[(int)$month] = $y["grand_total"];
        }else{
            $last[(int)$month] += $y["grand_total"];
        }
        $lastTotal += $y["grand_total"];
    }
    ?>
    <div class="col-md-4">
        <h3 class="text-center">Sales By Month</h3>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
            <tr>
                <th></th>
                <th class="font-weight-bold"><?= $lastYr; ?></th>
                <th class="font-weight-bold"><?= $thisYr; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 1; $i <= 12; $i++):
                $dt = DateTime::createFromFormat("!m", $i);
                ?>
            <tr <?= (date("m") == $i)?'class="bg-info text-white"':'' ?>>
                <td class="font-weight-bold"><?= $dt->format("F") ?></td>
                <td><?= (array_key_exists($i, $last))?money($last[$i]):money(0) ; ?></td>
                <td><?= (array_key_exists($i, $current))?money($current[$i]):money(0); ?></td>
            </tr>
            <?php endfor; ?>
            <tr>
                <td><b>Total</b></td>
                <td><b><?= money($lastTotal) ?></b></td>
                <td><b><?= money($currentTotal) ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--Inventory-->
    <div class="col-md-8">
        <h2 class="text-center">Inventory (Charts & others )</h2>
    </div>
</div>

<?php include_once "includes/footer.php" ?>
</body>
</html>
<?php ob_end_flush(); ?>