<?php 

include("db_conn.php");
include("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$sql_ex="select id from users where email='".$obj->{'email'}."'";
$r_ex=mysql_query($sql_ex);
$n_ex=0;
$n_ex=mysql_num_rows($r_ex);


if($n_ex==0){
	$s="insert into users values ('','".$obj->{'userAuth'}."','".$obj->{'name'}."','','".$obj->{'phone'}."','".$obj->{'gender'}."','".$obj->{'birthday'}."','','".$obj->{'email'}."','','','','','','','".$obj->{'fbId'}."','','', '')";
//echo $s;
	$r=mysql_query($s);
	$insertedID=mysql_insert_id();
} else {
	$row_ex = mysql_fetch_array($r_ex);
	$sql_x = "update users set fbId='" . $obj->fbId . "' where id = '$row_ex[id]'";
	$r_x = mysql_query($sql_x);
	$insertedID = $row_ex['id'];
}

$s = "select id as userId, name,imageURL,phoneNumber,gender,birthDate,address,email,zipCode,fbId as facebookId,notificationsEnabled,mapsEnabled,elgounaPhone,elgounaSMS,elgounaemail from users where id='$insertedID'";
$r=mysql_query($s);
$row=mysql_fetch_assoc($r);

if (mysql_num_rows($r) == 0) {
	$json['user']=new stdClass();
	$json['status']='0';
	echo json_encode($json);
	exit();
}
$json['user']=$row;
$json['status']='1';
$imgUr="https://graph.facebook.com/".$row['facebookId']."/picture?type=large";
$json['user']['imageURL'] = $imgUr;

$var = '{"UserName": "'.$obj->name.'", "Password": "'.$obj->userAuth.'", "FullName": "'.$obj->name.'", "PhoneNumer": "'.$obj->phone.'", "Address": "masr"}';
$var2 = '{"UserName": "'.$obj->name.'", "Password": "'.$obj->userAuth.'"}';

$response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var)->addHeaders(array('appToken' => getAppToken(), 'Content-Type' => 'application/json',))->send();
$json['user']['ehgzly_user_id'] = $response->body->UserId;

$response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array('appToken' => getAppToken(),'Content-Type' => 'application/json',))->send();
$json['user']['ehgzly_user_token'] = $response2->body->access_token;

if(repeatRequest($response->code)){
	$response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var)->addHeaders(array('appToken' => getAppToken(), 'Content-Type' => 'application/json',))->send();
	$json['user']['ehgzly_user_id'] = $response->body->UserId;

	$response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array('appToken' => getAppToken(),'Content-Type' => 'application/json',))->send();
	$json['user']['ehgzly_user_token'] = $response2->body->access_token;
    	
	if(repeatRequest($response->code)){
        	$response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/AddUser")->body($var)->addHeaders(array('appToken' => getAppToken(),'Content-Type' => 'application/json',))->send();
	        $json['user']['ehgzly_user_id'] = $response->body->UserId;
        	$response2 = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")->body($var2)->addHeaders(array('appToken' => getAppToken(),'Content-Type' => 'application/json',))->send();
	        $json['user']['ehgzly_user_token'] = $response2->body->access_token;
    	}
    	$sql = "UPDATE users ". "SET ehgzly_user_id = '{$response->body->UserId}', " . "ehgzly_user_token = '{$response2->body->access_token}' " . "where id ='$insertedID'";
   	$res = mysql_query($sql);
}

echo json_encode($json);

?>
