<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$sql="select rating,beach_id,approved from beach_review where id='$_POST[id]'";
$r=mysql_query($sql);
$row=mysql_fetch_array($r);
$rating=$row['rating'];


$sql="update beach_review set approved=1 where id='$_POST[id]'";
$r=mysql_query($sql);

if($row['approved']!=2){
	$s="select sum(rating) as xx from beach_review where beach_id='".$row['beach_id']."' and `approved`=1 ";
	$rr=mysql_query($s);
	$rowxx=mysql_fetch_array($rr);


	$s="select id as xx from beach_review where beach_id='".$row['beach_id']."' and `approved`=1 ";
	$rr=mysql_query($s);
	$nn=mysql_num_rows($rr);
	$avgRate=$rowxx['xx']/$nn;
	$avgRate=number_format($avgRate,1);

$sql="update beaches set reviewScore='$avgRate' where id='".$row['beach_id']."'";
$r=mysql_query($sql);

}
?>