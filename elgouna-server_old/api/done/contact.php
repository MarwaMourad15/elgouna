<?php

include("db_conn.php");
require_once('PHPMailer-master/PHPMailerAutoload.php');
require_once('PHPMailer-master/class.phpmailer.php');
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$json['status'] = 0;
$json['msg'] = '';
$json['mysql_msg'] = '';
date_default_timezone_set('Africa/Cairo');
$currentDate = date("Y-m-d H:i:s");
$sent = send_mail('hesham.saeed@appenza-studio.com', 
        file_get_contents('./contact-tmpl.php'), 
        '');
if($sent == 1) {
    $json['msg'] = 'mail delivered.';
    $r = mysql_query("insert into contact "
            . "values ('','$obj->name','$obj->email','$obj->phone' , '" 
            . mysql_real_escape_string($obj->message) . "' , '$currentDate')");
    if($r) {
        $json['status'] = 1;
        $json['msg'] = 'mail delivered and stored.';
    }
    else {
        $json['msg'] = 'mail delivered but not stored.';
        $json['mysql_msg'] = mysql_error();
    }
}
else {
    $json['msg'] = 'mail not delivered.';
}
echo json_encode($json);
function send_mail($to, $html, $text) {
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->Host = "smtp.mandrillapp.com";
//    $mail->SMTPDebug = 2; // 2 to enable SMTP debug information
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Username = 'Appenza.co';
    $mail->Password = 'tNWiOPm7JBkJk9ciumnkLA';
    $mail->Priority = 1;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = '8bit';
    $mail->Subject = 'Elgouna App - Password Reset Verification';
    $mail->ContentType = 'text/html; charset=utf-8\r\n';
    $mail->From = 'info@elgouna.com';
//    $mail->FromName = '';
    $mail->WordWrap = 900;
    $mail->AddAddress($to);
    $mail->isHTML(TRUE);
    $mail->Body = $html;
    $mail->AltBody = $text;
    $bool = $mail->Send();
    $mail->SmtpClose();
    $json['status'] = ($mail->IsError()) ? 1 : 0;
    $json['msg'] = ($mail->IsError()) 
            ? ' mail accepted for delivery' 
            : ' mail not accepcted';
    return $bool;
}

?>
