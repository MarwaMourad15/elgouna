<?php

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$str = "";
if($obj->keyword != "") {
    $str .= " and name like '%" . $obj->keyword . "%' ";
}
if(!empty($obj->type) || $obj->type != "") {
    $str .= " and type = '$obj->type'";
}
$ord = " order by ord asc ";
$s = "select id, "
        . "venueUsername, "
        . "venuePass, "
        . "name, "
        . "type, "
        . "location, "
        . "longitude, "
        . "latitude, "
        . "reviewScore, "
        . "ratingStar, "
        . "description, "
        . "offerCheck, "
        . "offerTitle, "
        . "offerDescription, "
        . "wifiCheck, "
        . "visaCheck, "
        . "diningCheck, "
        . "elgounaVoice, "
        . "email, "
        . "phoneNumber, "
        . "info, "
        . "facebookLink, "
        . "twitterLink, "
        . "instagramLink, "
        . "youtubeLink ,"
        . "merchant_id, "
        . "secure_hash "
        . "from venues "
        . "where id != 0 " 
        . $str 
        . $ord;
$r = mysql_query($s);
if(!$r) echo mysql_error();
$n = mysql_num_rows($r);
if($n != 0) {
    while($row = mysql_fetch_assoc($r)){
        $sql_im = "select img "
                . "from venues_img "
                . "where venue_id='" . $row['id'] . "'";
        $r_im = mysql_query($sql_im);
        $imgs = array();		
        while($row_im = mysql_fetch_assoc($r_im)) {
            array_push($imgs, $row_im['img']);
        }
        $json['venues'][] = array(
            "id"                => $row['id'],
            "username"          => $row['venueUsername'],
            "pass"              => $row['venuePass'],
            "name"              => $row['name'],
            "type"              => $row['type'],
            "location"          => $row['location'],
            "longitude"         => $row['longitude'],
            "latitude"          => $row['latitude'],
            "review-score"      => $row['reviewScore'],
            "rating-star"       => $row['ratingStar'],
            "description"       => $row['description'],
            "offer-check"       => $row['offerCheck'],
            "offer-title"       => $row['offerTitle'],
            "offer-description" => $row['offerDescription'], 
            "wifi-check"        => $row['wifiCheck'], 
            "visa-check"        => $row['visaCheck'], 
            "dining-check"      => $row['diningCheck'], 
            "elgouna-voice"     => $row['elgounaVoice'],
            "email"             => $row['email'],
            "phoneNumber"       => $row['phoneNumber'],
            "info"              => $row['info'],
            "facebookLink"      => $row['facebookLink'],
            "twitterLink"       => $row['twitterLink'],
            "instagramLink"     => $row['instagramLink'],
            "youtubeLink"       => $row['youtubeLink'],
            "merchant-id"       => $row['merchant_id'],
            "secure-hash"       => $row['secure_hash'],
            "images"            => $imgs
        );
    }
} 
else {
    $json['venues'] = array();
}
echo json_encode($json);

?>
