<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$sql="select rating,hotel_id,approved from hotel_review where id='$_POST[id]'";
$r=mysql_query($sql);
$row=mysql_fetch_array($r);
$rating=$row['rating'];


$sql="update hotel_review set approved=2 where id='$_POST[id]'";
$r=mysql_query($sql);

if($row['approved']==1){
	$s="select sum(rating) as xx from hotel_review where hotel_id='".$row['hotel_id']."' and `approved`=1 and id <>'$_POST[id]'";
	$rr=mysql_query($s);
	$rowxx=mysql_fetch_array($rr);


	$s="select id as xx from hotel_review where hotel_id='".$row['hotel_id']."' and `approved`=1 and id <>'$_POST[id]'";
	$rr=mysql_query($s);
	$nn=mysql_num_rows($rr);
	$avgRate=$rowxx['xx']/$nn;
	$avgRate=number_format($avgRate,1);

$sql="update hotels set reviewScore='$avgRate' where id='".$row['hotel_id']."'";
$r=mysql_query($sql);

}
?>