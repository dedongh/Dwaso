<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/5/2018
 * Time: 8:57 AM
 */

require_once "../../db.php";

if (isset($_POST["view"])) {
    if ($_POST["view"] != '') {
        $updateQry = " update orders set note_status = 1 where note_status = 0";
        $con->query($updateQry);
    }
    $query = "select * from transactions order by id desc limit 5";
    $result = $con->query($query);

    $output = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <li>
            <a href="orders.php?txn_id='.$row["order_id"].'">
            <strong>'.$row["full_name"].'</strong>
            <small><em>'.$row["description"].'</em></small>
            </a>
            </li>
            ';
        }
    }else{
        $output .= "
        <li><a href='#' class='text-bold '>No Notification Found</a></li>
        ";
    }
    $query1 = "select * from orders where note_status = 0";
    $result1 = $con->query($query1);
    $count = $result1->num_rows;
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );

    echo json_encode($data);

}