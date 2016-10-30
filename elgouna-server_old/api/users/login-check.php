<?php

include 'db_conn.php';

$data = json_decode(file_get_contents('php://input'));
    
$post_username = $data->username;

$post_pass = $data->password;

$sql_username = "select *"
        . " from venues"
        . " where venueUsername = '$post_username'";

$username_query = mysql_query($sql_username);
if($username_query) {
    
    $username_rows = mysql_num_rows($username_query);
    if($username_rows > 0) {
        
        $username_arr = mysql_fetch_array($username_query);
        $username = $username_arr[1];
        $sql_pass = "select venuePass"
                . " from venues"
                . " where venueUsername = '$username'";
        $pass_query = mysql_query($sql_pass);
        if($pass_query) {
            
            $pass_rows = mysql_num_rows($pass_query);
            if($pass_rows > 0) {
                
                $pass_arr = mysql_fetch_array($pass_query);
                $pass = $pass_arr[0];
                if($post_pass == $pass) {
                    
                    session_start();
                    $_SESSION['venueUser'] = $username;
                    $_SESSION['venuePass'] = $pass;
                    echo "You have been successfully logged in.";
                    session_unset('venueUser');
                    session_unset('venuePass');
                    session_destroy();
                }
            }
            else {
                echo "No such password.";
            }
        }
    }
    else {
        echo "No such username.";
    }
}
else {
    echo "Error: " . $sql_username . "<br>" . mysql_error($conn);
}

mysql_close($conn);

?>
