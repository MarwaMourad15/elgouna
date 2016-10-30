<?php 

//include("check_session.php");
include("../db_conn.php");
if(isset($_POST['image_id']) 
        && isset($_POST['image_file'])) {
    
    $image_id = $_POST['image_id'];
    $image_file = $_POST['image_file'];
    $venue_image_delete_sql = "delete from"
            . " venues_img"
            . " where id = '$image_id'";
    $venue_image_delete_query = mysql_query($venue_image_delete_sql);
    if($venue_image_delete_query) {
        
        if(file_exists($image_file)) {
            
            unlink('../images/venues/' . $image_file);
        }
        else {
            
            header("location: venues.php?pgid=0&fl=2");
        }
    }
    else {
        
        header("location: venues.php?pgid=0&fl=2");
    }
}
else {
    
    header("location: venues.php?pgid=0&fl=2");
}

?>