<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 8/21/2018
 * Time: 4:51 AM
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
    <title>Category</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php" ?>

<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Categories</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Categories</li>
            </ul>
        </div>
    </div>
</div>

    <?php $sql = "select * from categories where parent = 0";
    $result = $con->query($sql);

    $errors = array();
    //edit cat
    if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
        $edit = (int)$_GET["edit"];
        $edit = sanitize($edit);

        $stmt = "select * from categories where c_id = '$edit'";
        $edit_results = $con->query($stmt);

        $eCategory = $edit_results->fetch_assoc();
    }
    //delete cat
    if (isset($_GET["delete"]) && !empty($_GET["delete"])) {
        $delete_id = (int)$_GET["delete"];
        $delete_id = sanitize($delete_id);
        //delete everything when a parent is deleted
        $psql = "select * from categories where c_id = '$delete_id'";
        $pRes = $con->query($psql);
        $cat = $pRes->fetch_assoc();
        if ($cat["parent"] == 0) {
            $dsql = "delete from categories where parent = '$delete_id'";
           $con->query($dsql);
        }

        $nsql = "delete from categories where c_id = '$delete_id'";
        $con->query($nsql);

        header("location: categories.php");
    }
    //process form
    if (isset($_POST) && !empty($_POST)) {
        $parent = sanitize($_POST["parent"]);
        $category = sanitize($_POST["category"]);

        $sql2 = "select * from categories where name ='$category' and  parent = '$parent'";
        if (isset($_POST["edit"])) {
            $id = $eCategory["c_id"];
            $sql2 = "select * from categories where name = '$category' and parent = '$parent' and c_id != '$id'";
        }
        $fbk = $con->query($sql2);
        $count = $fbk->num_rows;
        //if category is blank
        if ($category == "") {
            $errors[] .= "The category cannot be blank";
        }
        //check if category exists
        if ($count > 0) {
            $errors[] .= $category. " is already in the database... Please Enter another Brand";
        }
        if (!empty($errors)) {
            echo display_errors($errors);

       } else {
            $insert = "insert into categories(name, parent, image) VALUES ('$category','$parent', null )";
            if (isset($_GET["edit"])) {
                $insert = "update categories set name = '$category', parent = '$parent' where c_id = '$edit'";
            }
            $ins = $con->query($insert);
            header("location: categories.php");
        }
    }

    $category_value = "";
    $parent_value = 0;

    if (isset($_GET["edit"])) {
        $category_value = $eCategory["name"];
        $parent_value = $eCategory["parent"];
    }else{
        if (isset($_POST["category"])) {
            $category_value = sanitize($_POST["category"]);
            $parent_value = sanitize($_POST["parent"]);
        }
    }
    ?>
<div class="row">
    <!--Category form-->
    <div class="col-md-6">
        <form class="card" action="categories.php<?=((isset($_GET["edit"]))?'?edit='.$edit:'') ?>" method="post">
            <div id="errors"></div>
            <h4 class="text-center"><?= ((isset($_GET["edit"]))?'Edit Category':'Add a Category') ?></h4>
            <div class="card-body">
                <div class="form-group">
                    <label for="size">Parent</label>
                    <select class="form-control" name="parent" id="size">
                        <option value="0" <?= (($parent_value == 0)? 'selected="selected"':'') ?>>Parent</option>
                        <?php while ($row = $result->fetch_assoc()):?>
                            <option value="<?= $row["c_id"]?>" <?= (($parent_value == $row["c_id"])? 'selected="selected"':'') ?>><?= $row["name"]?></option>
                        <?php endwhile;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ctgry">Category</label>
                    <input class="form-control" value="<?= $category_value ?>" type="text" id="ctgry" name="category">
                </div>
                <div class="form-group">
                    <label for="file">Upload Image<br> for Parent Categories only</label>
                    <input type="file" name="upload" id="file">
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-primary" name="send" type="submit"><?=((isset($_GET["edit"]))? 'Edit Category':'Add Category')?></button>
                </div>
            </div>

        </form>
    </div>
    <!--Category Table-->
    <div class="col-md-6">
        <table class="table table-responsive table-condensed">
            <thead>
            <tr>
                <th class="text-center">Category</th>
                <th class="text-center">Parent</th>
                <th class="text-center">Image</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php
            $sql = "select * from categories where parent = 0";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()):
                $parent_id = (int)$row["c_id"];
                $sql2 = "select * from categories where parent = '$parent_id'";
                $res = $con->query($sql2);
                ?>
            <tr class="bg-secondary">
                <td class="text-center align-middle"><?= $row["name"] ?></td>
                <td class="text-center align-middle">Parent</td>
                <td class="text-center align-middle">
                    <img src="../assets/images/shop/header-categories/<?=$row["image"];?>" width="100" height="30" alt="<?= $row["name"];?>">
                </td>
                <td class="text-center">
                    <a href="categories.php?edit=<?= $row["c_id"] ?>" class="btn btn-sm btn-outline-primary"><span class="icon-edit"></span></a>
                    <a href="categories.php?delete=<?= $row["c_id"] ?>" class="btn btn-sm btn-outline-danger"><span class="icon-delete"></span></a>
                </td>
            </tr>
            <?php while ($child = $res->fetch_assoc()): ?>
                <tr class="">
                    <td class="text-center align-middle"><?= $child["name"] ?></td>
                    <td class="text-center align-middle"><?= $row["name"] ?></td>
                    <td class="text-center align-middle">
                        <img src="../assets/images/shop/header-categories/<?= $child["image"] ?>" width="100" height="30">
                    </td>
                    <td class="text-center">
                        <a href="categories.php?edit=<?= $child["c_id"] ?>" class="btn btn-sm btn-outline-primary"><span class="icon-edit"></span></a>
                        <a href="categories.php?delete=<?= $child["c_id"] ?>" class="btn btn-sm btn-outline-danger"><span class="icon-delete"></span></a>
                    </td>
                </tr>
            <?php endwhile; ?>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "includes/footer.php" ?>
</body>
</html>
<?php ob_end_flush(); ?>