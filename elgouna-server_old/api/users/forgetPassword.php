<?php 

include("db_conn.php");
require_once('PHPMailer-master/PHPMailerAutoload.php');
require_once('PHPMailer-master/class.phpmailer.php');
$json = array();
$json['status'] = 0;
$json['msg'] = '';
$json['mysql_msg'] = '';
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
    $json['msg'] = ($mail->IsError()) 
            ? ' Mail is accepted for delivery' 
            : ' Mail is not accepcted';
    return $bool;
}
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$sql_ex = "select * "
        . "from users "
        . "where email = '" . $obj->email . "' and fbId = ''";
$r_ex = mysql_query($sql_ex);
if($r_ex) {
    $n_ex = mysql_num_rows($r_ex);
    $row_ex = mysql_fetch_assoc($r_ex);
    if($n_ex > 0) {
        $user_id = $row_ex['id'];
        $user_email = $row_ex['email'];
        $pass_reset_token = crypt($user_id . $user_email);
        $sent = send_mail($user_email, 
                file_get_contents('./forgetPasswordMsg.php'), 
                '');
        if($sent) {
            $json['msg'] = 'Mail is delivered.';
            $token_save_query = mysql_query("update users "
                    . "set auth_reset_token = '$pass_reset_token' "
                    . "where email = '$user_email'");
            if($token_save_query) {
                $json['status'] = 1;
                $json['msg'] = 'Mail is delivered and saved.';
            }
            else {
                $json['msg'] = 'Mail is delivered but not saved.';
                $json['mysql_msg'] = mysql_error();
            }
        }
        else {
            $json['msg'] = 'Mail is not delivered.';
        }
    }
    else {
        $json['msg'] = 'There is no such user.';
        $json['mysql_msg'] = mysql_error();
    }
}
else {
    $json['mysql_msg'] = mysql_error();
}

echo json_encode($json);
    
?>
