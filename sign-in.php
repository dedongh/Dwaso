<?php
include_once "db.php";
require_once "send-mail.php";
if (is_cust_logged_in()) {
    header("location: index.php");
}
ob_start();
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
    <title>GiloShop | Login/Register</title>
    <!-- Mobile Specific Meta Tag-->
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>


<!--Page Content-->
<div class="container padding-bottom-3x mb-2 padding-top-3x">

    <div class="row">
        <div class="col-md-6">
            <?php
            $email = ((isset($_POST["cust_email"])) ? sanitize($_POST["cust_email"]) : "");
            $email = trim($email);
            $password = ((isset($_POST["cust_password"])) ? sanitize($_POST["cust_password"]) : "");
            $password = trim($password);
            $errors = array();
            if (isset($_POST["login"])) {
                if (empty($_POST["cust_email"]) || empty($_POST["cust_password"])) {
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
                $clgQry = $con->query("select * from user_info where email = '$email'");
                $cust = $clgQry->fetch_assoc();
                $cCount = $clgQry->num_rows;
                if ($cCount < 1) {
                    $errors[] = "Email not found";
                }
                if (!password_verify($password, $cust["password"])) {
                    $errors[] = "The password is incorrect " ;
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else {
                    $userid = $cust["uid"];
                    cust_login($userid);
                }
            }
            ?>
            <form class="card" action="sign-in.php" method="post">
                <div class="card-body">
                    <div class="row margin-bottom-1x">
                        <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block facebook-btn" href="#"><i class="socicon-facebook"></i>&nbsp;Facebook login</a></div>
                        <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block twitter-btn" href="#"><i class="socicon-twitter"></i>&nbsp;Twitter login</a></div>
                    </div>
                    <h4 class="margin-bottom-1x">Or using the form below</h4>
                    <div class="form-group input-group">
                        <input class="form-control" id="log_email" value="<?= $email ?>" name="cust_email" type="email" placeholder="Email" required>
                        <span class="input-group-addon"><i class="icon-mail"></i></span>
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control" id="log_pwd" name="cust_password" value="<?= $password; ?>" type="password" placeholder="Password" required>
                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember_me" checked>
                            <label class="custom-control-label" for="remember_me">Remember me</label>
                        </div><a class="navi-link" href="password-recovery">Forgot password?</a>
                    </div>
                    <div class="text-center text-sm-right">
                        <button class="btn btn-primary margin-bottom-none" name="login" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <?php
            $reg_fn = ((isset($_POST["reg_fn"])) ? sanitize($_POST["reg_fn"]) : "");
            $reg_ln = ((isset($_POST["reg_ln"])) ? sanitize($_POST["reg_ln"]) : "");
            $reg_email = ((isset($_POST["reg_email"])) ? sanitize($_POST["reg_email"]) : "");
            $reg_phone = ((isset($_POST["reg_phone"])) ? sanitize($_POST["reg_phone"]) : "");
            $reg_pwd = ((isset($_POST["reg_pwd"])) ? sanitize($_POST["reg_pwd"]) : "");
            $reg_confirm = ((isset($_POST["reg_confirm"])) ? sanitize($_POST["reg_confirm"]) : "");
            $name = "/^[a-zA-Z ]+$/";
            $number = "/^[0-9]+$/";
            $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
            if (isset($_POST["register"])) {
                $regQry = $con->query("select * from user_info where email = '$reg_email'");
                $regCount = $regQry->num_rows;

                if ($regCount != 0) {
                    $errors[] = "Email Already Exists in the database";
                }
                if (strlen($reg_pwd) < 6) {
                    $errors[] = "Password must be at least 6 characters";
                }
                if (strlen($reg_phone) < 10) {
                    $errors[] = "Phone number should be 10 digits";
                }
                if ($reg_pwd != $reg_confirm) {
                    $errors[] = "Your passwords do not match";
                }
                if (!preg_match($name, $reg_fn)) {
                    $errors[] = "Please enter a valid  first name";
                }
                if (!preg_match($name, $reg_ln)) {
                    $errors[] = "Please enter a valid  last name";
                }
                if (!preg_match($number, $reg_phone)) {
                    $errors[] = "Please Enter a valid Phone Number";
                }
                if (!preg_match($emailValidation, $reg_email)) {
                    $errors[] = "Please Enter a valid Email";
                }
                if (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "You must enter a valid email";
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                }else{
                    $pwdHashed = password_hash($reg_pwd, PASSWORD_DEFAULT);
                    $hashed = $con->escape_string(md5(rand(0, 1000)));
                    $full_name = $reg_fn." ".$reg_ln;
                    $sql = "insert into user_info (first_name, last_name, email, phone, password, hash) VALUES ('$reg_fn','$reg_ln','$reg_email','$reg_phone','$pwdHashed','$hashed')";
                    if ($con->query($sql)) {
                        $_SESSION["active"] = 0;
                       
                        $_SESSION["uid"] = $con->insert_id;

                        $to = $reg_email;
                        $subject = "Account Verification (giloshop.com)";
                        $message = "Hello ". $full_name. " Thank You for signing up
                        Please click on this link to activate your account http://giloshop.com/verify.php?email="
                        .$reg_email. "&hash=".$hashed;

                        sendMailToUser($to, $full_name, $subject, $message );
                         $_SESSION["success_msg"] = "<div class='alert alert-primary alert-dismissible fade show text-center margin-bottom-1x'>
<span class=\"alert-close\" data-dismiss=\"alert\"></span><i class=\"icon-bell\"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Please:</span>A confirmation link has been sent to your account...!
                        Click on this <a href='http://gmail.com'>$reg_email</a> to activate your account
</div>";
                        header("location: index.php");
                    }
                }
            }
            ?>
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">No Account? Register</h3>
            <p>Registration takes less than a minute but gives you full control over your orders.</p>
            <form class="row" method="post">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-fn">First Name</label>
                        <input class="form-control" value="<?= $reg_fn ?>" name="reg_fn" type="text" id="reg-fn" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-ln">Last Name</label>
                        <input class="form-control" value="<?= $reg_ln ?>" name="reg_ln" type="text" id="reg-ln" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-email">E-mail Address</label>
                        <input class="form-control" value="<?= $reg_email ?>" name="reg_email" type="email" id="reg-email" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-phone">Phone Number</label>
                        <input class="form-control" value="<?= $reg_phone ?>" name="reg_phone" type="tel" max="10" min="10" id="reg-phone" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-pass">Password</label>
                        <input class="form-control" value="<?= $reg_pwd ?>" type="password" name="reg_pwd" id="reg-pass" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reg-pass-confirm">Confirm Password</label>
                        <input class="form-control" value="<?= $reg_confirm ?>" type="password" name="reg_confirm" id="reg-pass-confirm" required>
                    </div>
                </div>
                <div class="col-12 text-center text-sm-right">
                    <button class="btn btn-primary margin-bottom-none" name="register" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--footer-->
<?php include_once "includes/footer.php";
ob_end_flush();
?>

</body>
</html>