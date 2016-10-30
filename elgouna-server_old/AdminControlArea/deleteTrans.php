<?php 

session_start();
include("check_session.php");
include("../db_conn.php");
if(isset($_POST['trans_id'])) {
    $trans_id = $_POST['trans_id'];
    $delete_trans_query = mysql_query("delete from transportation "
            . "where id = '$trans_id'");
    if(!$delete_trans_query) {
        echo mysql_error();
    }
    else {
        echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
}
else {
    echo 'venue id is not set';
}

?>