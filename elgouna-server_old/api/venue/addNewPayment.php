<?php

include("db_conn.php");
date_default_timezone_set("Africa/Cairo");
$payment_data_json = file_get_contents('php://input');
$payment_data_json_object = json_decode($payment_data_json);
$response = new stdClass();
if(isset($payment_data_json_object->user_id) 
        && isset($payment_data_json_object->order_id)
        && isset($payment_data_json_object->card_ending)
        && isset($payment_data_json_object->amount) 
        && isset($payment_data_json_object->pm_ref)) {
    
    $order_id = $payment_data_json_object->order_id;
    $payment_date = date("Y-m-d h:m:s");
    $card_ending_with = $payment_data_json_object->card_ending;
    $payment_amount = $payment_data_json_object->amount;
    $user_id = $payment_data_json_object->user_id;
    $user_sql = "select * "
            . "from users "
            . "where id = '$user_id'";
    $user_query = mysql_query($user_sql);
    if($user_query) {
        
        $user_rows = mysql_num_rows($user_query);
        if($user_rows > 0) {
	    $order_sql = "select `orders`.*, `venues`.`name` as venueName "
                   . "from `orders` join `venues` "
                    . "on `orders`.`venue_id` = `venues`.`id` "
                    . "where `orders`.id = '$order_id'";
            $order_query = mysql_query($order_sql);
            if($order_query) {
                
                $order_rows = mysql_num_rows($order_query);
                if($order_rows > 0) {
                   
                    $order_arr = mysql_fetch_assoc($order_query);
                    $venue_name = $order_arr['venueName'];
                    $paymob_ref = $payment_data_json_object->pm_ref;
                    $order_user_sql = "select * "
                            . "from `user-card` "
                            . "where user_id = '$user_id'";
                    $add_payment_sql = "insert into `payments` "
                    . "values ('', "
                    . "'$payment_amount', "
                    . "'$payment_date', "
                    . "'$card_ending_with', "
                    . "'$venue_name', "
                    . "'$paymob_ref', "
                    . "'$user_id', "
                    . "'$order_id'"
                    . ")";
                    $add_payment_query = mysql_query($add_payment_sql);
                    if($add_payment_query) {

                        $response->status = "Success";
                        $response->message = "You have paid " . $payment_amount 
                                . " EGP to order #" . $order_id . ".";
                        $order_amount = $order_arr['amount'];
                        $paid_amount = $order_arr['paidAmount'];
                        if($payment_amount > $order_amount) {

                            $response->status = "Failure";
                            $response->message = "Payment amount cannot exceed order total.";
                        }
                        else {

                            $paid_amount += $payment_amount;
                            $order_update_sql = "update orders "
                                    . "set paidAmount = '$paid_amount', "
                                    . "last_payment_date = '$payment_date' "
                                    . "where id = '$order_id'";
                            $order_update_query = mysql_query($order_update_sql);
                            if(!$order_update_query) {

                                $response->status = "Failure";
                                $response->message = "Order #" . $order_id 
                                        . " could not be updated.";
                                $response->mysql_message = mysql_error();
                            }
                        }
                    }
                    else {
                        
                        $response->status = "Failure";
                        $response->mysql_message = mysql_error();
                    }
                    
                } 
                else {
                    
                    $response->status = "Failure";
                    $response->message = "There is no such order.";
                }
            } 
            else {
                
                $response->status = "Failure";
                $response->mysql_message = mysql_error();
            }
        } 
        else {
            
            $response->status = "Failure";
            $response->message = "There is no such user.";
        }
    }
    else {
        
        $response->status = "Failure";
        $response->mysql_message = mysql_error();
    }
}
else {
    
    $response->status = "Failure";
    $response->message = "Payment data is not set/complete.";
}
echo json_encode($response, JSON_UNESCAPED_SLASHES);

?>	
