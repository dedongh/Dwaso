<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/6/2018
 * Time: 11:28 PM
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
    <title>Admin Login</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<?php include_once "includes/nav.php";

$hashed = $user_data["password"];
$old_password = ((isset($_POST["old_password"])) ? sanitize($_POST["old_password"]) : "");
$old_password = trim($old_password);
$password = ((isset($_POST["password"])) ? sanitize($_POST["password"]) : "");
$password = trim($password);
$confirm = ((isset($_POST["confirm"])) ? sanitize($_POST["confirm"]) : "");
$confirm = trim($confirm);
$user_id = $user_data["id"];

$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$errors = array();
?>
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Change Password</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Change Password</li>
            </ul>
        </div>
    </div>
</div>
<div class="container padding-top-3x mb-2">
    <div class="row">
        <div class="col-md-6 offset-3">
            <?php
            if ($_POST) {

                if (empty($_POST["old_password"]) || empty($_POST["password"]) || empty($_POST["confirm"])) {
                    $errors[] = "Please fill out all fields";
                }

                //check if new matches old
                if ($password != $confirm) {
                    $errors[] = "The new and old passwords do not match";
                }
                //validate password
                if (strlen($password) < 6) {
                    $errors[] = "Password must be at least 6 characters";
                }

                if (!password_verify($old_password, $hashed)) {
                    $errors[] = "Your old password <b>". $old_password. "</b> does not match our records ";
                }


                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $con->query("update users set Password = '$new_hashed' where id = '$user_id'");
                    $_SESSION["success_msg"] = "Your password has been updated successfully";
                    header("Location: index.php");
                }
            }
            ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 offset-3">
            <form class="card" action="admin_pwd_chg.php" method="post">
                <div class="card-body">

                    <div class="form-group input-group">
                        <input class="form-control" name="old_password" value="<?= $old_password; ?>" id="log_email" type="password" placeholder="Old password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control" name="password" value="<?= $password; ?>" id="log_pwd" type="password" placeholder="New Password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control" name="confirm" value="<?= $confirm; ?>" id="con_pwd" type="password" placeholder="Confirm Password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember_me" checked>
                            <label class="custom-control-label" for="remember_me">Remember me</label>
                        </div><a class="navi-link" href="#">Forgot password?</a>
                    </div>
                    <div class="text-center text-sm-right">
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                        <button class="btn btn-primary margin-bottom-none" type="submit">Update</button>
                    </div>
                </div>
            </form>
            <p class="text-right"><a href="../index.php">Visit Site</a></p>
        </div>
    </div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>