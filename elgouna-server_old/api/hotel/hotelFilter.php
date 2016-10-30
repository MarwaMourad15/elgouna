<?php

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$str = '';
if ($obj->keyword != "") {
    $str .= " and name like '%" . $obj->keyword . "%' ";
}
if (!empty($obj->ratingStar) || $obj->ratingStar == '0') {
    $str .= " and ratingStar = '" . $obj->ratingStar . "' ";
}

if($obj->{'servicesIds'}!=""){
	$s_s="select hotel_id from services_hotel where service_id in(".$obj->{'servicesIds'}.") group by hotel_id";
		$r_s=mysql_query($sql_s);
		$ids='';
		while($row_s=mysql_fetch_array($r_s)){
		$ids.=$row_s['hotel_id'].',';
		}
		$ids=substr($ids,0,-1);
		if($ids!=''){
$str.=" and id in (".$ids.") ";
}}

$ord=" order by ord asc ";
$s="select id as hotelId, name,location,longitude,latitude,reviewScore,ratingStar,offerExists,descrip,offerDescription,offerTitle,isPoolAvailable,isGymAvailable,isWifiAvailable,isVisaPaymentAvailable,isDiningInAvailable,accomadtionType,elgounaVoice,email,phoneNumber,info,facebookLink,twitterLink,instagramLink,youtubeLink from hotels where id != 0 and hidden=0 ". $str ." ". $ord ;
$r=mysql_query($s);
if(!$r) echo mysql_error();
$n=0;
$n=mysql_num_rows($r);
	if($n!=0){
		$count=$obj->{'lastId'};
			while($row=mysql_fetch_assoc($r)){
			$count++;
			$sql_r="select title from rate_range where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
			$r_r=mysql_query($sql_r);
			$row_r=mysql_fetch_array($r_r);
			if($row_r['title'] == 'Poor'){
	                        $reviewScoreFinal="--";				
			}else{
	                        $reviewScoreFinal=$row_r['title']." (".$row['reviewScore'].")";
			}
			
			$isLiked=0;
if($obj->{'userId'}!=""){

$sql_like="select id from user_hotel_like where user_id='".$obj->{'userId'}."' and  hotel_id='$row[hotelId]'";
			$r_like=mysql_query($sql_like);
			$n_like=mysql_num_rows($r_like);
			if($n_like>0){
			$isLiked=1;
			}

}			
			$sql_im="select img from hotels_img where hotel_id='$row[hotelId]'";
			$r_im=mysql_query($sql_im);
			$img=array();		
			while($row_im=mysql_fetch_assoc($r_im)){
				array_push($img,$row_im['img']);

			}

                     $sql_im="select services.id, services.title, img  from services,services_hotel where services_hotel.hotel_id=". $row[hotelId] ." and services_hotel.service_id=services.id";
                        $r_im=mysql_query($sql_im);
                        $services=array();
                        while($row_im=mysql_fetch_assoc($r_im)){
                                        $services[]=array("id"=>$row_im['id'],"title"=>$row_im['title'],"imageURL"=>$row_im['img']);

                        }
$json['hotels'][]=array("hotelId"=>$row['hotelId'],"name"=>$row['name'],"location"=>$row['location'],"longitude"=>$row['longitude'],"latitude"=>$row['latitude'],"reviewScore"=>$reviewScoreFinal,"ratingStar"=>$row['ratingStar'],"offerExists"=>$row['offerExists'],"isLiked"=>$isLiked,"gallery"=>$img,"descrip"=>$row['descrip'],"offerTitle"=>$row['offerTitle'],"offerDescription"=>$row['offerDescription'],"services"=>$services,"accomadtionType"=>$row['accomadtionType'],"elgounaVoice"=>$row['elgounaVoice'],"email"=>$row['email'],"phoneNumber"=>$row['phoneNumber'],"info"=>$row['info'],"facebookLink"=>$row['facebookLink'],"twitterLink"=>$row['twitterLink'],"instagramLink"=>$row['instagramLink'],"youtubeLink"=>$row['youtubeLink']);


            $sql_like = "select id "
                    . "from user_hotel_like "
                    . "where user_id='" . $obj->userId 
                    . "' and  hotel_id = '$row[hotelId]'";
            $r_like = mysql_query($sql_like);
            $n_like = mysql_num_rows($r_like);
            if ($n_like > 0) {
                
                $isLiked = 1;
            }
        }
        $sql_im = "select img "
                . "from hotels_img "
                . "where hotel_id = '$row[hotelId]'";
        $r_im = mysql_query($sql_im);
        $img = array();
        while ($row_im = mysql_fetch_assoc($r_im)) {
            
            array_push($img, $row_im['img']);
        }
        $sql_im = "select services.id, services.title "
                . "from services,"
                . "services_hotel "
                . "where services_hotel.hotel_id = '$row[hotelId]' "
                . "and services_hotel.service_id = services.id";
        $r_im = mysql_query($sql_im);
        $services = array();
        while ($row_im = mysql_fetch_assoc($r_im)) {
            $services[] = array(
                "id" => $row_im['id'], 
                "title" => $row_im['title']
            );
        }
    } else {
    
    $json['hotels'] = array();
}
echo json_encode($json, JSON_PRETTY_PRINT);

?>
