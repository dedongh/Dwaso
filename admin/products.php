<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 8/24/2018
 * Time: 9:27 AM
 */

require_once "../db.php";
if (!is_logged_in()) {
    login_error_redirect();
}
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php" ?>

<style type="text/css">
    .hide{
        display: none;
    }

</style>

<div class="page-title">
    <div class="container">
        <div class="column">
            <h1><?= ((isset($_GET["add"]))? "Add New Products":"Products") ?></h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li><?= ((isset($_GET["add"]))? "Add New Products":"Products") ?></li>
            </ul>
        </div>
    </div>
</div>

<?php

if (isset($_GET["delete"])) {
    $del_id = sanitize($_GET["delete"]);
    $con->query("update products set deleted = 1 where p_id = '$del_id'");
    header("Location: products.php");
}
$dbpath = "";
$uploadLoc = "";

if (isset($_GET["add"]) || isset($_GET["edit"])) {
    $brandQry = $con->query("select * from brands order by name asc ");
    $parentQry = $con->query("select * from categories where parent = 0 order by name");

    $title = ((isset($_POST["title"]) && $_POST["title"] != "")? sanitize($_POST["title"]):"");
    $p_brand = ((isset($_POST["brand"]) && $_POST["brand"] != "")? sanitize($_POST["brand"]):"");
    $p_cat = ((isset($_POST["category"]) && $_POST["category"] != "")? sanitize($_POST["category"]):"");
    $my_cat = ((isset($_POST["child"]) && $_POST["child"] != "")? sanitize($_POST["child"]):"");
    $price = ((isset($_POST["price"]) && $_POST["price"] != "")? sanitize($_POST["price"]):"");
    $lp = ((isset($_POST["list_price"]) && $_POST["list_price"] != "")? sanitize($_POST["list_price"]):"");
    $desc = ((isset($_POST["desc"]) && $_POST["desc"] != "")? sanitize($_POST["desc"]):"");
    $sizes = ((isset($_POST["sizes"]) && $_POST["sizes"] != "")? sanitize($_POST["sizes"]):"");
    $color = ((isset($_POST["color"]) && $_POST["color"] != "")? sanitize($_POST["color"]):"");
    $memory = ((isset($_POST["memory"]) && $_POST["memory"] != "")? sanitize($_POST["memory"]):"");
    $status = ((isset($_POST["status"]) && $_POST["status"] != "")? sanitize($_POST["status"]):"");
    $p_qty = ((isset($_POST["p_qty"]) && $_POST["p_qty"] != "")? sanitize($_POST["p_qty"]):"");
    $keywords = ((isset($_POST["keywords"]) && $_POST["keywords"] != "")? sanitize($_POST["keywords"]):"");
    $features = ((isset($_POST["features"]) && $_POST["features"] != "")? sanitize($_POST["features"]):"");
    $cond = ((isset($_POST["conditions"]) && $_POST["conditions"] != "")? sanitize($_POST["conditions"]):"");
    $tags = ((isset($_POST["tags"]) && $_POST["tags"] != "")? sanitize($_POST["tags"]):"");
    $avail = ((isset($_POST["avail"]) && $_POST["avail"] != "")? sanitize($_POST["avail"]):"");

    //laptop
    $screen_size = ((isset($_POST["screen_size"]) && $_POST["screen_size"] != "")? sanitize($_POST["screen_size"]):"");
    $screen_res = ((isset($_POST["screen_res"]) && $_POST["screen_res"] != "")? sanitize($_POST["screen_res"]):"");
    $max_scr_res = ((isset($_POST["max_scr_res"]) && $_POST["max_scr_res"] != "")? sanitize($_POST["max_scr_res"]):"");
    $processor = ((isset($_POST["processor"]) && $_POST["processor"] != "")? sanitize($_POST["processor"]):"");
    $ram = ((isset($_POST["ram"]) && $_POST["ram"] != "")? sanitize($_POST["ram"]):"");
    $memory_speed = ((isset($_POST["memory_speed"]) && $_POST["memory_speed"] != "")? sanitize($_POST["memory_speed"]):"");
    $hard_drive = ((isset($_POST["hard_drive"]) && $_POST["hard_drive"] != "")? sanitize($_POST["hard_drive"]):"");
    $graphics_coprocessor = ((isset($_POST["graphics_coprocessor"]) && $_POST["graphics_coprocessor"] != "")? sanitize($_POST["graphics_coprocessor"]):"");
    $chipset_brand = ((isset($_POST["chipset_brand"]) && $_POST["chipset_brand"] != "")? sanitize($_POST["chipset_brand"]):"");
    $card_desc = ((isset($_POST["card_desc"]) && $_POST["card_desc"] != "")? sanitize($_POST["card_desc"]):"");
    $wireless_type = ((isset($_POST["wireless_type"]) && $_POST["wireless_type"] != "")? sanitize($_POST["wireless_type"]):"");
    $brand_name = ((isset($_POST["brand_name"]) && $_POST["brand_name"] != "")? sanitize($_POST["brand_name"]):"");
    $series = ((isset($_POST["series"]) && $_POST["series"] != "")? sanitize($_POST["series"]):"");
    $os = ((isset($_POST["os"]) && $_POST["os"] != "")? sanitize($_POST["os"]):"");
    $item_weight = ((isset($_POST["item_weight"]) && $_POST["item_weight"] != "")? sanitize($_POST["item_weight"]):"");
    $dimen = ((isset($_POST["dimen"]) && $_POST["dimen"] != "")? sanitize($_POST["dimen"]):"");
    $processor_brand = ((isset($_POST["processor_brand"]) && $_POST["processor_brand"] != "")? sanitize($_POST["processor_brand"]):"");
    $processor_count = ((isset($_POST["processor_count"]) && $_POST["processor_count"] != "")? sanitize($_POST["processor_count"]):"");
    $comp_mem_type = ((isset($_POST["comp_mem_type"]) && $_POST["comp_mem_type"] != "")? sanitize($_POST["comp_mem_type"]):"");
    $hd_rotational_speed = ((isset($_POST["hd_rotational_speed"]) && $_POST["hd_rotational_speed"] != "hd_rotational_speed")? sanitize($_POST["hd_rotational_speed"]):"");
    $batteries = ((isset($_POST["batteries"]) && $_POST["batteries"] != "")? sanitize($_POST["batteries"]):"");
    $hd_interface = ((isset($_POST["hd_interface"]) && $_POST["hd_interface"] != "")? sanitize($_POST["hd_interface"]):"");

//phones
    $unlock_phones = ((isset($_POST["unlock_phones"]) && $_POST["unlock_phones"] != "")? sanitize($_POST["unlock_phones"]):"");
    $display_size = ((isset($_POST["display_size"]) && $_POST["display_size"] != "display_size")? sanitize($_POST["display_size"]):"");
    $cpu_manu = ((isset($_POST["cpu_manu"]) && $_POST["cpu_manu"] != "")? sanitize($_POST["cpu_manu"]):"");
    $battery_type = ((isset($_POST["battery_type"]) && $_POST["battery_type"] != "")? sanitize($_POST["battery_type"]):"");
    $release_date = ((isset($_POST["release_date"]) && $_POST["release_date"] != "")? sanitize($_POST["release_date"]):"");
    $touchscreen_type = ((isset($_POST["touchscreen_type"]) && $_POST["touchscreen_type"] != "")? sanitize($_POST["touchscreen_type"]):"");
    $rear_camera = ((isset($_POST["rear_camera"]) && $_POST["rear_camera"] != "")? sanitize($_POST["rear_camera"]):"");
    $item_cond = ((isset($_POST["item_cond"]) && $_POST["item_cond"] != "")? sanitize($_POST["item_cond"]):"");
    $camera_type = ((isset($_POST["camera_type"]) && $_POST["camera_type"] != "")? sanitize($_POST["camera_type"]):"");
    $talk_time = ((isset($_POST["talk_time"]) && $_POST["talk_time"] != "")? sanitize($_POST["talk_time"]):"");
    $display_color = ((isset($_POST["display_color"]) && $_POST["display_color"] != "")? sanitize($_POST["display_color"]):"");
    $cellular = ((isset($_POST["cellular"]) && $_POST["cellular"] != "")? sanitize($_POST["cellular"]):"");
    $battery_capacity = ((isset($_POST["battery_capacity"]) && $_POST["battery_capacity"] != "")? sanitize($_POST["battery_capacity"]):"");
    $front_camera = ((isset($_POST["front_camera"]) && $_POST["front_camera"] != "")? sanitize($_POST["front_camera"]):"");
    $cpu = ((isset($_POST["cpu"]) && $_POST["cpu"] != "")? sanitize($_POST["cpu"]):"");
    $rec_def = ((isset($_POST["rec_def"]) && $_POST["rec_def"] != "")? sanitize($_POST["rec_def"]):"");
    $simcard_qty = ((isset($_POST["simcard_qty"]) && $_POST["simcard_qty"] != "")? sanitize($_POST["simcard_qty"]):"");
    $rom = ((isset($_POST["rom"]) && $_POST["rom"] != "")? sanitize($_POST["rom"]):"");
    $model = ((isset($_POST["model"]) && $_POST["model"] != "")? sanitize($_POST["model"]):"");
    $wlan = ((isset($_POST["wlan"]) && $_POST["wlan"] != "")? sanitize($_POST["wlan"]):"");
    $bluetooth = ((isset($_POST["bluetooth"]) && $_POST["bluetooth"] != "")? sanitize($_POST["bluetooth"]):"");
    $gps = ((isset($_POST["gps"]) && $_POST["gps"] != "")? sanitize($_POST["gps"]):"");


    $saved_photo = "";

    if (isset($_GET["edit"])) {
        $edit_id = (int)$_GET["edit"];
        $editSQL = $con->query("select * from products where p_id = '$edit_id'");
        $pro_edt = $editSQL->fetch_assoc();

        if (isset($_GET["delete_img"])) {
            $image_url = BASEURL."assets/images/shop/products/". $pro_edt["image"];

            unlink($image_url);
            $con->query("update products set image = '' where p_id = '$edit_id'");
            header("location: products.php?edit=" . $edit_id);
        }

        $my_cat = ((isset($_POST["child"]) && !empty($_POST["child"]))?sanitize($_POST["child"]): $pro_edt["c_id"]);
        $title = ((isset($_POST["title"]) && !empty($_POST["title"]))?sanitize($_POST["title"]): $pro_edt["title"]);
        $p_brand = ((isset($_POST["brand"]) && !empty($_POST["brand"]))?sanitize($_POST["brand"]): $pro_edt["b_id"]);
        $price = ((isset($_POST["price"]) && !empty($_POST["price"]))?sanitize($_POST["price"]): $pro_edt["price"]);
        $lp = ((isset($_POST["list_price"]) )?sanitize($_POST["list_price"]): $pro_edt["list_price"]);
        $desc = ((isset($_POST["desc"]) && !empty($_POST["desc"]))?sanitize($_POST["desc"]): $pro_edt["description"]);
        $sizes = ((isset($_POST["sizes"]) )?sanitize($_POST["sizes"]): $pro_edt["sizes"]);
        $color = ((isset($_POST["color"]) && !empty($_POST["color"]))?sanitize($_POST["color"]): $pro_edt["color"]);
        $memory = ((isset($_POST["memory"]) && !empty($_POST["memory"]))?sanitize($_POST["memory"]): $pro_edt["memory"]);
        $status = ((isset($_POST["status"]) )?sanitize($_POST["status"]): $pro_edt["status"]);
        $p_qty = ((isset($_POST["p_qty"]) && !empty($_POST["p_qty"]))?sanitize($_POST["p_qty"]): $pro_edt["quantity"]);
        $keywords = ((isset($_POST["keywords"]) && !empty($_POST["keywords"]))?sanitize($_POST["keywords"]): $pro_edt["keywords"]);
        $features = ((isset($_POST["features"]) && !empty($_POST["features"]))?sanitize($_POST["features"]): $pro_edt["features"]);
        $cond = ((isset($_POST["conditions"]) && !empty($_POST["conditions"]))?sanitize($_POST["conditions"]): $pro_edt["conditions"]);
        $tags = ((isset($_POST["tags"]) && !empty($_POST["tags"]))?sanitize($_POST["tags"]): $pro_edt["tags"]);
        $avail = ((isset($_POST["avail"]) )?sanitize($_POST["avail"]): $pro_edt["availability"]);

//laptops
        $screen_size = ((isset($_POST["screen_size"]) && !empty($_POST["screen_size"]))?sanitize($_POST["screen_size"]): $pro_edt["screen_size"]);
        $screen_res = ((isset($_POST["screen_res"]) && !empty($_POST["screen_res"]))?sanitize($_POST["screen_res"]): $pro_edt["screen_res"]);
        $max_scr_res = ((isset($_POST["max_scr_res"]) && !empty($_POST["max_scr_res"]))?sanitize($_POST["max_scr_res"]): $pro_edt["max_scr_res"]);
        $processor = ((isset($_POST["processor"]) && !empty($_POST["processor"]))?sanitize($_POST["processor"]): $pro_edt["processor"]);
        $ram = ((isset($_POST["ram"]) && !empty($_POST["ram"]))?sanitize($_POST["ram"]): $pro_edt["ram"]);
        $memory_speed = ((isset($_POST["memory_speed"]) && !empty($_POST["memory_speed"]))?sanitize($_POST["memory_speed"]): $pro_edt["memory_speed"]);
        $hard_drive = ((isset($_POST["hard_drive"]) && !empty($_POST["hard_drive"]))?sanitize($_POST["hard_drive"]): $pro_edt["hard_drive"]);
        $graphics_coprocessor = ((isset($_POST["graphics_coprocessor"]) && !empty($_POST["graphics_coprocessor"]))?sanitize($_POST["graphics_coprocessor"]): $pro_edt["graphics_coprocessor"]);
        $chipset_brand = ((isset($_POST["chipset_brand"]) && !empty($_POST["chipset_brand"]))?sanitize($_POST["chipset_brand"]): $pro_edt["chipset_brand"]);
        $card_desc = ((isset($_POST["card_desc"]) && !empty($_POST["card_desc"]))?sanitize($_POST["card_desc"]): $pro_edt["card_desc"]);
        $wireless_type = ((isset($_POST["wireless_type"]) && !empty($_POST["wireless_type"]))?sanitize($_POST["wireless_type"]): $pro_edt["wireless_type"]);
        $brand_name = ((isset($_POST["brand_name"]) && !empty($_POST["brand_name"]))?sanitize($_POST["brand_name"]): $pro_edt["brand_name"]);
        $series = ((isset($_POST["series"]) && !empty($_POST["series"]))?sanitize($_POST["series"]): $pro_edt["series"]);
        $os = ((isset($_POST["os"]) && !empty($_POST["os"]))?sanitize($_POST["os"]): $pro_edt["os"]);
        $item_weight = ((isset($_POST["item_weight"]) && !empty($_POST["item_weight"]))?sanitize($_POST["item_weight"]): $pro_edt["item_weight"]);
        $dimen = ((isset($_POST["dimen"]) && !empty($_POST["dimen"]))?sanitize($_POST["dimen"]): $pro_edt["dimen"]);
        $processor_brand = ((isset($_POST["processor_brand"]) && !empty($_POST["processor_brand"]))?sanitize($_POST["processor_brand"]): $pro_edt["processor_brand"]);
        $processor_count = ((isset($_POST["processor_count"]) && !empty($_POST["processor_count"]))?sanitize($_POST["processor_count"]): $pro_edt["processor_count"]);
        $comp_mem_type = ((isset($_POST["comp_mem_type"]) && !empty($_POST["comp_mem_type"]))?sanitize($_POST["comp_mem_type"]): $pro_edt["comp_mem_type"]);
        $hd_rotational_speed = ((isset($_POST["hd_rotational_speed"]) && !empty($_POST["hd_rotational_speed"]))?sanitize($_POST["hd_rotational_speed"]): $pro_edt["hd_rotational_speed"]);
        $batteries = ((isset($_POST["batteries"]) && !empty($_POST["batteries"]))?sanitize($_POST["batteries"]): $pro_edt["batteries"]);
        $hd_interface = ((isset($_POST["hd_interface"]) && !empty($_POST["hd_interface"]))?sanitize($_POST["hd_interface"]): $pro_edt["hd_interface"]);
        //phones
        $unlock_phones = ((isset($_POST["unlock_phones"]) && !empty($_POST["unlock_phones"]))?sanitize($_POST["unlock_phones"]): $pro_edt["unlock_phones"]);
        $display_size = ((isset($_POST["display_size"]) && !empty($_POST["display_size"]))?sanitize($_POST["display_size"]): $pro_edt["display_size"]);
        $cpu_manu = ((isset($_POST["cpu_manu"]) && !empty($_POST["cpu_manu"]))?sanitize($_POST["cpu_manu"]): $pro_edt["cpu_manu"]);
        $battery_type = ((isset($_POST["battery_type"]) && !empty($_POST["battery_type"]))?sanitize($_POST["battery_type"]): $pro_edt["battery_type"]);
        $release_date = ((isset($_POST["release_date"]) && !empty($_POST["release_date"]))?sanitize($_POST["release_date"]): $pro_edt["release_date"]);
        $touchscreen_type = ((isset($_POST["touchscreen_type"]) && !empty($_POST["touchscreen_type"]))?sanitize($_POST["touchscreen_type"]): $pro_edt["touchscreen_type"]);
        $rear_camera = ((isset($_POST["rear_camera"]) && !empty($_POST["rear_camera"]))?sanitize($_POST["rear_camera"]): $pro_edt["rear_camera"]);
        $item_cond = ((isset($_POST["item_cond"]) && !empty($_POST["item_cond"]))?sanitize($_POST["item_cond"]): $pro_edt["item_cond"]);
        $camera_type = ((isset($_POST["camera_type"]) && !empty($_POST["camera_type"]))?sanitize($_POST["camera_type"]): $pro_edt["camera_type"]);
        $talk_time = ((isset($_POST["talk_time"]) && !empty($_POST["talk_time"]))?sanitize($_POST["talk_time"]): $pro_edt["talk_time"]);
        $display_color = ((isset($_POST["display_color"]) && !empty($_POST["display_color"]))?sanitize($_POST["display_color"]): $pro_edt["display_color"]);
        $cellular = ((isset($_POST["cellular"]) && !empty($_POST["cellular"]))?sanitize($_POST["cellular"]): $pro_edt["cellular"]);
        $battery_capacity = ((isset($_POST["battery_capacity"]) && !empty($_POST["battery_capacity"]))?sanitize($_POST["battery_capacity"]): $pro_edt["battery_capacity"]);
        $front_camera = ((isset($_POST["front_camera"]) && !empty($_POST["front_camera"]))?sanitize($_POST["front_camera"]): $pro_edt["front_camera"]);
        $cpu = ((isset($_POST["cpu"]) && !empty($_POST["cpu"]))?sanitize($_POST["cpu"]): $pro_edt["cpu"]);
        $rec_def = ((isset($_POST["rec_def"]) && !empty($_POST["rec_def"]))?sanitize($_POST["rec_def"]): $pro_edt["rec_def"]);
        $simcard_qty = ((isset($_POST["simcard_qty"]) && !empty($_POST["simcard_qty"]))?sanitize($_POST["simcard_qty"]): $pro_edt["simcard_qty"]);
        $rom = ((isset($_POST["rom"]) && !empty($_POST["rom"]))?sanitize($_POST["rom"]): $pro_edt["rom"]);
        $model = ((isset($_POST["model"]) && !empty($_POST["model"]))?sanitize($_POST["model"]): $pro_edt["model"]);
        $wlan = ((isset($_POST["wlan"]) && !empty($_POST["wlan"]))?sanitize($_POST["wlan"]): $pro_edt["wlan"]);
        $bluetooth = ((isset($_POST["bluetooth"]) && !empty($_POST["bluetooth"]))?sanitize($_POST["bluetooth"]): $pro_edt["bluetooth"]);
        $gps = ((isset($_POST["gps"]) && !empty($_POST["gps"]))?sanitize($_POST["gps"]): $pro_edt["gps"]);


        $parentRes = $con->query("select * from categories where c_id = '$my_cat'");
        $parent_out = $parentRes->fetch_assoc();
        $p_cat = ((isset($_POST["category"]) && !empty($_POST["category"]))?sanitize($_POST["category"]): $parent_out["parent"]);

        $saved_photo = (($pro_edt["image"] != "")?$pro_edt["image"]:"");
        $dbpath = $saved_photo;


   }
    if ($_POST) {

        //$dbpath = '';
        $errors = array();
        $required = array("title","price","desc","brand","category","child","color","p_qty","memory","keywords");
        foreach ($required as $field) {
            if ($_POST[$field] == "") {
                $errors[] = "All Fields with an asterisk are required";
                break;
            }
        }


        //handles file upload
        if (!empty($_FILES)) {
            $photo = $_FILES["photo"];
            $name = $photo["name"];
            $nameArr = explode(".", $name);
            $fileName = $nameArr[0];
            @$fileExt = $nameArr[1];

            //MIME Type
            $mime = explode("/", $photo["type"]);
            $mimeType = $mime[0];
            @$mimeExt = $mime[1];

            $tmpLoc = $photo["tmp_name"];
            $fileSize = $photo["size"];
            $allowed = array("jpg","jpeg","png","jpe","gif","JPG","PNG","JPEG","Jpeg");


           $uploadName = md5(microtime()). ".".$fileExt;
           $uploadLoc = BASEURL."assets/images/shop/products/".$uploadName;
            $dbpath = $uploadName;
            //validations
            if ($mimeType != "image") {
                $errors[] = "File Must be an Image";
            }
            if (!in_array($fileExt, $allowed)) {
                $errors[] = "The file extension is not allowed please upload jpg, jpeg, png, jpe and gif only";
            }
            if ($fileSize > 15000000) {
                $errors[] = "The file size should be less than 15MB";
            }
            if ($fileExt != $mimeExt && ($mimeExt == "jpeg" && $fileExt != "jpg")) {
                $errors[] = "File extension does not match the file";
            }
        }else{
            $tmpLoc = $saved_photo;
        }
        if (!empty($errors)) {
            echo display_errors($errors);
        }else{
            //upload file and insert
            if (!empty($_FILES)) {
                move_uploaded_file($tmpLoc, $uploadLoc);
            }

            $insertSQL = "INSERT INTO `products`( `title`, `price`, `list_price`, `b_id`, `c_id`, `image`, `description`, `quantity`,
 `keywords`, `sizes`, `color`, `memory`, `conditions`, `status`, `availability`,  `tags`,
 `features`, `screen_size`, `screen_res`, `max_scr_res`, `processor`, `ram`, `memory_speed`, `hard_drive`, `graphics_coprocessor`, `chipset_brand`, `card_desc`, `wireless_type`, `brand_name`, `series`, `os`, `item_weight`, `dimen`, `processor_brand`, `processor_count`, `comp_mem_type`, `hd_rotational_speed`, `batteries`, `hd_interface`, `unlock_phones`, `display_size`, `cpu_manu`, `battery_type`, `release_date`, `touchscreen_type`, `rear_camera`, `item_cond`, `camera_type`, `talk_time`, `display_color`, `cellular`, `battery_capacity`, `front_camera`, `cpu`, `rec_def`, `simcard_qty`, `rom`, `model`, `wlan`, `bluetooth`, `gps`) 
VALUES ('$title','$price','$lp','$p_brand','$my_cat','$dbpath','$desc','$p_qty','$keywords','$sizes','$color','$memory',
'$cond','$status','$avail','$tags','$features','$screen_size','$screen_res','$max_scr_res','$processor','$ram','$memory_speed','$hard_drive','$graphics_coprocessor','$chipset_brand','$card_desc','$wireless_type','$brand_name','$series','$os','$item_weight','$dimen','$processor_brand','$processor_count','$comp_mem_type','$hd_rotational_speed','$batteries','$hd_interface','$unlock_phones','$display_size','$cpu_manu','$battery_type','$release_date','$touchscreen_type','$rear_camera','$item_cond','$camera_type','$talk_time','$display_color','$cellular','$battery_capacity','$front_camera','$cpu','$rec_def','$simcard_qty','$rom','$model','$wlan','$bluetooth','$gps')";

            if (isset($_GET["edit"])) {

                $insertSQL = "
               UPDATE `products` SET 
               `title`= '$title',
               `price`='$price',
               `list_price`='$lp',
               `b_id`='$p_brand',
               `c_id`='$my_cat',
               `image`='$dbpath',
               `description`='$desc',
               `quantity`='$p_qty',
               `keywords`='$keywords',
               `sizes`='$sizes',
               `color`='$color',
               `memory`='$memory',
               `conditions`='$cond',
               `status`='$status',
               `availability`='$avail',
              `tags`='$tags',
               `features`='$features',
               `screen_size`='$screen_size',
               `screen_res`='$screen_res',
               `max_scr_res`='$max_scr_res',
               `processor`='$processor',
               `ram`='$ram',
               `memory_speed`='$memory_speed',
               `hard_drive`='$hard_drive',
               `graphics_coprocessor`='$graphics_coprocessor',
               `chipset_brand`='$chipset_brand',
               `card_desc`='$card_desc',
               `wireless_type`='$wireless_type',
               `brand_name`='$brand_name',
               `series`='$series',
               `os`='$os',
               `item_weight`='$item_weight',
               `dimen`='$dimen',
               `processor_brand`='$processor_brand',
               `processor_count`='$processor_count',
               `comp_mem_type`='$comp_mem_type',
               `hd_rotational_speed`='$hd_rotational_speed',
               `batteries`='$batteries',
               `hd_interface`='$hd_interface',
               `unlock_phones`='$unlock_phones',
               `display_size`='$display_size',
               `cpu_manu`='$cpu_manu',
               `battery_type`='$battery_type',
               `release_date`='$release_date',
               `touchscreen_type`='$touchscreen_type',
               `rear_camera`='$rear_camera',
               `item_cond`='$item_cond',
               `camera_type`='$camera_type',
               `talk_time`='$talk_time',
               `display_color`='$display_color',
               `cellular`='$cellular',
               `battery_capacity`='$battery_capacity',
               `front_camera`='$front_camera',
               `cpu`='$cpu',
               `rec_def`='$rec_def',
               `simcard_qty`='$simcard_qty',
               `rom`='$rom',
               `model`='$model',
               `wlan`='$wlan',
               `bluetooth`='$bluetooth',
               `gps`='$gps'
                
                where p_id = '$edit_id'
                ";
            }

            $con->query($insertSQL);
            header("location: products.php");
        }
    }
?>
    <form action="products.php?<?=((isset($_GET["edit"]))?"edit=".$edit_id:"add=1")?>" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input class="form-control" value="<?= $title;?>" type="text" id="title" name="title">
                </div>
                <div class="form-group col-md-2">
                    <label for="price">Price <span class="text-danger">*</span> (numbers only eg. 2300)</label>
                    <input class="form-control" value="<?= $price;?>" type="text" id="price" name="price">
                </div>
                <div class="form-group col-md-2">
                    <label for="lp">List Price (numbers only eg. 4600)</label>
                    <input class="form-control" value="<?= $lp;?>" type="text" id="lp" name="list_price">
                </div>
                <div class="form-group col-md-3">
                    <label for="des">Description (short info of the product) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"  name="desc" id="des" value="<?= $desc?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="bd">Brands <span class="text-danger">*</span></label>
                    <select class="form-control" id="bd" name="brand">
                        <option value="" <?= (($p_brand == '')?'selected':'')?>></option>
                        <?php while ($brand = $brandQry->fetch_assoc()): ?>
                        <option value="<?= $brand["b_id"]; ?>" <?= (($p_brand == $brand["b_id"])?'selected':'')?>><?= $brand["name"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="ct">Parent Category <span class="text-danger">*</span></label>
                    <select class="form-control" id="ct" name="category">
                        <option value="" <?= (($p_cat == '')?'selected':'')?>></option>
                        <?php while ($cat = $parentQry->fetch_assoc()): ?>
                            <option value="<?= $cat["c_id"]; ?>" <?= (($p_cat == $cat["c_id"])?'selected':'')?>><?= $cat["name"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="cc">Child Category <span class="text-danger">*</span></label>
                    <select class="form-control" id="cc" name="child">
                    </select>

                </div>
                <div class="form-group col-md-3">
                    <label for="sz">Sizes</label>
                    <input type="text" value="<?= $sizes;?>" class="form-control" id="sz" name="sizes">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="cr">Color <span class="text-danger">*</span> (enter available colors separated by comas eg. white,black) </label>
                    <input type="text" value="<?= $color;?>" class="form-control" id="cr" name="color">
                </div>
                <div class="form-group col-md-3">
                    <label for="mm">Memory <span class="text-danger">*</span> (enter available memory separated by comas eg. 64GB,128GB) </label>
                    <input type="text" value="<?= $memory;?>" class="form-control" id="mm" name="memory">
                </div>
                <div class="form-group col-md-3">
                    <label for="cn">Conditions</label>
                    <select class="form-control" id="cn" name="conditions">
                        <option <?= (($cond == '')?'selected':'')?>></option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                        <option value="Refurbished">Refurbished</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="st">Status</label>
                    <input type="text" value="<?= $status;?>" class="form-control" id="st" name="status">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="tg">Tags</label>
                    <select class="form-control" id="tg" name="tags">
                        <option value="0" <?= (($tags == '')?'selected':'')?>>None</option>
                        <option value="Best Sellers">Best Sellers</option>
                        <option value="New Arrivals">New Arrivals</option>
                        <option value="Slightly Used">Slightly Used</option>
                        <option value="Featured">Featured</option>
                        <option value="Slider">Slider</option>
                    </select>
                </div>
               
                <div class="form-group col-md-2">
                    <label for="av">Availability</label>
                    <select class="form-control" id="av" name="avail">
                        <option <?= (($avail == '')?'selected':'')?>></option>
                        <option value="Available">Available</option>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="pqty">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="p_qty" value="<?= $p_qty;?>" min="1"  class="form-control" id="pqty">
                </div>
                <div class="form-group col-md-6">
                    <label for="ky">Keywords (Search Purposes: eg. samsung, smartphone, android, s9)</label>
                    <input type="text" class="form-control" value="<?= $keywords;?>"  name="keywords" id="ky">
                </div>
            </div>
            <div class="row">

                
                <div class="form-group col-md-8">
                    <label for="ft">Extended Features (Full features of the product)</label>
                    <textarea class="form-control" rows="5"  name="features" id="ft"><?= $features;?></textarea>
                </div>

                <div class="form-group col-md-4">
                    <?php if ($saved_photo != ""): ?>
                        <div class="product-thumb">
                            <img src="../assets/images/shop/products/<?= $saved_photo ?>" alt="image"><br>
                            <a href="products.php?delete_img=1&edit=<?= $edit_id ?>">Delete Image</a> &nbsp;
                            <a href="multi_uploader.php?upload=<?= $edit_id ?>">Upload Secondary Images</a>
                        </div>
                    <?php else: ?>
                    <label for="cr">Upload Product Images</label>
                    
                    <input type="file" name="photo" class="form-control" id="cr">
                    <?php endif; ?>
                </div>
            </div>

           
            <div class="form-group float-right">
                <a href="products.php" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="<?=((isset($_GET["edit"]))? "Edit Product":"Add Product")?>" class="btn btn-success">
            </div>
            <div class="clearfix"></div>
            <div class="row padding-bottom-2x">
            <h3>What kind of Product are you uploading</h3>
            	<select class="form-control" name="trumu" id="trumu">
    <option>what are you choosing</option>
    <option value="2">Laptop</option>
    <option value="3">Phone</option>
</select>
            </div>
        </div>
        <div class="container cont-wrap hide">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="screen_size">Screen Size</label>
                    <input type="text" class="form-control" id="screen_size" name="screen_size" value="<?= $screen_size; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="screen_res">Screen Resolution</label>
                    <input type="text" class="form-control" id="screen_res" name="screen_res" value="<?= $screen_res; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="max_scr_res">Max Screen Resolution</label>
                    <input type="text" class="form-control" id="max_scr_res" name="max_scr_res" value="<?= $max_scr_res; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="processor">Processor</label>
                    <input type="text" class="form-control" id="processor" name="processor" value="<?= $processor; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="ram">Ram</label>
                    <input type="text" class="form-control" id="ram" name="ram" value="<?= $ram; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="memory_speed">Memory Speed</label>
                    <input type="text" class="form-control" id="memory_speed" name="memory_speed" value="<?= $memory_speed ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="hard_drive">Hard Drive</label>
                    <input type="text" class="form-control" id="hard_drive" name="hard_drive" value="<?= $hard_drive; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="graphics_coprocessor">Graphics_Coprocessor</label>
                    <input type="text" class="form-control" id="graphics_coprocessor" name="graphics_coprocessor" value="<?= $graphics_coprocessor; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="chipset_brand">Chipset Brand</label>
                    <input type="text" class="form-control" id="chipset_brand" name="chipset_brand" value="<?= $chipset_brand; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="card_desc">Card Description</label>
                    <input type="text" class="form-control" id="card_desc" name="card_desc" value="<?= $card_desc; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="wireless_type">Wireless Type</label>
                    <input type="text" class="form-control" id="wireless_type" name="wireless_type" value="<?= $wireless_type; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="brand_name">Brand Name</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?= $brand_name; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="series">Series</label>
                    <input type="text" class="form-control" id="series" name="series" value="<?= $series; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="os">Operating System</label>
                    <input type="text" class="form-control" id="os" name="os" value="<?= $os; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="item_weight">Item Weight</label>
                    <input type="text" class="form-control" id="item_weight" name="item_weight" value="<?= $item_weight; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="dimen">Dimension</label>
                    <input type="text" class="form-control" id="dimen" name="dimen" value="<?= $dimen; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="processor_brand">Processor Brand</label>
                    <input type="text" class="form-control" id="processor_brand" name="processor_brand" value="<?= $processor_brand; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="processor_count">Processor Count</label>
                    <input type="text" class="form-control" id="processor_count" name="processor_count" value="<?= $processor_count; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="comp_mem_type">Computer Memory Type</label>
                    <input type="text" class="form-control" id="comp_mem_type" name="comp_mem_type" value="<?= $comp_mem_type; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="hd_rotational_speed">HD Rotational Speed</label>
                    <input type="text" class="form-control" id="hd_rotational_speed" name="hd_rotational_speed" value="<?= $hd_rotational_speed; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="batteries">Batteries</label>
                    <input type="text" class="form-control" id="batteries" name="batteries" value="<?= $batteries; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="hd_interface">HD Interface</label>
                    <input type="text" class="form-control" id="hd_interface" name="hd_interface" value="<?= $hd_interface; ?>">
                </div>

            </div>
            </div>
             <div class="container cont-wraps hide">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="unlock_phones">Unlock Phones</label>
                    <input type="text" class="form-control" id="unlock_phones" name="unlock_phones" value="<?= $unlock_phones; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="display_size">Display Size</label>
                    <input type="text" class="form-control" id="display_size" name="display_size" value="<?= $display_size; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="cpu_manu">CPU Manufacturer</label>
                    <input type="text" class="form-control" id="cpu_manu" name="cpu_manu" value="<?= $cpu_manu; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="battery_type">Battery Type</label>
                    <input type="text" class="form-control" id="battery_type" name="battery_type" value="<?= $battery_type; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="release_date">Release Date</label>
                    <input type="text" class="form-control" id="release_date" name="release_date" value="<?= $release_date; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="touchscreen_type">Touchscreen Type</label>
                    <input type="text" class="form-control" id="touchscreen_type" name="touchscreen_type" value="<?= $touchscreen_type; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="rear_camera">Rear Camera</label>
                    <input type="text" class="form-control" id="rear_camera" name="rear_camera" value="<?= $rear_camera; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="item_cond">Item Condition</label>
                    <input type="text" class="form-control" id="item_cond" name="item_cond" value="<?= $item_cond; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="camera_type">Camera Type</label>
                    <input type="text" class="form-control" id="camera_type" name="camera_type" value="<?= $camera_type; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="talk_time">Talk Time</label>
                    <input type="text" class="form-control" id="talk_time" name="talk_time" value="<?= $talk_time; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="display_color">Display Color</label>
                    <input type="text" class="form-control" id="display_color" name="display_color" value="<?= $display_color; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="cellular">Cellular</label>
                    <input type="text" class="form-control" id="cellular" name="cellular" value="<?= $cellular; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="battery_capacity">Battery Capacity</label>
                    <input type="text" class="form-control" id="battery_capacity" name="battery_capacity" value="<?= $battery_capacity; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="front_camera">Front Camera</label>
                    <input type="text" class="form-control" id="front_camera" name="front_camera" value="<?= $front_camera ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="cpu">CPU</label>
                    <input type="text" class="form-control" id="cpu" name="cpu" value="<?= $cpu ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="rec_def">Recording Definition</label>
                    <input type="text" class="form-control" id="rec_def" name="rec_def" value="<?= $rec_def; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="simcard_qty">Simcard Quantity</label>
                    <input type="text" class="form-control" id="simcard_qty" name="simcard_qty" value="<?= $simcard_qty; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="rom">Rom</label>
                    <input type="text" class="form-control" id="rom" name="rom" value="<?= $rom; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?= $model; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="wlan">WLAN</label>
                    <input type="text" class="form-control" id="wlan" name="wlan" value="<?= $wlan; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="bluetooth">Bluetooth</label>
                    <input type="text" class="form-control" id="bluetooth" name="bluetooth" value="<?= $bluetooth; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="gps">GPS</label>
                    <input type="text" class="form-control" id="gps" name="gps" value="<?= $gps; ?>">
                </div>

            </div>
            </div>

    </form>
<?php }else{

$sql = "select * from products where deleted = 0";
$pRes = $con->query($sql);
if (isset($_GET["tag"])) {
    $id = (int)$_GET["id"];
    $featured = (string)$_GET["tag"];
    $ftSql = "update products set tags = '$featured' where p_id = '$id'";
    $con->query($ftSql);
    header("location: products.php");
}
   
    
?>
<a href="products.php?add=1" class="btn btn-outline-success float-right" id="add-product">Add Products</a>
<div class="clearfix"></div>
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
            <a href="products.php?edit=<?= $products["p_id"] ?>" class="btn btn-sm btn-outline-primary"><span class="icon-edit"></span></a>
            <a href="products.php?delete=<?= $products["p_id"] ?>" class="btn btn-sm btn-outline-danger"><span class="icon-delete"></span></a>
        </td>
        <td class="text-center"><?= $products["p_id"]?></td><td><?= substr($products["title"], 0, 50) ?>...</td><td class="text-center"><?= money($products["price"])?></td>
        <td class="text-center"><?= (($products["list_price"] != null)? money($products["list_price"]):$products["list_price"]) ?></td><td class="text-center"><?= $products["b_id"]?></td>
        <td class="text-center"><?= $category?></td>
        <td class="text-center"> <img src="../assets/images/shop/products/<?= $products["image"]?>" width="100" height="30" alt="<?= $products["image"]?>"></td>
        <td class="text-center"><?= substr($products["description"], 0, 50)?>...</td><td class="text-center"><?= $products["quantity"]?></td><td class="text-center"><?= substr($products["keywords"], 0,50) ?></td><td class="text-center"><?= $products["sizes"]?></td><td class="text-center"><?= $products["color"]?></td>
        <td class="text-center"><?= $products["memory"]?></td><td class="text-center"><?= $products["conditions"]?></td><td class="text-center"><?= $products["status"]?></td><td class="text-center"><?= $products["availability"]?></td>
        <td class="text-center"><?= $products["rating"]?></td>
        <td class="text-center">
            <a href="products.php?tag=<?= (($products["tags"] == '0')?'Featured':'0');?>&id=<?= $products["p_id"];?>" class="btn btn-sm btn-secondary ">
                <span class="icon-<?= (($products["tags"] == "Featured")?'minus':'plus') ?>"></span>
            </a>
            &nbsp; <?= (($products["tags"] == "Featured")?'Featured Products':'Not Featured') ?>
        </td>
    
    
        <td class="text-center"><?= $products["deleted"]?></td>
        <td class="text-center"><?= substr($products["features"], 0, 50)?>...</td>
    </tr>
    <?php endwhile;?>
    </tbody>
</table>

<?php } include_once "includes/footer.php" ?>
<script src="../assets/plugins/tinymce/tinymce.js"></script>
<script>tinymce.init({
        selector:'textarea',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link | numlist bullist'
    });</script>
<script>
    $(document).ready(function () {
        get_child_options(<?= $my_cat; ?>)
    })
</script>
<script type="text/javascript">

    $(function($){

        var opts_parent = $("select#trumu");
        opts_parent.on("click",function(){
            var self = $(this).val();
            var conts = $('.cont-wrap');
            var cont = $('.cont-wraps');
//            console.log(self);
            if(self == "2"){

                conts.removeClass("hide");
                cont.addClass("hide");
            }
            else if(self=="3"){

                cont.removeClass("hide");
                conts.addClass("hide");
            }
            else{
                cont.addClass("hide");
                conts.addClass("hide");
            }



        })

    })(jQuery)

</script>
</body>
</html>
<?php ob_end_flush(); ?>