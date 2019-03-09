<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 1/9/2018
 * Time: 9:06 PM
 */

require_once "../db.php";
if (!is_logged_in()) {
    login_error_redirect();
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Brands</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php" ?>

<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Brands</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Brands</li>
            </ul>
        </div>
    </div>
</div>

<?php
$errors = array();

//edit brand
if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
    $edit_id = (int)$_GET["edit"];
    $edit_id = sanitize($edit_id);

    $stmt = "select * from brands where b_id = '$edit_id'";
    $edit_res = $con->query($stmt);
    $eBrand = $edit_res->fetch_assoc();

}
//delete brand
if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
    $del_id = (int)$_GET["delete"];
    $del_id = sanitize($del_id);
    $sql = "delete from brands where  b_id = '$del_id'";
    $con->query($sql);
    header("location: brands.php");
}
if (isset($_POST["submit"])) {
    $brand = sanitize($_POST["brand"]);
    $file = $_FILES['upload'];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileError = $file["error"];

    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg","jpeg","png","jpe");

    if ($_POST["brand"] == "") {
        $errors[] .= "Enter a Brand";
    }

    //check if brand exists
    $sql = "select * from brands where name ='$brand'";
    if (isset($_GET["edit"])) {
        $sql = "select * from brands where name ='$brand' and b_id != '$edit_id'";
    }
    $results = $con->query($sql);
    $count = $results->num_rows;
    if ($count > 0) {
        $errors[] .= $brand. " is already in the database... Please Enter another Brand";
    }
    if (!is_uploaded_file($fileTmpName)) {
        $errors[] .= "Please Upload file...!";
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    }else{
    if (in_array($fileActualExt,$allowed)) {
        if ($fileError === 0) {
            $fileNameNew = uniqid("", true).".".$fileActualExt;
            $fileDestination = "../assets/images/brands/".$fileNameNew;
            $sql2 = "insert into brands (name, image) VALUES ('$brand', '$fileNameNew')";

            $con->query($sql2);
            move_uploaded_file($fileTmpName,$fileDestination);
            header("location: brands.php");
        }else{
            $errors[] .= "There was an error uploading your file!";
        }
    }else{
        $errors[] .= "You cannot upload files of this type!";
    }
    }
    if (isset($_GET["edit"])) {
        $sql = "update brands set name = '$brand' where b_id = '$edit_id'";
    }
    $con->query($sql);
    header("location: brands.php");

}
?>
<hr>
<div class="col-md-4 offset-4 pb-5 text-center">
    <form class="coupon-form" action="brands.php<?=((isset($_GET["edit"]))?'?edit='.$edit_id:'') ?>" method="post" enctype="multipart/form-data">
        <?php
        //set text value in edit page
        $brand_value = "";
        if (isset($_GET["edit"])) {
            $brand_value = $eBrand["name"];
        }else{
            if (isset($_POST["brand"])) {
                $brand_value = sanitize($_POST["brand"]);
            }
        }?>
        <label for="brand"><?= ((isset($_GET["edit"]))?'Edit':'Add a') ?> Brand</label>
        <input class="form-control form-control-sm" type="text" name="brand" value="<?= $brand_value ?>" id="brand">
        <?php if (isset($_GET["edit"])): ?>
        <a class="btn btn-white" href="brands.php">Cancel</a>
        <?php endif; ?>
        <br><br><label for="files">Upload Image</label>
        <input type="file" name="upload" id="files"><br>
        <button class="btn btn-outline-primary btn-sm" type="submit" name="submit"><?= ((isset($_GET["edit"]))?'Update':'Save') ?></button>
    </form>
</div>
<hr>
<?php
$sql = "select * from brands order by name";
$results = $con->query($sql);
?>
<div class="table-responsive shopping-cart col-md-7 offset-3 table-condensed">
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th class="text-center">Brands</th>
            <th class="text-center">Image</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $results->fetch_assoc()):
            ?>
            <tr>
                <td class="text-center"><a href="brands.php?edit=<?= $row["b_id"]?>" class="btn btn-sm btn-outline-primary"><span class="icon-edit"></span></a></td>
                <td class="text-center"><?= $row["name"]; ?></td>
                <td class="text-center product-thumb"><img src="../assets/images/brands/<?= $row["image"] ?>" width="100" height="30" alt="<?= $row["image"] ?>"></td>
                <td class="text-center"><a href="brands.php?delete=<?= $row["b_id"]?>" class="btn btn-sm btn-outline-danger"><span class="icon-delete"></span></a></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include_once "includes/footer.php" ?>
</body>
</html>
<?php ob_end_flush(); ?>