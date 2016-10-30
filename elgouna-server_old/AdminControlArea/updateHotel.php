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
$sql="update hotels  set name='$name',location='$location',latitude='$latitude',longitude='$longitude',bookingLink='$bookingLink',ratingStar='$rating',offerExists='$offerExists',descrip='$descrip',offerDescription='$offerDescription',offerTitle='$offerTitle',isPoolAvailable='$isPoolAvailable',isGymAvailable='$isGymAvailable',isWifiAvailable='$isWifiAvailable',isVisaPaymentAvailable='$isVisaPaymentAvailable',isDiningInAvailable='$isDiningInAvailable',accomadtionType='$accomadtionType',elgounaVoice='$elgounaVoice',email='$email',phoneNumber='$phoneNumber',info='$info',facebookLink='$facebookLink',twitterLink='$twitterLink',instagramLink='$instagramLink',youtubeLink='$youtubeLink',virtualTourLink='$virtualTourLink',ord='$_POST[ord]',pid='$_POST[pid]' where id='$_GET[id]'";
$r=mysql_query($sql);
$insertedId=$_GET['id'];
$sql_s="select * from services where hidden=0 order by ord asc";
					  $r_s=mysql_query($sql_s);
					  $d=0;
					  while($row_s=mysql_fetch_array($r_s)){$d++;
					  $n_ex=0;
					  	$sql_ex="select id from services_hotel where service_id='$row_s[id]' and hotel_id='$_GET[id]'";
						$r_ex=mysql_query($sql_ex);
						$n_ex=mysql_num_rows($r_ex);
						$row_ex=mysql_fetch_array($r_ex);
											  
					  $name="check".$row_s['id'];
					  if($_POST[$name]!='' && $n_ex==0){
					  	$sql_xx="insert into services_hotel values('','$row_s[id]','$insertedId')";
						$r_xx=mysql_query($sql_xx);
					  	}else if($_POST[$name]=='' && $n_ex!=0){
					  	$sql_xx="delete from services_hotel where id='$row_ex[id]'";
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
	

	
$sql_p="select * from hotels_img where hotel_id='$_GET[id]'";
$r_p=mysql_query($sql_p);
$z=0;
	 while($row_p=mysql_fetch_array($r_p)){$z++;
	 $sname="simgxx".$z;
		if($_FILES[$sname]['tmp_name']!=''  ){
		$info = getimagesize($_FILES[$sname]['tmp_name']);
	if ($info === FALSE) {
		header("location:hotels.php?pgid=".$_GET['pgid']."&fl=2");
	}else{

		$ext=$_FILES[$sname]['name'];
		$ext=explode(".",$ext);
		$photoId=$row_p['id'];
		$valy=$photoId;
		$name=$photoId.".".$ext[1];
		$sql3="update hotels_img set img='$name' where id='$photoId'";
		$r3=mysql_query($sql3);
		

			$dirName="../images/hotels";
			$uploadFile="$dirName/".$name;
			move_uploaded_file($_FILES[$sname]['tmp_name'], $uploadFile);


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


		}

}
}



 for($i=$z;$i<=9;$i++){
 $sname="simg".$i;
		if($_FILES[$sname]['tmp_name']!=''  ){

		$info = getimagesize($_FILES[$sname]['tmp_name']);
	if ($info === FALSE) {
		header("location:hotels.php?pgid=".$_GET['pgid']."&fl=2");
	}else{
		$ext=$_FILES[$sname]['name'];
		$ext=explode(".",$ext);
		$sql3="insert into hotels_img values('','$insertedId','')";
		$r3=mysql_query($sql3);
		$photoId=mysql_insert_id();
		$valy=$photoId;
		$name=$photoId.".".$ext[1];
		$sql3="update hotels_img set img='$name' where id='$photoId'";
		//echo $sql3;
		$r3=mysql_query($sql3);
		

			$dirName="../images/hotels";
			$uploadFile="$dirName/".$name;
			move_uploaded_file($_FILES[$sname]['tmp_name'], $uploadFile);


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