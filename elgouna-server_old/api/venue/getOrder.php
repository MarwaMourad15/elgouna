<?php 

include("db_conn.php");
$order_id_json = file_get_contents('php://input');
$order_id_json_object = json_decode($order_id_json);
$response = new stdClass();
if(isset($order_id_json_object->order_id)) {
    
    $order_arr = array();
    $order_id = $order_id_json_object->order_id;
    $order_sql = "select * "
            . "from orders "
            . "where id = '$order_id'";
    $order_query = mysql_query($order_sql);
    if($order_query) {
        
        $order_rows = mysql_num_rows($order_query);
        if($order_rows > 0) {  
            
            $order_arr = mysql_fetch_assoc($order_query);
            $venue_info_sql = "select `venues`.`name` as venueName, "
                    . "`venues_img`.`img` as venueImg "
                    . "from `orders` join `venues` "
                    . "on `orders`.`venueId` = `venues`.`id` join `venues_img` "
                    . "on `venues`.`id` = `venues_img`.`venue_id` "
                    . "where `orders`.`id` = '$order_id'";
            $venue_info_query = mysql_query($venue_info_sql);
            if($venue_info_query) {
                
                $venue_info_row = mysql_num_rows($venue_info_query);
                if($venue_info_row > 0) {
                    
                    $venue_info_arr = mysql_fetch_assoc($venue_info_query);
                    $venue_name = $venue_info_arr['venueName'];
                    $venue_image = $venue_info_arr['venueImg'];
                    $order_arr['venue_name'] = $venue_name;
                    $order_arr['venue_image'] = $venue_image;
                }
                else {
                    
                    $order_arr['status'] = $response->status = "Failure";
                    $order_arr['mysql_message'] = $response->mysql_message = mysql_error();
                }
            }
            else {
                
                $order_arr['status'] = $response->status = "Failure";
                $order_arr['mysql_message'] = $response->mysql_message = mysql_error();
            }
        } 
        else {
            
            $order_arr['status'] = $response->status = "Failure";
            $order_arr['message'] = $response->mysql_message = "There is no such order.";
        }
    }
    else {
        
        $order_arr['status'] = $response->status = "Failure";
        $order_arr['mysql_message'] = $response->mysql_message = mysql_error();
    }
}
else {
    
    $order_arr['status'] = $response->status = "Failure";
    $order_arr['message'] = $response->mysql_message = "There is no such order.";
}
echo json_encode($order_arr, JSON_UNESCAPED_SLASHES);

?>
