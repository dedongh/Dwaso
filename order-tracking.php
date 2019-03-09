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
    <title>Order Tracking</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Order Tracking</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="#">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Order Tracking</li>
            </ul>
        </div>
    </div>
</div>
<!--Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="card mb-3">
        <div class="p-4 text-center text-white bg-dark rounded-top"><span class="text-uppercase">Tracking Order No - </span><span class="text-medium">OrderID</span></div>
        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Delivered Via:</span> Ford</div>
            <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Status:</span> Processing Order</div>
            <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Expected Date:</span> May 26, 2018</div>
        </div>
        <div class="card-body">
            <div class="steps flex-sm-nowrap padding-top-1x padding-bottom-1x">
                <div class="step active"><i class="icon-shopping-bag"></i>
                    <h4 class="step-title">Confirmed Order</h4>
                </div>
                <div class="step active"><i class="icon-settings"></i>
                    <h4 class="step-title">Processing Order</h4>
                </div>
                <div class="step"><i class="icon-award"></i>
                    <h4 class="step-title">Quality Check</h4>
                </div>
                <div class="step"><i class="icon-truck"></i>
                    <h4 class="step-title">Product Dispatched</h4>
                </div>
                <div class="step"><i class="icon-home"></i>
                    <h4 class="step-title">Product Delivered</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-sm-between align-items-center">
        <div class="custom-control custom-checkbox mr-3">
            <input class="custom-control-input" type="checkbox" id="notify_me" checked>
            <label class="custom-control-label" for="notify_me">Notify me when order is delivered</label>
        </div>
        <div class="text-left text-sm-right"><a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#orderDetails">View Order Details</a></div>
    </div>
</div>
<!-- Open Ticket Modal-->
<div class="modal fade" id="orderDetails" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order No  - OrderID</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <tr>
                            <td>
                                <div class="product-item"><a class="product-thumb" href="#"><img src="assets/images/shop/cart/03.jpg" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="#">Laptop<small>x 1</small></a></h4><span><em>Type:</em> TouchScreen</span><span><em>Color:</em> Black</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg">₵1,910.00</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-item"><a class="product-thumb" href="#"><img src="assets/images/shop/cart/02.jpg" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="#">Apple iPhone X 256 GB Space Gray<small>x 1</small></a></h4><span><em>Memory:</em> 256 GB</span><span><em>Color:</em> Space Gray</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg">₵1,450.00</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-item"><a class="product-thumb" href="#"><img src="assets/images/shop/cart/04.jpg" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="#">Samsung Galaxy S9+<small>x 1</small></a></h4><span><em>Memory:</em> 256 GB</span><span><em>Color:</em> White</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg">₵1,188.50</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr class="mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
                    <div class="px-2 py-1"><span class='text-muted'>Subtotal:</span> <span class='text-gray-dark'>₵2,548.50</span></div>
                    <div class="px-2 py-1"><span class='text-muted'>Delivery:</span> <span class='text-gray-dark'>₵1,126.50</span></div>
                    <div class="px-2 py-1"><span class='text-muted'>Tax:</span> <span class='text-gray-dark'>₵1,129.72</span></div>
                    <div class="text-lg px-2 py-1"><span class='text-muted'>Total:</span> <span class='text-gray-dark'>₵3,584.72</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<?php include_once "includes/footer.php"?>

</body>
</html>