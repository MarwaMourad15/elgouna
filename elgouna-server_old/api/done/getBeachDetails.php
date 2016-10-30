<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s = "select id as beachId, "
        . "name,"
        . "type,"
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
        . "youtubeLink from "
        . "beaches "
        . "where id='" . $obj->beachId . "'";

$r = mysql_query($s);
$n = mysql_num_rows($r);
while($row = mysql_fetch_assoc($r)){
    $sql_r = "select title "
            . "from rate_range "
            . "where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
    $r_r = mysql_query($conn, $sql_r);
    $row_r = mysql_fetch_array($r_r);
    $reviewScoreFinal=$row_r['title']." (".$row['reviewScore'].")";
    if($row['reviewScore']==0 || $row['reviewScore']==''){
        
        $reviewScoreFinal='';
    }
    $isLiked = 0;
    if($obj->userId != "") {

        $sql_like="select id from user_beach_like where user_id='".$obj->userId."' and  beach_id='$row[beachId]'";
        $r_like = mysql_query($sql_like);
        $n_like = mysql_num_rows($r_like);
        if($n_like > 0){
            $isLiked=1;
        }
    }			
    $sql_im = "select img "
            . "from beaches_img "
            . "where beach_id = '$row[beachId]'";
    $r_im = mysql_query($sql_im);
    $img = array();		
    while($row_im = mysql_fetch_assoc($r_im)) {
        array_push($img,$row_im['img']);
    }
    $json['beachDetails'] = array(
        "beachId" => $row['beachId'],
        "name" => $row['name'],
        "type" => $row['type'],
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
        "youtubeLink" => $row['youtubeLink']);
}
echo json_encode($json);


?>
