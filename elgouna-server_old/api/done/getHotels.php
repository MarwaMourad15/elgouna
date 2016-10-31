<?php

include("db_conn.php");
include("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$limit = "20";
$start = isset($obj->lastId) && !empty($obj->lastId) ? $obj->lastId : 0;
$str = "";
if ($obj->query != "") {
    
    $str = " and name like '%" . $obj->query . "%' ";
}
$ord = '';
if ($obj != 0 && $obj->filterId != "") {
    
    $sql_o = "select * from hotel_filter where id='" . $obj->filterId . "'";
    $r_o = mysql_query($sql_o);
    if($r_o){
        
        $row_o = mysql_fetch_array($r_o);
        $ord = " " . $row_o['query'] . " ";
    }
} 
else {

 //   $ord = " order by id asc ";
	$ord = " order by ratingStar desc";
}
$sql = "select id as hotelId, "
        . "name,location,"
        . "longitude,"
        . "latitude,"
        . "bookingLink,"
        . "reviewScore,"
        . "ratingStar,"
        . "offerExists,"
        . "descrip,"
        . "offerDescription,"
        . "offerTitle,"
        . "isPoolAvailable,"
        . "isGymAvailable,"
        . "isWifiAvailable,"
        . "isVisaPaymentAvailable,"
        . "isDiningInAvailable,"
        . "accomadtionType,"
        . "elgounaVoice,"
        . "email,"
        . "phoneNumber,"
        . "info,"
        . "facebookLink,"
        . "twitterLink,"
        . "instagramLink,"
        . "youtubeLink from hotels "
        . "where id<>'' $str and hidden = 0 $ord limit $start, $limit";
$result = mysql_query($sql);
$rows = mysql_num_rows($result);
if ($rows != 0) {
        $count = $obj->lastId;
        while ($row = mysql_fetch_assoc($result)) {
            $count++;
            $sql_r = "select title from rate_range where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
            $r_r = mysql_query($sql_r);
            $row_r = mysql_fetch_array($r_r);
            $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
            if ($row['reviewScore'] == 0 || $row['reviewScore'] == '') {
                $reviewScoreFinal = '';
            }
            $isLiked = 0;
            if ($obj->userId != "") {
                $sql_like = "select id from user_hotel_like where user_id='" 
                        . $obj->userId . "' and  hotel_id='$row[hotelId]'";
                $r_like = mysql_query($sql_like);
                $n_like = mysql_num_rows($r_like);
                if ($n_like > 0) {
                    $isLiked = 1;
                }
            }
            $sql_im = "select img from hotels_img where hotel_id = '$row[hotelId]'";
            $r_im = mysql_query($sql_im);
            $img = array();
            while ($row_im = mysql_fetch_assoc($r_im)) {
                array_push($img, $row_im['img']);
            }
            $sql_im = "select services.id, services.title, img  from services join services_hotel on services_hotel.service_id = services.id where services_hotel.hotel_id = '$row[hotelId]'";
            $r_im = mysql_query($sql_im);
            $services = array();
            while ($row_im = mysql_fetch_assoc($r_im)) {
                $services[] = array("id" => $row_im['id'], "title" => $row_im['title'], 
                    "imageURL" => $row_im['img']);
            }
            $json['hotels'][] = array("recordId" => $count, "hotelId" => $row['hotelId'], 
                "name" => $row['name'], "location" => $row['location'], 
                "longitude" => $row['longitude'], "latitude" => $row['latitude'], "bookingLink" => $row['bookingLink'], 
                "reviewScore" => $reviewScoreFinal, "ratingStar" => $row['ratingStar'], 
                "offerExists" => $row['offerExists'], "isLiked" => $isLiked, 
                "gallery" => $img, "descrip" => $row['descrip'], 
                "offerTitle" => $row['offerTitle'], "offerDescription" => $row['offerDescription'], "services" => $services, "accomadtionType" => $row['accomadtionType'], "elgounaVoice" => $row['elgounaVoice'], "email" => $row['email'], "phoneNumber" => $row['phoneNumber'], "info" => $row['info'], "facebookLink" => $row['facebookLink'], "twitterLink" => $row['twitterLink'],  "instagramLink" => $row['instagramLink'],  "youtubeLink" => $row['youtubeLink']);
        }
    } else {  
        $json['hotels'] = array();
    }
echo json_encode($json);

?>
