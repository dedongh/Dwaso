<?php
include_once "db.php";
$id = $_POST["id"];
$id = (int)$id;

$sql = $con->query("select * from transactions where id = '$id'");
$res = $sql->fetch_assoc();
$cart_id = $res["order_id"];

$ordQry = $con->query("select * from orders where id = '$cart_id'");
$cart = $ordQry->fetch_assoc();

$items = json_decode($cart["items"], true);

$idArray = array();
$products = array();
foreach ($items as $item) {
    $idArray[] = $item["product_id"];

}
$ids = implode(',', $idArray);
$productQry = $con->query("select i.p_id as 'id', i.title as 'title', i.image as 'images',
i.price as 'prices'
from products i

where i.p_id in ({$ids})");

while ($p = $productQry->fetch_assoc()) {
    foreach ($items as $item) {
        if ($item["product_id"] == $p["id"]) {
            $x = $item;
            continue;
        }
    }
    $products[] = array_merge($x, $p);

}
?>
<?php ob_start() ?>
<div class="modal fade" id="orderDetails" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order No  - <?= $res["charge_id"] ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="closeModal()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive shopping-cart mb-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="single-item?pid=<?= $product["id"]?>&product=<?= $product["title"] ?>">
                                        <img src="assets/images/shop/products/<?= $product["images"] ?>" alt="<?= $product["title"] ?>"></a>
                                    <div class="product-info">
                                        <h4 class="product-title">
                                            <a href="single-item?pid=<?= $product["id"]?>&product=<?= $product["title"] ?>"><?= $product["title"]. " ". $product["size"]. " ". $product["color"] ?> <small>x <?= $product["quantity"] ?></small></a></h4>
                                        <span><em>Memory:</em> <?= $product["size"] ?></span><span><em>Color:</em> <?= $product["color"] ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg"><?= money($product["price"]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr class="mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
                    <div class="px-2 py-1"><span class='text-muted'>Subtotal:</span> <span class='text-gray-dark'><?= money($res["sub_total"]) ?></span></div>
                    <div class="px-2 py-1"><span class='text-muted'>Delivery:</span> <span class='text-gray-dark'><?= money(DELIVERY) ?></span></div>
                    <div class="px-2 py-1"><span class='text-muted'>Tax:</span> <span class='text-gray-dark'><?= money($res["tax"]) ?></span></div>
                    <div class="text-lg px-2 py-1"><span class='text-muted'>Total:</span> <span class='text-gray-dark'><?= money($res["grand_total"]) ?></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function closeModal() {
        $("#orderDetails").modal("hide");
        setTimeout(function () {
            $("#orderDetails").remove();
            $(".modal-backdrop").remove();
        }, 500);
    }
</script>
<?php echo ob_get_clean() ?>