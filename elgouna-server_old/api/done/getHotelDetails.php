<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
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
        . "youtubeLink "
        . "from hotels "
        . "where id='" . $obj->hotelId . "'";
$r = mysql_query($s);
$n = mysql_num_rows($r);
    while($row = mysql_fetch_assoc($r)) {
        
        $sql_r="select title "
                . "from rate_range "
                . "where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
        $r_r = mysql_query($sql_r);
        $row_r = mysql_fetch_array($r_r);
        $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
        if($row['reviewScore'] == 0 || $row['reviewScore'] == '') {
            $reviewScoreFinal = '';
        }
        $isLiked = 0;
        if($obj->userId != "") {

            $sql_like="select id "
                    . "from user_hotel_like "
                    . "where user_id='" . $obj->userId . "' "
                    . "and hotel_id = '$row[hotelId]'";
            $r_like = mysql_query($sql_like);
            $n_like=mysql_num_rows($r_like);
            if($n_like > 0) {
                $isLiked = 1;
            }
        }			
        $sql_im = "select img "
                . "from hotels_img "
                . "where hotel_id = '$row[hotelId]'";
        $r_im = mysql_query($sql_im);
        $img = array();		
        while($row_im = mysql_fetch_assoc($r_im)) {
            array_push($img, $row_im['img']);
        }
        $sql_im = "select services.id, "
                . "services.title, "
                . "img from services,"
                . "services_hotel where services_hotel."
                . "hotel_id = '$row[hotelId]' and services_hotel.service_id=services.id";
        $r_im = mysql_query($sql_im);
        $services = array();		
        while($row_im = mysql_fetch_assoc($r_im)) {
            
            $services[] = array(
                "id" => $row_im['id'],
                "title" => $row_im['title'],
                "imageURL" => $row_im['img']
            );
        }
        $json['hotelDetails'] = array(
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
            "offerTitle" => $row['offerTitle'],
            "offerDescription" => $row['offerDescription'],
            "services" => $services,
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
