<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/3/2018
 * Time: 5:10 PM
 */

include_once "db.php";

//Make sure email and hash variables ain't empty
if (isset($_GET["email"]) && !empty($_GET["email"]) && isset($_GET["hash"]) && !empty($_GET["hash"])) {
    $email = sanitize($_GET["email"]);
    $hash = sanitize($_GET["hash"]);

    $results = $con->query("select * from user_info where email = '$email' and hash='$hash' and active = '0'");
    if ($results->num_rows == 0) {
        echo "Account has already been activated or the URL is invalid!";
    }else{
        echo "<div class='alert alert-primary alert-dismissible fade show text-center margin-bottom-1x'>
<span class=\"alert-close\" data-dismiss=\"alert\"></span><i class=\"icon-bell\"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Please:</span>
Your Account has been activated. Click on this link
<a href='http://giloshop.com'>Home</a> to continue shopping
</div>";
        $con->query("update user_info set active = '1' where email='$email'") or die($con->error);
        $_SESSION["active"] = 1;
    }
}else{
    echo "Invalid parameters provided for account verification";
}