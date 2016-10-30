<?php 

session_start();
include("check_session.php");
include("../db_conn.php");
if(isset($_POST['venue_id'])) {
    $venue_id = $_POST['venue_id'];
    $delete_venue_sql = "delete from venues "
            . "where id = '$venue_id'";
    $delete_venue_query = mysql_query($delete_venue_sql);
    if(!$delete_venue_query) {
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