<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/6/2018
 * Time: 1:00 PM
 */

include_once "db.php";

unset($_SESSION["uid"]);
header("Location: sign-in.php");