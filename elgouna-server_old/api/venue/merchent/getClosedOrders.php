<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

include("db_conn.php");
//include("check_session.php");
$response = new stdClass();
$closed_orders_arr = array();
$closed_orders_sql = "select *"
        . "from orders order by creation_date desc";
//        . "where closed = 1";
$closed_orders_query = mysql_query($closed_orders_sql);
if($closed_orders_query) {
    
    $closed_orders_rows = mysql_num_rows($closed_orders_query);
    if($closed_orders_rows > 0) {
        
        while($closed_order_arr = mysql_fetch_assoc($closed_orders_query)) {
            
            array_push($closed_orders_arr, $closed_order_arr);
        }
    }
    else {
        
        $closed_order_arr['status'] = $response->status = "Failure";
        $closed_order_arr['message'] = $response->message = "There are no closed orders.";
    }
}
else {
    
    $closed_order_arr['status'] = $response->status = "Failure";
    $closed_order_arr['mysql_message'] = $response->mysql_message = mysql_error();
}
echo json_encode($closed_orders_arr);

?>	
