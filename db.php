<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 6/2/2018
 * Time: 11:29 AM
 */


DEFINE("DBUSER","engineerskasa");
DEFINE("DBPWD",'$eng$kasa');
DEFINE("DBHOST","localhost");
DEFINE("DBNAME","giloo");

// Create connection
$con = new mysqli(DBHOST, DBUSER,DBPWD,DBNAME);

//Check connection
if (!$con) {
    trigger_error("Connection failed:". mysqli_connect_error());
    exit();
}
if(!isset($_SESSION))
{
    session_start();
}
require_once "config.php";
require_once BASEURL . "helpers/helpers.php";


if (isset($_SESSION["admin"])) {
    $user_id = $_SESSION["admin"];
    $uQry = $con->query("select * from users where id ='$user_id'");
    $user_data = $uQry->fetch_assoc();
    $fn = explode(" ", $user_data["full_name"]);
    $user_data["first"] = $fn[0];
    $user_data["last"] = $fn[1];
}
if (isset($_SESSION["uid"])) {
    $cust_id = $_SESSION["uid"];
    $custQry = $con->query("select * from user_info where uid = '$cust_id'");
    $cust_data = $custQry->fetch_assoc();
    $cust_data["display_name"] = $cust_data["first_name"];
    $cust_data["_name"] = $cust_data["first_name"]. " ". $cust_data["last_name"];
    $cust_data["date_joined"] = $cust_data["joined_date"];

    //logout when token mismatch
    $result = $con->query("select token from user_token where uid = '$cust_id'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $token = $row["token"];
        if ($_SESSION["token"] != $token) {
            session_destroy();
            header('Location: index.php');
        }
    }
}

if (isset($_SESSION["success_msg"])) {
    echo '<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
<span class="alert-close" data-dismiss="alert"></span><i class="icon-bell"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Please:</span>
'.$_SESSION["success_msg"].'</div>';
    unset($_SESSION["success_msg"]);
}
if (isset($_SESSION["error_msg"])) {
    echo '<div class="alert alert-primary alert-dismissible fade show text-center margin-bottom-1x">
<span class="alert-close" data-dismiss="alert"></span><i class="icon-bell"></i>&nbsp;&nbsp;<span class=\'text-medium\'>Please:</span>
'.$_SESSION["error_msg"].'</div>';
    unset($_SESSION["error_msg"]);
}


