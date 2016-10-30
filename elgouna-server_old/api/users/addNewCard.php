<?php

include("db_conn.php");
$card_to_be_added_json = file_get_contents('php://input');
$card_to_be_added_object = json_decode($card_to_be_added_json);
$response = new stdClass();
if(isset($card_to_be_added_object->user_id) 
        && isset($card_to_be_added_object->card_ending) 
        && isset($card_to_be_added_object->card_token)) {
    
    $user_id = $card_to_be_added_object->user_id;
    $user_sql = "select * "
            . "from users "
            . "where id = '$user_id'";
    $user_query = mysql_query($user_sql);
    if($user_query) {
        
        $user_rows = mysql_num_rows($user_query);
        if($user_rows > 0) {
            
            $card_ending_with = $card_to_be_added_object->card_ending;
            $adding_date = date("Y-m-d");
            $card_token = $card_to_be_added_object->card_token;
            $success = false;
            $add_card_sql = "insert into `user-card` "
                    . "values ('', "
                    . "'$user_id', "
                    . "'$card_ending_with', "
                    . "'$adding_date', "
                    . "'$card_token')";
            $add_card_query = mysql_query($add_card_sql);
            if($add_card_query) {
                $insertedId = mysql_insert_id();
                $response->status = "Success";
                $response->card = new stdClass();
                $response->card->id = $insertedId;
                $response->card->paymob_token = $card_token;
                $response->card->card_ending_with = $card_ending_with;
                $response->card->adding_date = $adding_date;
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
    $response->message = "Card data is not set/complete.";
}
echo json_encode($response, JSON_UNESCAPED_SLASHES);


?>	
