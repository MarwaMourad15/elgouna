<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

include("db_conn.php");
///include("check_session.php");
global $response;
$response = new stdClass();
$response->status = 'Failure';
$response->message = '';
$response->order_code = '';
$venue_order_json = file_get_contents('php://input');
$venue_order_object = json_decode($venue_order_json);
if(isset($venue_order_object->bill->venue_id) 
        && isset($venue_order_object->bill->venue_name) 
        && isset($venue_order_object->bill->venue_main_img) 
        && isset($venue_order_object->bill->table) 
        && isset($venue_order_object->bill->ref)
        && isset($venue_order_object->bill->amount)) {

    $order_code = generateRandomString(4);
    $order_table = $venue_order_object->bill->table;
    $order_amount = $venue_order_object->bill->amount;
    $order_ref = $venue_order_object->bill->ref;
    $venue_id = $venue_order_object->bill->venue_id;
    $venue_name = $venue_order_object->bill->venue_name;
    $venue_main_img = $venue_order_object->bill->venue_main_img;
    $today = date("Y-m-d");

    $save_order_sql = "insert into orders "
        . "values('', '$order_code', "
        . "'$order_amount', "
        . "'$today', "
        . "'0.00', "
        . "'0', "
        . "NULL, "
        . "NULL, "
        . "'$venue_name', "
        . "'$venue_main_img', "
        . "'$venue_id', "
        . "'$order_table', "
        . "'$order_ref')";
//    mysql_query("SET FOREIGN_KEY_CHECKS = 0");
    $save_order_query = mysql_query($save_order_sql);
//    echo $save_order_sql;
    if($save_order_query) {
        
        $response->order_code = $order_code;
        $response->query = $save_order_query;
        $response->message = "Done";
        $response->status = 'Success';
    }
    else {
        
        $response->message = mysql_error();
        $response->status = 'Failure';
    }
}
else {
    
    $response->message = 'Order parameters are not set';
    $response->status = 'Failure';
}
function generateRandomString($length = 10) {
    
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
echo json_encode($response);

?>	
