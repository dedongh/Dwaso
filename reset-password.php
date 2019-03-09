<?php
include_once "db.php";

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
    <title>GiloShop | Reset Password</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->

<!--Header-->

<?php
  include_once "includes/nav.php";
?>
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Password Reset</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="home">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li><a href="#">Account</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Password Reset</li>
            </ul>
        </div>
    </div>
</div>
<!--Page Content-->
<?php
if (isset($_GET["email"]) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
    $email = sanitize($_GET["email"]);
    $hash = sanitize($_GET["hash"]);

    //check if user with that email exists
    $result = $con->query("select * from user_info where email = '$email' and hash = '$hash'");
    if ($result->num_rows == 0) {
        echo "You have entered invalid URL for password reset";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (strlen($_POST["reset_pwd"]) < 6) {
            echo "Passwords should be more than 6 characters";
            die();
        }
        if ($_POST["reset_pwd"] == $_POST["reset_cnf"]) {
            $new_password = password_hash($_POST["reset_pwd"], PASSWORD_DEFAULT);


            $sql = "update user_info set password = '$new_password', hash='$hash' where email='$email'";
            if ($con->query($sql)) {
                echo "Your password has been reset successfully!";

            }
        }else{
            echo "Two passwords you entered don't match, try again!";
        }
    }

?>
<div class="container padding-bottom-3x mb-2">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h2>You are about to reset your password?</h2>
            <form class="card mt-4" action="reset-password.php?email=<?= $email;?>&hash=<?= $hash; ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="email-for-pass">Enter your new password</label>
                        <input class="form-control" name="reset_pwd" type="password" id="email-for-pass" required>
                    </div>
                    <div class="form-group">
                        <label for="conf-for-pass">Confirm your new password</label>
                        <input class="form-control" name="reset_cnf" type="password" id="conf-for-pass" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="rs_em" value="<?= $email; ?>">
                        <input type="hidden" name="rs_hash" value="<?= $hash ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" name="rs_sb" type="submit">Confirm New Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } else {
    echo "
<div class=\"container padding-bottom-3x mb-2\">
    <div class=\"row justify-content-center\">
<div class=\"col-lg-8 col-md-10\">
<ol class=\"list-unstyled\">
                <li><span class=\"text-primary text-medium\">1. </span>Please check your email and click on the link</li>
                <li><span class=\"text-primary text-medium\">2. </span>We have emailed you a temporary link.</li>
                <li><span class=\"text-primary text-medium\">3. </span>follow the link to change your password on our secure website.</li>
            </ol>
            </div>
            </div>
            </div>"
 ?>

<!--footer-->
<?php }

include_once "includes/footer.php"?>
</body>
</html>