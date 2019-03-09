<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/3/2018
 * Time: 2:52 AM
 */

include_once "../db.php";

unset($_SESSION["admin"]);
header("Location: admin_login.php");