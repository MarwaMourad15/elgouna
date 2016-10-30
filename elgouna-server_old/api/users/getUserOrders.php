<?php

include('./db_conn.php');
include('./ehgizly_service.php');
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s="SELECT ehgzly_user_token as accessToken "
        . "from users "
        . "where id = " . $_GET["userId"];
$r =mysql_query($s);
$row = mysql_fetch_assoc($r);
$json['user'] = $row;
// $var = '{"userId": "'.$obj->userId.'"}';
$request = \Httpful\Request
        ::get("http://e7gezly.cloudapp.net/api/order/GetUserOrders")->addHeaders(array(
            'appToken' => getAppToken(),
            'Content-Type' => 'application/json',
            'accessToken' => $row['accessToken'],));
$response = $request->send();
if(is_array($response->body)) {
    $array = array();
    for ($i = 0; $i < sizeof($response->body) ; $i++) {
        $Ordercategory = [];
        $order = new stdClass();
        $response->body[$i]->OrderId;
        $order->orderId = "{$response->body[$i]->OrderId}";
        $order->eventId = "{$response->body[$i]->EventId}";
        $order->eventTitle = "{$response->body[$i]->EventTitle}";
        $order->eventImage = "{$response->body[$i]->EventImage}";
        $order->orderStatus = "{$response->body[$i]->OrderStatus}";
        for ($j = 0; $j < sizeof($response->body[$i]->Ordercategory); $j++) { 
            $category = new stdClass();
            $category->id = "{$response->body[$i]->Ordercategory[$j]->CategoryId}";
            $category->name = "{$response->body[$i]->Ordercategory[$j]->CategoryName}";
            $category->price = $response->body[$i]->Ordercategory[$j]->CategoryPrice;
            $category->numberOfTickets = $response->body[$i]->Ordercategory[$j]->NumberOfTickets;
            $Ordercategory[$j]= $category;
        }
        $order->ordercategory = $Ordercategory;
        $order->paymentType = "{$response->body[$i]->PaymentType}";
        $order->orderDate = "{$response->body[$i]->OrderDate}";
        $order->refrenceCode = "{$response->body[$i]->RefrenceCode}";
        $order->totalPayments = "{$response->body[$i]->TotalPayments}";
        $array[$i] = $order;
    }
    echo json_encode($array);
}
else {
    
    echo json_encode([]);
}

?>	
