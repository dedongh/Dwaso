<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/3/2018
 * Time: 1:29 AM
 */

require_once "../db.php";
if (isset($_GET["upload"])) {
    $id = sanitize((int)$_GET["upload"]);

}

$dbpath = "";
$errors = array();
if (isset($_POST["upload"])) {
    $allowed = array("png","jpg","jpeg","gif");
    $tmpLoc = array();
    $uploadLoc = array();
    $photoCount = count($_FILES["photos"]["name"]);
    if ($photoCount > 0) {
        for ($i = 0; $i < $photoCount; $i++) {
            $name = $_FILES["photos"]["name"][$i];
            $nameArray = explode(".", $name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode("/", $_FILES["photos"]["type"][$i]);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];

            $tmpLoc[] = $_FILES["photos"]["tmp_name"][$i];

            $fileSize = $_FILES["photos"]["size"][$i];
            $uploadName = md5(microtime()).".".$fileExt;
            $uploadLoc[] = BASEURL."assets/images/shop/products/".$uploadName;
            if ($i != 0) {
                $dbpath .= ",";
            }
            $dbpath .= $uploadName;

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

        }
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    }else{
        if ($photoCount > 0) {
            for ($i = 0; $i < $photoCount; $i++) {
                move_uploaded_file($tmpLoc[$i], $uploadLoc[$i]);
            }
        }
        $insert = "insert into gallery (image, p_id) values ('$dbpath','$id')";
        $con->query($insert);


    }

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

<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Upload Secondary Images </h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="#">Edit Products</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Upload</li>
            </ul>
        </div>
    </div>
</div>

<form action="multi_uploader.php?upload=<?= $id ?>" method="post" enctype="multipart/form-data">
<div class="form-group col-md-4">
    <input type="file" name="photos[]" class="form-control" multiple>
    <input type="submit" value="Upload Images" name="upload" class="btn btn-success">
</div>
</form>
<div class="product-thumb">
<?php
$query = "select * from gallery where p_id = '$id'";
$stmt = $con->query($query);
$res = $stmt->fetch_assoc();

/*if (isset($_GET["delete"])) {
    $img = (int)$_GET["img"] - 1;
    $images = explode(",", $res["image"]);
}*/


$photos = explode(",", $res["image"]);
$img = 1;
foreach ($photos as $photo):
?>
<img src="../assets/images/shop/products/<?= $photo ?>" alt="image">
<a href="multi_uploader.php?delete=1&edit=<?= $id ?>&img=<?= $img ?>" class="text-danger">Delete Image</a>

<?php
$img++;
endforeach; ?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>