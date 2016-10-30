<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
include("db_conn.php");
//include("check_session.php");
$order_to_be_closed_json = file_get_contents('php://input');
$order_to_be_closed_json_object = json_decode($order_to_be_closed_json);
$response = new stdClass();
if(isset($order_to_be_closed_json_object->order_code)) {
    
    $order_to_be_closed_sql = "select *"
        . "from orders "
        . "where order_code = '$order_to_be_closed_json_object->order_code' "
        . "and closed = 0";
    $order_to_be_closed_query = mysql_query($order_to_be_closed_sql);
    if($order_to_be_closed_query) {

        $order_to_be_closed_rows = mysql_num_rows($order_to_be_closed_query);
        if($order_to_be_closed_rows > 0) {

            $close_order_sql = "update orders "
                    . "set closed = 1 "
                    . "where order_code = '$order_to_be_closed_json_object->order_code'";
            $close_order_query = mysql_query($close_order_sql);
            if($close_order_query) {

                $response->status = "Success";
                $response->message = "Order #" . $order_to_be_closed_json_object->order_code 
                        . " has been closed.";
            }
            else {

                $response->status = "Failure";
                $response->mysql_message = mysql_error();
            }
        }
        else {

            $response->status = "Failure";
            $response->message = "This order is already closed or doesn't exist.";
        }
    }
    else {

        $response->status = "Failure";
        $response->mysql_message = mysql_error();
    }
}
else {
    
    $response->status = "Failure";
    $response->message = "Order id is not set.";
}
echo json_encode($response);

?>	
