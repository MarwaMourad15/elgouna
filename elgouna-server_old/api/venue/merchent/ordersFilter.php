<?php
//
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
include('db_conn.php');
$orders_array = array();
$table_flag = false;
$orders_request_json = file_get_contents('php://input');
$orders_request_object = json_decode($orders_request_json);
if(isset($orders_request_object->venue_id) 
        && isset($orders_request_object->status)
        && isset($orders_request_object->date)
        && isset($orders_request_object->table)) {
    
    $venue_id = $orders_request_object->venue_id;
    $orders_status = $orders_request_object->status;
    $orders_date = $orders_request_object->date;
    $order_table = $orders_request_object->table;
    $orders_sql = "select * "
            . "from orders "
            . "where venue_id = '$venue_id'";
    switch ($orders_status) {
        case 'Open Bills':
            $orders_sql .= "and `closed` = 0 ";
            break;
        case 'Closed Bills':
            $orders_sql .= "and `closed` = 1 ";
            break;
    }
    switch ($orders_date) {
        case 'Today':
            $orders_sql .= "and `creation_date` = CURDATE() ";
            break;
        case 'Yesterday':
            $orders_sql .= "and `creation_date` = DATE_SUB(CURDATE(), INTERVAL 1 DAY) ";
            break;
        case 'Last Week':
            $orders_sql .= "and `creation_date` between date_sub(CURDATE(), INTERVAL 1 WEEK) and CURDATE() ";
            break;
    }
    if($order_table != 'all') {
        
        $table_flag = true;
        $orders_sql .= "and `table` = '$order_table' order by id desc";
    }
    if(!$table_flag) {
        
        $orders_sql .= "order by id desc";
    }
    $orders_query = mysql_query($orders_sql);
    if($orders_query) {
        
        $orders_rows = mysql_num_rows($orders_query);
        if($orders_rows > 0) {
            
            while($order_arr = mysql_fetch_assoc($orders_query)) {
                
                $order_detail = new stdClass();
                $order_detail->code = $order_arr['order_code'];
                $order_detail->ref = $order_arr['paymob_ref'];
                $order_detail->table = $order_arr['table'];
                $order_detail->date = $order_arr['creation_date'];
                $order_detail->amount = $order_arr['amount'];
                $order_detail->paid = $order_arr['paidAmount'];
                array_push($orders_array, $order_detail);
            }
        }
        else {
            
            die('No orders found for this criteria.');
        }
    }
    else {
        
        die(mysql_error());
    }
}
else {
    
    die('Orders parameters are not set.');
}

echo json_encode($orders_array);
//return $orders_array;

?>
