<?php
include_once "db.php";
if (!is_cust_logged_in()) {
    cust_login_error_redirect();
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

    <meta charset="utf-8">
    <title>My Profile</title>
    <?php include_once "includes/header.php" ?>
</head>
<body>
<!-- Google Tag Manager (noscript)-->


<!--Header-->
<?php  include_once "includes/nav.php"; ?>


<!-- Page Content-->
<div class="container padding-top-2x padding-bottom-3x mb-2">
    <div class="row">
        <div class="col-lg-4">
            <aside class="user-info-wrapper">
                <div class="user-cover" style="background-image: url(assets/images/account/user-cover-img.jpg);"></div>
                <div class="user-info">
                    <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="assets/images/account/01.png" alt="User"></div>
                    <div class="user-data">
                        <h4 class="h5"><?=  ((!empty($cust_data["_name"]))? $cust_data["_name"]:"GiLo Mascot"); ?></h4><span>Joined <?= ((!empty($cust_data["date_joined"]))? pretty_date($cust_data["date_joined"]) :  date("d M Y "))  ?></span>
                    </div>
                </div>
            </aside>
            <nav class="list-group">
                <a class="list-group-item with-badge " href="order"><i class="icon-shopping-bag"></i>Orders<span class="badge badge-default badge-pill">1</span></a>
                <a class="list-group-item active" href="#"><i class="icon-user"></i>Profile</a>
                <a class="list-group-item with-badge " href="wishlist"><i class="icon-heart"></i>Wishlist<span class="badge badge-default badge-pill">1</span></a>
            </nav>
        </div>
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <?php
            $uid = $_SESSION["uid"];
            $sql = $con->query("select * from user_info where uid= '$uid'");
            $res = $sql->fetch_assoc();
            $number = "/^[0-9]+$/";
           $errors = array();
            if (isset($_POST["updateP"])) {

               if (empty($_POST["uPwd"]) || empty($_POST["uCnf"])) {
                    $errors[] = "Please fill out all password fields";
                }
                if (!preg_match($number, $_POST["uPhone"])) {
                    $errors[] = "Please Enter a valid Phone Number";
                }
                if (strlen($_POST["uPhone"]) < 10) {
                    $errors[] = "Phone number should be 10 digits";
                }
                if (strlen($_POST["uPwd"]) < 6) {
                    $errors[] = "Passwords should be more than 6 characters";
                }
                if ($_POST["uPwd"] != $_POST["uCnf"]) {
                    $errors[] = "Two passwords you entered don't match, try again!";
                }
                if (!empty($errors)) {
                    echo display_errors($errors);
                } else{
                    $new_password = password_hash($_POST["uPwd"], PASSWORD_DEFAULT);
                    $phone = $_POST["uPhone"];

                    $sql = "update user_info set password = '$new_password', phone = '$phone'  where uid ='$uid'";
                    if ($con->query($sql)) {
                        $_SESSION["success_msg"] = "<p class='bg-success text-white'>Your info has been updated successfully!</p>";
                        echo $_SESSION["success_msg"];
                    }
                }

            }
            ?>
            <form class="row" method="post" action="account-profile.php">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">E-mail Address</label>
                        <input class="form-control" type="email" id="account-email" value="<?= $res["email"] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-phone">Phone Number</label>
                        <input class="form-control" name="uPhone" type="text" value="<?= $res["phone"] ?>" id="account-phone"  required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-pass">New Password</label>
                        <input class="form-control" name="uPwd" type="password" id="account-pass">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-confirm-pass">Confirm Password</label>
                        <input class="form-control" name="uCnf" type="password" id="account-confirm-pass">
                    </div>
                </div>
                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="custom-control custom-checkbox d-block">
                            <input class="custom-control-input" type="checkbox" id="subscribe_me" checked>
                            <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
                        </div>
                        <button class="btn btn-primary margin-right-none" type="submit" name="updateP">Update Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--footer-->
<?php include_once "includes/footer.php"?>

</body>
</html>