<?php

include("db_conn.php");
//include("ehgizly_service.php");
$user_data_json = file_get_contents('php://input');
$user_data_json_object = json_decode($user_data_json);
$venue_username = $user_data_json_object->username;
$venue_pass = $user_data_json_object->password;
$response = new stdClass();
if(isset($venue_username, $venue_pass)) {
    
    $venue_username_sql = "select * "
        . "from venues "
        . "where venueUsername = '$venue_username'";
    $venue_username_query = mysql_query($venue_username_sql);
    if($venue_username_query) {

        $venue_username_rows = mysql_num_rows($venue_username_query);
        if($venue_username_rows > 0) {

            $venue_pass_sql = "select venuePass "
                    . "from venues "
                    . "where venueUsername = '$venue_username'";
            $venue_pass_query = mysql_query($venue_pass_sql);
            if($venue_pass_query) {

                $venue_pass_rows = mysql_num_rows($venue_pass_query);
                if($venue_pass_rows > 0) {

                    $venue_pass_arr = mysql_fetch_assoc($venue_pass_query);
                    $venue_pass_in_db = $venue_pass_arr['venuePass'];
                    if($venue_pass == $venue_pass_in_db) {

                        session_start();
                        $_SESSION['username'] = $venue_username;
                        $_SESSION['password'] = $venue_pass;
                        $response->status = "Success";
                        $response->message = "You have been logged in as " . $venue_username 
                                . ".";
                    }
                    else {

                        $response->status = "Failure";
                        $response->message = "Username and password do not match.";
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
    $response->message = "Username and/or password is/are not set.";
}
echo json_encode($response, JSON_UNESCAPED_SLASHES);

?>