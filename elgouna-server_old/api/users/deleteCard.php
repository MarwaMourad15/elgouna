<?php

include("db_conn.php");
//include("check_session.php");
$card_to_be_deleted_json = file_get_contents('php://input');
$card_to_be_deleted_object = json_decode($card_to_be_deleted_json);
$response = new stdClass();
if(isset($card_to_be_deleted_object->card_id)) {
    
    $card_id = $card_to_be_deleted_object->card_id;
    $card_sql = "select * "
            . "from `user-card` "
            . "where id = '$card_id'";
    $card_query = mysql_query($card_sql);
    if($card_query) {
        
        $card_row = mysql_num_rows($card_query);
        if($card_row > 0) {
            
            $card_ending_with = $card_row[3];
            $delete_card_sql = "delete from `user-card` "
                    . "where id = '$card_id'";
            $delete_card_query = mysql_query($delete_card_sql);
            if($delete_card_query) {
                
                $response->status = "Success";
                $response->message = "Card **** **** **** " . $card_ending_with 
                        . " has been deleted.";
            } 
            else {
                
                $response->status = "Failure";
                $response->message = "Card **** **** **** " . $card_number 
                        . " could not be deleted. Please try again.";
                $respone->mysql_message = mysql_error();
            }
        } 
        else {
            
            $response->status = "Failure";
            $response->message = "There is no such card.";
        }
    }
    else {
        
        $response->status = "Failure";
        $respone->mysql_message = mysql_error();
    }
}
else {
    
    $response->status = "Failure";
    $response->message = "Card data is not set/complete.";
}
echo json_encode($response, JSON_UNESCAPED_SLASHES);

?>	
