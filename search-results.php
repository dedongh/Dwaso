<?php
include_once "db.php";
error_reporting(0);
function sql_inject($input)
{
    global $con;
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlentities($input);
    $input = htmlspecialchars($input);
    $input = $con->real_escape_string($input);

    return $input;
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

     <title>Search Results for: <?= ((isset($_GET["search"]))? $_GET["search"]: "") ?></title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!-- Page Content-->
<div class="container padding-top-2x padding-bottom-3x mb-2">
 <p>Showing <span id="fs"></span>  results for <?= $_GET["search"] ?> </p>
    <div class="row">
        <?php
        if (isset($_GET["search"]) ) {
            $keyword = sql_inject($_GET["search"]);
            $search_exploded = explode(" ",$keyword);
            $x = 0;
            $construct = " ";
            foreach ($search_exploded as $search_each) {
                $x++;
                if ($x == 1) {
                    $construct .= "title LIKE '%$search_each%'";
                }else{
                    $construct .= "and title like '%$search_each%'";
                }
                $construct = "select * from products where $construct";
                $results = $con->query($construct);
                $foundNum = $results->num_rows;
                 echo "
<input type='hidden' id='fn' value='$foundNum' name='foundNum'>";
            
                if ($foundNum > 0) {
                    while ($row = $results->fetch_assoc()){
                        $pro_id = $row["p_id"];
                        $title = $row["title"];
                        $image = $row["image"];
                        $price = $row["price"];
                        $desc = $row["description"];
                        $memory = $row["memory"];
                        $color = $row["color"];
                        $price = money($price);
                        $desc = substr($desc,0,50);
                        echo "
                         <div class=\"col-xl-12 col-lg-12\">
            <div class=\"card mb-4\">
                <div class=\"card-body\"><span class=\"badge badge-primary\">Product</span>
                    <div class=\"d-flex pt-3\"><a class=\"w-200 pr-4 hidden-xs-down\" href=\"single-item?pid=$pro_id&product=$title\">
                            <img src=\"assets/images/shop/products/$image\" alt=\"\"></a>
                        <div>
                            <h6><a class=\"navi-link text-gray-dark\" href=\"single-item?pid=$pro_id&product=$title\">
                                    <span style=\"color: #312E67;font-family: Helvetica, Arial, sans-serif !important; font-size: 14px;\">$title &nbsp; $memory &nbsp; $color</span> </a></h6>
                            <span style=\"color: #312E67;\" class=\"d-block mb-2 text-lg\">$price</span>
                            <p style=\"color: #312E67;\">$desc...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        ";
                    }
                }
            }
        }
        ?>
    </div>
</div>

<!--footer-->
<?php include_once "includes/footer.php" ?>
<script>
var sm = $("#fn").val();
$("#fs").html(sm);
</script>
</body>
</html>