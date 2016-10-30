<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
include("db_conn.php");
$order_code_json = file_get_contents('php://input');
$order_code_object = json_decode($order_code_json);
$order_arr = array();
$payments = array();
$response = new stdClass();
if(isset($order_code_object->order_code)) {
    
    $order_code = $order_code_object->order_code;
    $order_sql = "select * "
            . "from `orders` "
            . "where `orders`.`order_code` = '$order_code'";
    $order_query = mysql_query($order_sql);
    if($order_query) {
        
        $order_rows = mysql_num_rows($order_query);
        if($order_rows > 0) {  
            
            $order_arr = mysql_fetch_assoc($order_query);
            $order_id = $order_arr['id'];
            $payments_query = mysql_query("select * from "
                    . "`payments` join `users` "
                    . "on `payments`.`user_id` = `users`.`id`"
                    . "where `payments`.`order_id` = '$order_id'");
            if($payments_query) {
                
                $payments_rows = mysql_num_rows($payments_query);
                if($payments_rows > 0) {
                    
                    while($payments_arr = mysql_fetch_assoc($payments_query)) {
                        
                        $payments[] = $payments_arr;
                    }
                    $order_arr['payments'] = $payments;
                }
                else {
                    
                    $order_arr['message'] = $response->message 
                            = "No payments for this order.";
                    $order_arr['payments'] = [];
                }
            }
            else {
                
                $order_arr['mysql_message'] = $response->mysql_message = mysql_error();
            }
        } 
        else {
            
            $order_arr['message'] = $response->message = "There is no such order.";
        }
    }
    else {
        
        $order_arr['mysql_message'] = $response->mysql_message = mysql_error();
    }
}
else {
    
    $order_arr['message'] = $response->message = "Order code is not set.";
}
echo json_encode($order_arr);

?>
