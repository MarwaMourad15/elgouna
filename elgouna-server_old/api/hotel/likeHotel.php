<?php 

include("db_conn.php");
date_default_timezone_set('Africa/Cairo');
$currentDate = date("Y-m-d H:i:s");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s = "select id "
        . "from user_hotel_like "
        . "where user_id='" . $obj->userId . "' "
        . "and hotel_id = '" . $obj->hotelId . "'";
$r = mysql_query($s);
$n = mysql_num_rows($r);
if($n == 1) {  
    $json['status'] = '1';
} else {
    $sql = "insert into user_hotel_like "
            . "values ('','" . $obj->userId . "', "
            . "'" . $obj->hotelId . "', '$currentDate')";
    $r = mysql_query($sql);
    if($r){
        $json['status'] = '1';
    }
}
echo json_encode($json);

?>
