<?php

error_reporting(E_ERROR);
include("db_conn.php");
include("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$pass = $obj->userAuth;
$s = "select id as userId, "
        . "name,"
        . "userAuth,"
        . "imageURL,"
        . "phoneNumber,"
        . "gender,"
        . "birthDate,"
        . "address,"
        . "email,"
        . "zipCode,"
        . "fbId as facebookId,"
        . "notificationsEnabled,"
        . "mapsEnabled,"
        . "elgounaPhone,"
        . "elgounaSMS,"
        . "elgounaemail,"
        . "ehgzly_user_id "
        . "from users "
        . "where email = '" . $obj->email . "'";
$r = mysql_query($s);
$n = mysql_num_rows($r);
if($n == 1) {
    $user_arr = mysql_fetch_assoc($r);
    $auth = $user_arr['userAuth'];
//    if(password_verify($pass, $auth)) {
    if($pass === $auth) {
        $json['status']='1';
        $json['user']=$user_arr;
        $var = '{"UserName": "' . $json['user']['name'] . '", "Password": "'
                . $obj->userAuth . '"}';
        $response = \Httpful\Request
                ::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")
                ->body($var)->addHeaders(array(
        'appToken' => getAppToken(),
        'Content-Type' => 'application/json',))->send();
        $json['user']['ehgzly_user_token'] = $response->body->access_token;

           if(repeatRequest($response->code)){
                 $response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var)->addHeaders(array(
                    'appToken' => getAppToken(),
                    'Content-Type' => 'application/json',))->send();
                 $json['user']['ehgzly_user_token'] = $response->body->access_token;
            }
        //Retry to sign up user again, this part need to be revisited
        if($response->body->access_token == null) {
            $var1 = '{"UserName": "' . $json['user']['name'].'", "Password": "'
                    . $json['user']['userAuth'].'", "FullName": "'
                    . $json['user']['name'].'", "PhoneNumer": "'
                    . $json['user']['phone'].'", "Address": "masr"}';
            $var2 = '{"UserName": "' . $json['user']['name'].'", "Password": "'
                    . $obj->userAuth.'"}';
            $response1 = \Httpful\Request
                    ::post("http://e7gezly.cloudapp.net/api/user/AddUser")
                    ->body($var1)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
                    $json['user']['ehgzly_user_id'] = $response1->body->UserId;
                    $response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array(
                    'appToken' => getAppToken(),
                    'Content-Type' => 'application/json',))->send();
                    $json['user']['ehgzly_user_token'] = $response2->body->access_token;
                    if(repeatRequest($response1->code)){
                            $response1 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var1)->addHeaders(array(
                                'appToken' => getAppToken(),
                                'Content-Type' => 'application/json',))->send();
                            $json['user']['ehgzly_user_id'] = $response1->body->UserId;
                            $response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
                        $json['user']['ehgzly_user_token'] = $response2->body->access_token;
                    }
                    $sql = "UPDATE users SET ehgzly_user_id='{$response1->body->UserId}', ehgzly_user_token='{$response2->body->access_token}' where id ='$insertedID'";
                    $res = mysql_query($sql);
                    $json['user']['ehgzly_user_token'] = $response1->body->access_token;
        }
        $sql = "UPDATE users SET ehgzly_user_token='{$json['user']['ehgzly_user_token']}' where id ={$json['user']['userId']}";
        $res = mysql_query($sql);
        $json['user']['cards'] = array();
        $cards_sql = "select * "
                . "from `user-card` "
                . "where user_id = " . $json['user']['userId'];
        $cards_query = mysql_query($cards_sql);
        if($cards_query) {

            $cards_rows = mysql_num_rows($cards_query);
            if($cards_rows > 0) {

                while($card_arr = mysql_fetch_array($cards_query, MYSQLI_ASSOC)) {
                    array_push($json['user']['cards'], $card_arr);
                }
            }
        }
    }
    else {
        $json['status']='0';
	$json['user']='';
	$json['msg']='Email and password do not match.';
    }
} 
else {
	$json['status']='0';
	$json['user']='';
        $json['msg']='There is no such user.';
}
echo json_encode($json);

?>
