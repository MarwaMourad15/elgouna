<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
session_start();
include("db_conn.php");
//include("check_session.php");
$venue_info = array();
$venue_id_json = file_get_contents('php://input');
$venue_id_object = json_decode($venue_id_json);

if(isset($venue_id_object->venue_id)) {
    
    $venue_id = $venue_id_object->venue_id;
    $venue_id_query = mysql_query("select `venues_img`.`img` as venueImg, "
            . "`venues`.`name` as venueName "
            . "from `venues_img` join `venues` "
            . "on `venues_img`.`venue_id` = `venues`.`id` "
            . "where `venues_img`.`venue_id` = '$venue_id' "
            . "order by `venues_img`.`id` asc "
            . "limit 1");
    if($venue_id_query) {
        
        $venue_row = mysql_num_rows($venue_id_query);
        if($venue_row > 0) {
            
            $url = 'http://localhost/elgouna/images/venues/';
            $venue_arr = mysql_fetch_assoc($venue_id_query);
            $venue_img = $venue_arr['venueImg'];
            $venue_info['logo'] = $url . $venue_img;
            $venue_info['name'] = $venue_arr['venueName'];
        }
        else {
            
            die('There is no such venue.');
        }
    }
    else {
        
        die(mysql_error());
    }
}
else {
    
    die('Venue id is not set.');
}

echo json_encode($venue_info, JSON_UNESCAPED_SLASHES);

?>	
