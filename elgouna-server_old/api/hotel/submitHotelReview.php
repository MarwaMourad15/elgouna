<?php 
include("db_conn.php");
date_default_timezone_set('Africa/Cairo');
$currentDate=date("Y-m-d H:i:s");
$rawPostData = file_get_contents('php://input',r);
$obj = json_decode($rawPostData);
$json = array();
	$review=mysql_real_escape_string($obj->{'review'});

	$sql="insert  into hotel_review values ('','".$obj->{'hotelId'}."','".$obj->{'userId'}."','$review','".$obj->{'rating'}."','$currentDate','')";
	$r=mysql_query($sql);
	
	$s="select sum(rating) as xx from hotel_review where hotel_id='".$obj->{'hotelId'}."' and `approved`=1";
	$rr=mysql_query($s);
	$row=mysql_fetch_array($rr);

	$s="select id as xx from hotel_review where hotel_id='".$obj->{'hotelId'}."' and `approved`=1";
	$rr=mysql_query($s);
	$nn=mysql_num_rows($rr);
	$avgRate=$row['xx']/$nn;
	$avgRate=number_format($avgRate,1);

$sql="update hotels set reviewScore='$avgRate' where id='".$obj->{'hotelId'}."'";
$r=mysql_query($sql);

	if($r){
	$json['status']='1';
	}else{
	$json['status']='0';
	
	}
echo json_encode($json);
?>