<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 8/14/2018
 * Time: 2:01 PM
 */

function display_errors($errors)
{
    $display = '<ul class="alert-danger list-unstyled">';
    foreach ($errors as $error) {
        $display .= '<li class="text-center">'.$error.'</li>';
    }
    $display .= '</ul>';
    return $display;
}

function sanitize($dirty)
{
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function money($number)
{
    return "Ghc ".number_format($number, 2, ".",",");
}

//admin login
function login($user_id)
{
    $_SESSION["admin"] = $user_id;
    global $con;
    $date = date("Y-m-d H:i:s");
    $con->query("update users set last_login = '$date' where id = '$user_id'");
    header("Location: index.php");
   
}

//customer login
function cust_login($user_id)
{
    $_SESSION["uid"] = $user_id;
    global $con;
    $ip_add = getUserIP();
    $date = date("Y-m-d H:i:s");
    $con->query("update user_info set last_login = '$date' where uid = '$user_id'");
    $con->query("update cart set uid = '$user_id' where ip_add= '$ip_add'");

    //user token
    $token = getToken(10);
    $_SESSION["token"] = $token;
    // Update user token
    $result_token = $con->query( "select count(*) as allcount from user_token where uid = '$user_id'");
    $row_token = $result_token->fetch_assoc();
    if ($row_token['allcount'] > 0) {
        $con->query("update user_token set token= '$token' where uid = '$user_id'");
    }else{
        $con->query("insert into user_token(uid,token) values('$user_id','$token')");
    }
    header("Location: index.php");
}
//get user token
function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[rand(0, $max-1)];
    }

    return $token;
}
//check if admin is logged in
function is_logged_in()
{
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] > 0) {
        return true;
    }
    return false;
}
//cust login check
function is_cust_logged_in()
{
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] > 0) {
        return true;
    }
    return false;
}

//redirect if admin is not logged in
function login_error_redirect($url = "admin_login.php")
{
    //$_SESSION["error_msg"] = "You must be logged in to access that page";
    header("Location: " . $url);
}

//redirect if cust is not logged in
function cust_login_error_redirect($url = "sign-in.php")
{
    //$_SESSION["error_msg"] = "You must be logged in to access that page";
    header("Location: " . $url);
}

//check if user has been activated
function is_cust_activated()
{
    global $con;

}
//check page permissions for each user
function has_permission($permission = "admin")
{
    global $user_data;
    $permissions = explode(",", $user_data["permissions"]);
    if (in_array($permission,$permissions,true)) {
        return true;
    }
    return false;
}
//admin roles and permissions
function permission_error_redirect($url = "admin_login.php")
{
    $_SESSION["error_msg"] = "You don't have permission to access that page";
    header("Location: " . $url);
}

function pretty_date($date)
{
    return date("M d, Y h:i A", strtotime($date));
}

function get_category($child_id)
{
    global $con;
    $id = sanitize($child_id);
    $sql = "SELECT p.c_id AS 'pid', p.name as 'parent',
    c.c_id as 'cid', c.name as 'child'
    from categories c
    INNER JOIN categories p 
    ON c.parent = p.c_id
    where c.c_id = '$id'";

    $query = $con->query($sql);
    $category = $query->fetch_assoc();
    return $category;
}

function individual_ratings($rate)
{
    if ($rate == null) {
        $star = ' <i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i> ';

    }
    for ($i = 1; $i <= $rate; $i++) {
        if ($i == 5) {
            $star = ' <i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i> ';

        }if ($i == 4){
            $star = ' <i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star "></i> ';

        }
        if ($i == 3){
            $star = ' <i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star "></i> ';

        }if ($i == 2){
            $star = ' <i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i> ';

        }if ($i == 1){
            $star = ' <i class="icon-star filled"></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i><i class="icon-star "></i> ';

        }
    }
    return $star;
}

//product ratings
function product_rating($id)
{
    global $con;
    $id = sanitize($id);
    $qry = $con->query("SELECT AVG(rating) as rating FROM reviews WHERE p_id = '$id' and status = 1");
    $rqy = $qry->fetch_assoc();
    $ser = round($rqy["rating"], 1);

    return individual_ratings($ser);
}

//get IP address of user
function getUserIP()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        //ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        //ip from proxy
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}

//check which page user is on
function currentPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
// get current page name of user
function curPageName() {
    return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
