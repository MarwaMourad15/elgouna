<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$limit = "5";
$start=$obj->lastId;
$str = '';
if($obj['query'] != "") {
    
    $str = " and name like '%" . $obj->query . "%'";
}
$ord = '';
if($obj->filterId != 0 && $obj->filterId != '') {
    
    $sql_o = "select * "
            . "from hotel_filter "
            . "where id = '" . $obj->filterId . "'";
    $r_o = mysqli_query($conn, $sql_o);
    $row_o = mysqli_fetch_array($r_o);
    $ord = " " . $row_o['query'] . " ";
}
else {
    
    $ord = " order by id asc ";
}
$s = "select id as hotelId, "
        . "name,"
        . "location,"
        . "longitude,"
        . "latitude,"
        . "reviewScore,"
        . "ratingStar,"
        . "offerExists,"
        . "descrip,"
        . "offerDescription,"
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
        . "youtubeLink "
        . "from hotels "
        . "where id<>'' $str and hidden=0 $ord limit $start, $limit";

$r = mysqli_query($conn, $s);
$n = mysqli_num_rows($r);
$count=$obj->lastId;
while($row = mysqli_fetch_assoc($r)) {
    
    $count++;
    $sql_r = "select title "
            . "from rate_range "
            . "where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
    $r_r = mysqli_query($conn, $sql_r);
    $row_r = mysqli_fetch_array($r_r);
    $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
    $isLiked = 0;
    if($obj['userId'] != "") {

        $sql_like = "select id "
                . "from user_hotel_like "
                . "where user_id = '" . $obj->lastId . "' "
                . "and hotel_id ='$row[hotelId]'";
        $r_like = mysqli_query($conn, $sql_like);
        $n_like = mysqli_num_rows($r_like);
        if($n_like > 0) {
            $isLiked=1;
        }
    }			
    $sql_im = "select img "
            . "from holtels_img "
            . "where hotel_id='$row[hotelId]'";
    $r_im = mysqli_query($conn, $sql_im);
    $img = array();		
    while($row_im = mysqli_fetch_assoc($r_im)){
        
        array_push($img, $row_im['img']);
    }
    $json['hotels'][] = array(
        "recordId" => $count,
        "hotelId" => $row['hotelId'],
        "name" => $row['name'],
        "location" => $row['location'],
        "longitude" => $row['longitude'],
        "latitude" => $row['latitude'],
        "reviewScore" => $reviewScoreFinal,
        "ratingStar" => $row['ratingStar'],
        "offerExists" => $row['offerExists'],
        "isLiked" => $isLiked,
        "gallery" => $img,
        "descrip" => $row['descrip'],
        "offerDescription" => $row['offerDescription'],
        "isPoolAvailable" => $row['isPoolAvailable'],
        "isGymAvailable" => $row['isGymAvailable'],
        "isWifiAvailable" => $row['isWifiAvailable'],
        "isVisaPaymentAvailable" => $row['isVisaPaymentAvailable'],
        "isDiningInAvailable" => $row['isDiningInAvailable'],
        "accomadtionType" => $row['accomadtionType'],
        "elgounaVoice" => $row['elgounaVoice'],
        "email" => $row['email'],
        "phoneNumber" => $row['phoneNumber'],
        "info" => $row['info'],
        "facebookLink" => $row['facebookLink'],
        "twitterLink" => $row['twitterLink'],
        "instagramLink" => $row['instagramLink'],
        "youtubeLink" => $row['youtubeLink']
    );
}
echo json_encode($json);

?>