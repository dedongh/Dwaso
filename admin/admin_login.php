<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/6/2018
 * Time: 11:28 PM
 */
require_once "../db.php";
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

$email = ((isset($_POST["email"])) ? sanitize($_POST["email"]) : "");
$email = trim($email);
$password = ((isset($_POST["password"])) ? sanitize($_POST["password"]) : "");
$password = trim($password);
$errors = array();
?>
<div class="container padding-top-3x mb-2">
    <div class="row">
        <div class="col-md-6 offset-3">
<?php
            if ($_POST) {

                if (empty($_POST["email"]) || empty($_POST["password"])) {
                    $errors[] = "Please Enter Email and Password";
                }
                //email validation
                if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "enter a valid email";
                }
                //validate password
                if (strlen($password) < 6) {
                    $errors[] = "Password must be at least 6 characters";
                }
                //check if email exists
                $extQuery = $con->query("select * from users where email = '$email'");
                $user = $extQuery->fetch_assoc();
                $uCount = $extQuery->num_rows;

                if ($uCount < 1) {
                    $errors[] = "Email doesn't exist in our database";
                }
                if (!password_verify($password, $user["password"])) {
                    $errors[] = "The password is incorrect ".$user["password"] ;
                }


                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $userid = $user["id"];
                    login($userid);
                }
            }
            ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 offset-3">
            <form class="card" action="admin_login.php" method="post">
                <div class="card-body">

                    <div class="form-group input-group">
                        <input class="form-control" name="email" value="<?= $email; ?>" id="log_email" type="email" placeholder="Email" required><span class="input-group-addon"><i class="icon-mail"></i></span>
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control" name="password" value="<?= $password; ?>" id="log_pwd" type="password" placeholder="Password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember_me" checked>
                            <label class="custom-control-label" for="remember_me">Remember me</label>
                        </div><a class="navi-link" href="#">Forgot password?</a>
                    </div>
                    <div class="text-center text-sm-right">
                        <button class="btn btn-primary margin-bottom-none" type="submit">Login</button>
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