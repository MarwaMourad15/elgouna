<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
if(isset($_POST['name'],$_POST['rating'],$_POST['location'],$_POST['descrip']) && !empty($_POST['name']) && !empty($_POST['rating'])&& !empty($_POST['location']) &&   !empty($_POST['descrip'])){
$name=mysql_real_escape_string($_POST['name']);
$offerTitle=mysql_real_escape_string($_POST['offerTitle']);
$rating=mysql_real_escape_string($_POST['rating']);
$location=mysql_real_escape_string($_POST['location']);
$latitude=mysql_real_escape_string($_POST['latitude']);
$bookingLink=mysql_real_escape_string($_POST['booking-url']);
$longitude=mysql_real_escape_string($_POST['longitude']);
$rating=mysql_real_escape_string($_POST['rating']);
$descrip=mysql_real_escape_string($_POST['descrip']);
$offerExists=mysql_real_escape_string($_POST['offerExists']);
$offerDescription=mysql_real_escape_string($_POST['offerDescription']);
$isPoolAvailable=mysql_real_escape_string($_POST['isPoolAvailable']);
$isGymAvailable=mysql_real_escape_string($_POST['isGymAvailable']);
$isWifiAvailable=mysql_real_escape_string($_POST['isWifiAvailable']);
$isVisaPaymentAvailable=mysql_real_escape_string($_POST['isVisaPaymentAvailable']);
$isDiningInAvailable=mysql_real_escape_string($_POST['isDiningInAvailable']);
$accomadtionType=mysql_real_escape_string($_POST['accomadtionType']);
$elgounaVoice=mysql_real_escape_string($_POST['elgounaVoice']);
$email=mysql_real_escape_string($_POST['email']);
$phoneNumber=mysql_real_escape_string($_POST['phoneNumber']);
$info=mysql_real_escape_string($_POST['info']);
$facebookLink=mysql_real_escape_string($_POST['facebookLink']);
$twitterLink=mysql_real_escape_string($_POST['twitterLink']);
$instagramLink=mysql_real_escape_string($_POST['instagramLink']);
$youtubeLink=mysql_real_escape_string($_POST['youtubeLink']);
$virtualTourLink=mysql_real_escape_string($_POST['vtour']);
$sql="insert into hotels values('','$name','$location','$longitude','$latitude','0','$rating','$offerExists','$descrip','$offerTitle','$offerDescription','$isPoolAvailable','$isGymAvailable','$isWifiAvailable','$isVisaPaymentAvailable','$isDiningInAvailable','$accomadtionType','$elgounaVoice','$email','$phoneNumber','$info','$facebookLink','$twitterLink','$instagramLink','$youtubeLink','$virtualTourLink','$_POST[pid]','$_POST[ord]','')";
$r=mysql_query($sql);
$insertedId=mysql_insert_id();


$sql_s="select * from services where hidden=0 order by ord asc";
					  $r_s=mysql_query($sql_s);
					  $d=0;
					  while($row_s=mysql_fetch_array($r_s)){$d++;
					  
					  $name="check".$row_s['id'];
					  if($_POST[$name]!=''){
					  	$sql_xx="insert into services_hotel values('','$row_s[id]','$insertedId')";
						$r_xx=mysql_query($sql_xx);
					  }
					  }




	for($i=1;$i<=10;$i++){
	$simg="simg".$i;
	if($_FILES[$simg]['tmp_name']!=''){
		$info = getimagesize($_FILES[$simg]['tmp_name']);
	if ($info === FALSE) {
		header("location:hotels.php?pgid=0&fl=2");
	}else{

			$sql_p="insert into hotels_img values('','".$insertedId."','') ";
			$r_p=mysql_query($sql_p);
			$insertedIdPhoto=mysql_insert_id();
		$ext=$_FILES[$simg]['name'];
		$ext=explode(".",$ext);
		$valy=$insertedIdPhoto;
		$name=$insertedIdPhoto.".".$ext[1];
			$dirName="../images/hotels";
			$uploadFile="$dirName/".$name;
			move_uploaded_file($_FILES[$simg]['tmp_name'], $uploadFile);
			
$filename = $uploadFile;
// Content type
header('Content-Type: image/jpeg');

// Get new sizes
list($width, $height) = getimagesize($filename);
$newwidth = '960';
$newheight = '630';

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($thumb,$filename,100); //file name also indicates the folder where to save it to
imagedestroy($thumb);


			$sql_p="update hotels_img set img='".$name."' where id='".$insertedIdPhoto."' ";
			$r_p=mysql_query($sql_p);
		}
		}

}
	

	

	
	if($r){
			
	header("location:hotels.php?pgid=0&fl=1");
	
	}else{
	header("location:hotels.php?pgid=0&fl=2");
	}

}else{
	header("location:hotels.php?pgid=0&fl=2");
}
?>