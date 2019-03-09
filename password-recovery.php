<?php
ob_start();
include_once "db.php";
require_once "send-mail.php";

$veryfy = "";
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
    <title>Password Recovery</title>
    <?php include_once "includes/header.php"; ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="column">
            <h1>Password Recovery</h1>
        </div>
        <div class="column">
            <ul class="breadcrumbs">
                <li><a href="home">Home</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li><a href="#">Account</a>
                </li>
                <li class="separator">&nbsp;</li>
                <li>Password Recovery</li>
            </ul>
        </div>
    </div>
</div>
<!--Page Content-->
<div class="container padding-bottom-3x mb-2">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h2>Forgot your password?</h2>
            <p>Change your password in three easy steps. This helps to keep your new password secure.</p>
            <ol class="list-unstyled">
                <li><span class="text-primary text-medium">1. </span>Fill in your email address below.</li>
                <li><span class="text-primary text-medium">2. </span>We'll email you a temporary link.</li>
                <li><span class="text-primary text-medium">3. </span>follow the link to change your password on our secure website.</li>
            </ol>
            <form class="card mt-4" action="password-recovery.php" method="post">
                <?php
                $errors = array();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = sanitize($_POST["rev_email"]);
                    $result = $con->query("select * from user_info where email = '$email'");
                    if ($result->num_rows == 0) {
                        $errors[] = "User with that email doesn't exist";
                    }
                    if (!empty($errors)){
                        echo display_errors($errors);
                    }else{
                        $user = $result->fetch_assoc();
                        $email = $user["email"];
                        $hash = $user["hash"];
                        $full_name = $user["first_name"] . " " . $user["last_name"];

                        $to = $email;
                        $subject = "Password Reset Link (giloshop.com)";
                        $message = "Hello ". $full_name. " You have requested password reset!
                        Please click this link to reset your password: http://giloshop.com/reset-password.php?email="
                            .$email. "&hash=".$hash;

                        sendMailToUser($to, $full_name, $subject, $message );
                    

                        $veryfy = "<b class='bg-danger text-white'>Email has been sent to $to</b>";
                    }
                }
                ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email-for-pass">Enter your email address</label>
                        <input class="form-control" name="rev_email" type="text" id="email-for-pass" required>
                        <small class="form-text text-muted">Type in the email address you used when you registered with GiLo Shop. Then we'll email a code to this address.</small>
                    </div>
                </div>
                <?php
                
                    echo $veryfy
                   
                
                ?>
                <div class="card-footer">
                    <button class="btn btn-primary" name="recover" type="submit">Get New Password</button>
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