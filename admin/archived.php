<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 10/13/2018
 * Time: 3:57 PM
 */
require_once "../db.php";
if (!is_logged_in()) {
    login_error_redirect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Archived Products</title>
    <?php include_once "includes/header.php"?>
</head>
<body>
<?php include_once "includes/nav.php"?>

<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Archived Products</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Archived</li>
            </ul>
        </div>
    </div>
</div>

<?php
if (isset($_GET["delete"])) {
    $del_id = sanitize($_GET["delete"]);
    $con->query("update products set deleted = 0 where p_id = '$del_id'");
    header("Location: archived.php");
}
$sql = "select * from products where deleted = 1";
$pRes = $con->query($sql);
?>

<table class="table table-responsive table-condensed table-bordered table-striped">
    <thead>
    <tr>
        <th></th>
        <?php $headers = $pRes->fetch_fields();
        foreach ($headers as $field)
            echo "<th class='text-center'>$field->name</th>";
        ?>
    </tr>
    </thead>
    <tbody>
    <?php while ($products = $pRes->fetch_assoc()):
        $childID = $products["c_id"];
        $catSQL = "select * from categories where c_id = '$childID'";
        $res = $con->query($catSQL);
        $child = $res->fetch_assoc();
        $mmm = $child["name"];
        $parentID = $child["parent"];
        $pSQL = "select * from categories where c_id = '$parentID'";
        $pResults = $con->query($pSQL);
        $parent = $pResults->fetch_assoc();
        $category = $parent["name"]. '-'. $child["name"];
        ?>
        <tr>
            <td>
                 <a href="archived.php?delete=<?= $products["p_id"] ?>" class="btn btn-sm btn-outline-success"><span class="icon-refresh-ccw"></span></a>
            </td>
            <td class="text-center"><?= $products["p_id"]?></td><td><?= $products["title"]?></td><td class="text-center"><?= money($products["price"])?></td>
            <td class="text-center"><?= (($products["list_price"] != null)? money($products["list_price"]):$products["list_price"]) ?></td><td class="text-center"><?= $products["b_id"]?></td>
            <td class="text-center"><?= $category?></td>
            <td class="text-center"> <img src="../assets/images/shop/products/<?= $products["image"]?>" width="100" height="30" alt="<?= $products["image"]?>"></td>
            <td class="text-center"><?= $products["description"]?></td><td class="text-center"><?= $products["quantity"]?></td><td class="text-center"><?= $products["keywords"]?></td><td class="text-center"><?= $products["sizes"]?></td><td class="text-center"><?= $products["color"]?></td>
            <td class="text-center"><?= $products["memory"]?></td><td class="text-center"><?= $products["conditions"]?></td><td class="text-center"><?= $products["status"]?></td><td class="text-center"><?= $products["availability"]?></td>
            <td class="text-center"><?= $products["rating"]?></td>
            <td class="text-center">
                <a href="products.php?tag=<?= (($products["tags"] == '0')?'Featured':'0');?>&id=<?= $products["p_id"];?>" class="btn btn-sm btn-secondary ">
                    <span class="icon-<?= (($products["tags"] == "Featured")?'minus':'plus') ?>"></span>
                </a>
                &nbsp; <?= (($products["tags"] == "Featured")?'Featured Products':'Not Featured') ?>
            </td>
            <td class="text-center">
                <a href="products.php?bs=<?= (($products["best_sellers"] == 0)?'1':'0');?>&id=<?= $products["p_id"];?>" class="btn btn-sm btn-secondary">
                    <span class="icon-<?= (($products["best_sellers"] == 1)?'minus':'plus');?>"></span>
                </a>
                <?= (($products["best_sellers"] == 1)?'Best Selling':'Not Best Selling');?>
            </td>
            <td class="text-center">
                <a href="products.php?new_arr=<?= (($products["new_arrivals"] == 0)?'1':'0');?>&id=<?= $products["p_id"];?>" class="btn btn-sm btn-secondary">
                    <span class="icon-<?= (($products["new_arrivals"] == 1)?'minus':'plus');?>"></span>
                </a>
                <?= (($products["new_arrivals"] == 1)?'Just In':'Not New Arrival');?>
            </td>
            <td class="text-center">
                <a href="products.php?slight=<?= (($products["slightly_used"] == 0)?'1':'0');?>&id=<?= $products["p_id"];?>" class="btn btn-sm btn-secondary">
                    <span class="icon-<?= (($products["slightly_used"] == 1)?'minus':'plus');?>"></span>
                </a>
                <?= (($products["slightly_used"] == 1)?'Used':'Not Used');?>
            </td>
            <td class="text-center"><?= $products["deleted"]?></td>
        </tr>
    <?php endwhile;?>
    </tbody>
</table>
<?php include_once "includes/footer.php"?>
</body>
</html>





