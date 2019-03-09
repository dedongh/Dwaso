<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/5/2018
 * Time: 11:52 PM
 */

use PHPMailer\PHPMailer\PHPMailer;
require_once "vendor/autoload.php";


function sendMailToUser($recipient, $name, $subject, $body){
    $mail = new PHPMailer;
    try{
        //configuration
       $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = "localhost";
        $mail->SMTPAuth = false;
        $mail->Username = "info@giloshop.com";
        $mail->Password = "emails@giloshop.com";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->From = "info@giloshop.com";
        $mail->FromName = "GiloShop";

        //recipient
        $mail->addAddress($recipient, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //send mail
        $mail->send();
        //echo "Message has been sent successfully";
    }catch(Exception $e){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

function sendMailToUserWithAttachment($recipient, $name, $subject, $body, $file){
    $mail = new PHPMailer;
    try{
        //configuration
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = "localhost";
        $mail->SMTPAuth = false;
        $mail->Username = "info@giloshop.com";
        $mail->Password = "emails@giloshop.com";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->From = "info@giloshop.com";
        $mail->FromName = "GiloShop";

        //recipient
        $mail->addAddress($recipient, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->addAttachment($file);
        $mail->WordWrap = 50;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //send mail
        $mail->send();
        //echo "Message has been sent successfully";
    }catch(Exception $e){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}