<?php

include './db_conn.php';
include './ehgizly_service.php';
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$json['status'] = 0;
//13/06/2016 3:34-------------------------------------------------------------------------
//$auth = $obj->userAuth;
//$auth_enc = password_hash($auth, PASSWORD_DEFAULT);
//----------------------------------------------------------------------------------------
$sql_ex = "select id from users where email='" . $obj->{'email'} . "'";
$r_ex = mysql_query($sql_ex);
$n_ex = 0;
$n_ex = mysql_num_rows($r_ex);
if ($n_ex == 0) {
    $r = mysql_query("insert into users "
            . "(userAuth, "
            . "name, "
            . "phoneNumber, "
            . "gender, "
            . "birthDate, "
            . "email, "
            . "fbId) "
            . "values ('$obj->userAuth', "
            . "'$obj->name', "
            . "'$obj->phone', "
            . "'$obj->gender', "
            . "'$obj->birthday',"
            . "'$obj->email', "
            . "'$obj->fbId')");
    if($r) {
        $insertedID = mysql_insert_id();
        $s = "select id as userId, userAuth, name,imageURL,phoneNumber,gender,birthDate,address,email,zipCode,fbId as facebookId,notificationsEnabled,mapsEnabled,elgounaPhone,elgounaSMS,elgounaemail from users where id='$insertedID'";
        $r = mysql_query($s);
        $row = mysql_fetch_assoc($r);
        $json['status'] = '1';
        $json['user'] = $row;
        echo mysql_error();
        $var = '{"UserName": "' . $obj->name . '", "Password": "' . $auth_enc . '", "FullName": "' . $obj->name . '", "PhoneNumer": "' . $obj->phone . '", "Address": "masr"}';
        $var2 = '{"UserName": "' . $obj->name . '", "Password": "' . $auth_enc . '"}';
        $response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var)->addHeaders(array(
                    'appToken' => getAppToken(),
                    'Content-Type' => 'application/json',))->send();
        $json['user']['ehgzly_user_id'] = $response->body->UserId;
        $response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array(
                    'appToken' => getAppToken(),
                    'Content-Type' => 'application/json',))->send();
        $json['user']['ehgzly_user_token'] = $response2->body->access_token;
        if (repeatRequest($response->code)) {
            $response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
            $json['user']['ehgzly_user_id'] = $response->body->UserId;
            $response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
            $json['user']['ehgzly_user_token'] = $response2->body->access_token;
        }
        $sql = "UPDATE users SET ehgzly_user_id='{$response->body->UserId}', ehgzly_user_token='{$response2->body->access_token}' where id ='$insertedID'";
        $res = mysql_query($sql);
    }
    else {
        $json['user'] = '';
        $json['mysql_msg'] = mysql_error();
    }
} 
else {
    $json['user'] = '';
    $json['msg'] = 'This email is already taken.';
}
echo json_encode($json);

?> 
