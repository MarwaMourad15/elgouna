<?php

include("../AdminControlArea/db_conn.php");
if(isset($_POST['uid'], $_POST['pass']) 
        && !empty($_POST['uid']) 
        && !empty($_POST['pass'])) {
    $user_id = $_POST['uid'];
    $new_pass = $_POST['pass'];
    $user_query = mysql_query("select * "
            . "from users "
            . "where id = '$user_id'");
    if($user_query) {
        $user_row = mysql_num_rows($user_query);
        if($user_row > 0) {
            $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $new_pass_save_query = mysql_query("update users "
                    . "set userAuth = '$new_pass' "
                    . "where id = '$user_id'");
            if($new_pass_save_query) {
                echo 'password changed.';
            }
            else {
                echo mysql_error();
            }
        }
        else {
            echo 'no such user.';
        }
    }
    else {
        echo mysql_error();
    }
}
else {
    echo 'password data is not set.';
}

?>