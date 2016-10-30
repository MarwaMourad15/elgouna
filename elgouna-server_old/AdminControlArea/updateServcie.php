<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
if(isset($_POST['name']) && !empty($_POST['name'])){

$name=mysql_real_escape_string($_POST['name']);
$sql="update services set title='$name' where id='$_GET[id]'";
$r=mysql_query($sql);
$insertedId=$_GET['id'];

	if($_FILES["simg"]['tmp_name']!=''){
		$info = getimagesize($_FILES["simg"]['tmp_name']);
	if ($info === FALSE) {
		header("location:services.php?pgid=0&fl=2");
	}else{

		$ext=$_FILES["simg"]['name'];
		$ext=explode(".",$ext);
		$valy=$insertedId;
		$name=$insertedId.".".$ext[1];
			$dirName="../images/services";
			$uploadFile="$dirName/".$name;
			move_uploaded_file($_FILES["simg"]['tmp_name'], $uploadFile);
			
			$sql_p="update servcies set img='".$name."' where id='".$insertedId."' ";
			$r_p=mysql_query($sql_p);
		}
		
}
	

	

	
	if($r){
			
	header("location:services.php?pgid=0&fl=1");
	
	}else{
	header("location:services.php?pgid=0&fl=2");
	}

}else{
	header("location:services.php?pgid=0&fl=2");
}
?>