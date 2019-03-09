<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 8/29/2018
 * Time: 1:55 AM
 */

//$APIKey = "466c3581fd6853940220c9ab353d1939adf2b20b";
//$recipient = 0240386865

//mazzuma
if (isset($_POST)) {

    /*$price = $_POST["price"];
    $network = $_POST["network"];
    $recNum = $_POST["recipient_number"];
    $sender = $_POST["sender"];
    $option = $_POST["option"];
    $apikey = $_POST["apikey"];*/


    $data = array(
        "price" => 50,
        "network" => "mtn",
        "recipient_number" => "0240386865",
        "sender" => "0542444527",
        "option" => "rmtm",
        "apikey" => "7cbcaecf59413e088c7fe056b5d84ffd8b6d85b6"
    );

    $url = 'https://client.teamcyst.com/api_call.php';


    $additional_headers = array(
        'Content-Type: application/json'
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // $data is the request payload
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers);

    $server_output = curl_exec($ch);
    if ($server_output == FALSE) {
        die("Curl failed" . curl_error($ch));
    }
    curl_close($ch);
    echo json_encode($data,JSON_PRETTY_PRINT);
    echo $server_output;
}
