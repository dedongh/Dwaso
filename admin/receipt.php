<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/7/2018
 * Time: 12:46 AM
 */
include_once "../db.php";
require "../send-mail.php";

function fetch_customer_data()
{
    global $con;
    $query = "select * from products limit 5";
    $stmt = $con->query($query);

    $output = '
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
    <tr>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
    </tr>
    ';

    while ($result = $stmt->fetch_assoc()) {
        $output .= '
        <tr>
            <td>'.$result["title"].'</td>
            <td>'.$result["price"].'</td>
            <td><img src="../assets/images/shop/products/'.$result["image"].'"  width="100" height="30"></td>
        </tr>
        ';
    }
    $output .= '</table></div>';
    return $output;
}

$message = "";
if (isset($_POST["action"])) {
    include "../pdf.php";
    $file_name = md5(rand()). ".pdf";
    $html_code = "<link rel=\"stylesheet\" media=\"screen\" href=\"../assets/css/vendor.css\">";
    $html_code .= "<link id=\"mainStyles\" rel=\"stylesheet\" media=\"screen\" href=\"../assets/css/styles.css\">";
    $html_code .= fetch_customer_data();
    $pdf = new Pdf();
    $pdf->loadHtml($html_code);
    $pdf->render();
    $file = $pdf->output();
    file_put_contents($file_name, $file);

    $reci = "slimshades68@gmail.com";

    $subj = "Your Order Details";
    $body = "Please Find attached to this email your order details and invoice receipt";


    sendMailToUserWithAttachment($reci, "Bra Emma", $subj, $body, $file_name);

    unlink($file_name);

    $message = "message sent";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Gilo Cooperate | Invoice</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Sales Receipt</h1>
        </div>
        <div class="column">
            <img src="../assets/images/logo/logo.jpg"  width="252" height="60" style="object-fit: scale-down;">
        </div>
    </div>
</div>

<!--<div class="container">
    <div class="row">
        <div class="col-md-4 offset-8">
            <h6>Date: <?/*= date("Y/m/d") */?></h6>
            <h6>Invoice No.: ENG1234KASA</h6>
            <h6>Warranty: <?/*= date("Y/m/d", strtotime("+30 days")) */?></h6>
            <h6></h6>
           <!-- <div class="row">
                <div class="col-md-4">
                    <img src="../assets/images/logo/logo.jpg" width="272" height="90">
                </div>
                <div class="col-md-8">
                    <h5 class="text-info">GILO Company Limited</h5>
                    <h5 class="text-info">P. O. BOX KS 16461</h5>
                    <h5 class="text-info">ADUM KUMASI</h5>
                    <h5 class="text-info">GHANA</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-info">Phone #</h5>
                    <h5 class="text-info">E-mail</h5>
                    <h5 class="text-info">Web Site</h5>
                </div>
                <div class="col-md-8">
                    <h5 class="text-info">0574449950 / 0548242578</h5>
                    <h5 class="text-info">gilocooperate@gmail.com</h5>
                    <h5 class="text-info">www.giloshop.com</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <img src="../assets/images/logo/logo.jpg" width="272" height="90">
            <h6 class="text-info">GILO Company Limited</h6>
            <h6 class="text-info">P. O. BOX KS 16461</h6>
            <h6 class="text-info">ADUM KUMASI</h6>
            <h6 class="text-info">GHANA</h6>
        </div>
    </div>
</div>-->

<div class="container">
    <h3 class="text-center">Demo Sales Report </h3>
    <h3 class="text-center">EK Services Ltd </h3>
    <form method="post">
        <input type="submit" name="action" class="btn btn-outline-success" value="Send PDF">
    </form>
    <?= $message ?>
</div>


<div class="site-backdrop"></div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/app.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/vendor.js"></script>
<script src="../assets/js/card.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/iziToast.min.js"></script>
<!-- Customizer scripts-->
<script src="../assets/customizer/customizer.js"></script>
</body>
</html>




