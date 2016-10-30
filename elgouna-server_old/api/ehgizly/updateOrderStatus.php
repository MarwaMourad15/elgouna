<?php
include './db_conn.php';
include './ehgizly_service.php';
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s="SELECT ehgzly_user_token as accessToken from users where id='$obj->userId'";
$r=mysql_query($s);
$row=mysql_fetch_assoc($r);
$json['user']=$row;

$var = '{"OrderId": "'.$obj->OrderId.'"}'; 
$response = \Httpful\Request::post("http://e7gezly.cloudapp.net/api/order/ChangeOrderStatus")->body($var)->addHeaders(array(
    'appToken' => getAppToken(),
    'Content-Type' => 'application/json',
    'accessToken' => $row['accessToken'],))->send();	
$order = new stdClass();
$order->referenceCode = "{$response->body->refrenceCode}";
$order->totalPayments = "{$response->body->totalPayments}";
$order->orderStatus = "{$response->body->OrderStatus}";
$order->orderStatusId = "qwertyufghjnmcvbnmgthj";
echo json_encode($order);
?>