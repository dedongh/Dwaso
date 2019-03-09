<?php
include_once "db.php";
if (!is_cust_logged_in()) {
    cust_login_error_redirect();
}
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
    <title>My Orders</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>



<!--Page Content-->
<div class="container padding-top-2x padding-bottom-3x mb-2">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(assets/images/account/user-cover-img.jpg);"></div>
                <div class="user-info">
                    <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="assets/images/account/01.png" alt="User"></div>
                    <div class="user-data">
                        <h4 class="h5"><?=  ((!empty($cust_data["_name"]))? $cust_data["_name"]:"GiLo Mascot"); ?></h4><span>Joined <?= ((!empty($cust_data["date_joined"]))? pretty_date($cust_data["date_joined"]) :  date("d M Y "))  ?></span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
                <a class="list-group-item with-badge active" href="#"><i class="icon-shopping-bag"></i>Orders<span class="badge badge-default badge-pill orders">0</span></a>
                <a class="list-group-item" href="user"><i class="icon-user"></i>Profile</a>
                <a class="list-group-item with-badge " href="wishlist"><i class="icon-heart"></i>Wishlist<span class="badge badge-default badge-pill wished">0</span></a>
            </nav>
        </div>
        <?php
        $uid = $_SESSION["uid"];
        $orderQry = "select t.id, t.order_id, t.uid, t.full_name, t.description,
        t.txn_date, t.sub_total, t.grand_total, t.charge_id, c.items, c.paid, c.delivered
        from transactions t 
        left join orders c on t.order_id = c.id
        where c.uid = '$uid'";

        $orderRes = $con->query($orderQry);

        ?>
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date Purchased</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($ord = $orderRes->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <a class="navi-link ordal" onclick="detailsModal(<?= $ord["order_id"] ?>)" href="#" ><?= $ord["charge_id"] ?></a>
                        </td>
                        <td><?= pretty_date($ord["txn_date"]) ?></td>
                        <td><span class="<?= (($ord["delivered"] == 0)?'text-info':'text-success') ?>"><?= (($ord["delivered"] == 0)?'In Progress':'Delivered') ?></span></td>
                        <td><?= money($ord["grand_total"]) ?></td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a class="btn btn-link-primary margin-bottom-none" href="#">
                    <i class="icon-download"></i>&nbsp;Order Details</a>
            </div>
        </div>
    </div>
</div>
<!-- Open Ticket Modal-->


<!--footer-->

<?php include_once "includes/footer.php"?>

<script type="text/javascript">
    function detailsModal(id) {
        //alert(id);
        $.ajax({
            url: "orderDetailsModal.php",
            method: "POST",
            data:{id:id},
            success: function (data) {
                $("body").append(data);
                $("#orderDetails").modal("toggle");
            }
        })
    }
</script>
</body>
</html>