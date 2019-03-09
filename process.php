<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/3/2018
 * Time: 4:17 PM
 */
include_once "db.php";

$first_name = sanitize($_POST["checkout_first_name"]);
$last_name = sanitize($_POST["checkout_last_name"]);
$email = sanitize($_POST["checkout_email"]);
$address1 = sanitize($_POST["checkout_address1"]);
$address2 = sanitize($_POST["checkout_address2"]);
$phone = sanitize($_POST["checkout_phone"]);

$name = "/^[a-zA-Z ]+$/";
$number = "/^[0-9]+$/";


$errors = array();
$required = array(
    "checkout_first_name" => "First Name",
    "checkout_last_name" => "Last Name",
    "checkout_email" => "Email",
    "checkout_address1" => "Address",
    "checkout_address2" => "City",
    "checkout_phone" => "Phone"
);

//check for empty fields
foreach ($required as $f => $d) {
    if (empty($_POST[$f]) || $_POST[$f] == "") {
        $errors[] = $d . ' is required';
    }
}
//
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please Enter a valid email";
}
if (!preg_match($name, $first_name)) {
    $errors[] = "Please Enter a valid first name";
}
if (!preg_match($name, $last_name)) {
    $errors[] = "Please Enter a valid last name";
}
if (!preg_match($number, $phone)) {
    $errors[] = "Please Enter a valid phone number";
}
if (strlen($phone) < 10) {
    $errors[] = "Phone number should not be more or less than 10 digits";
}
if (!empty($errors)) {
    echo display_errors($errors);
}else{
    $_SESSION["full_name"] = $first_name .' '. $last_name;
    $_SESSION["address"] = $address1;
    $_SESSION["address2"] = $address2;
    $_SESSION["phone"] = $phone;
    $_SESSION["email"] = $email;
    echo "passed";
}




