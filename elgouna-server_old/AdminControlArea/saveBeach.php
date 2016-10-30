<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
if(isset($_POST['name'],
        $_POST['type'],
        $_POST['location'],
        $_POST['descrip']) 
        && !empty($_POST['name']) 
        && !empty($_POST['type'])
        && !empty($_POST['location']) 
        && !empty($_POST['descrip'])){
    $order=mysql_real_escape_string($_POST['ord']);
    $name=mysql_real_escape_string($_POST['name']);
    $type=mysql_real_escape_string($_POST['type']);
    $location=mysql_real_escape_string($_POST['location']);
    $latitude=mysql_real_escape_string($_POST['latitude']);
    $longitude=mysql_real_escape_string($_POST['longitude']);
    $rating=mysql_real_escape_string($_POST['rating']);
    $descrip=mysql_real_escape_string($_POST['descrip']);
    $accomadtionType=mysql_real_escape_string($_POST['accomadtionType']);
    $offerExists=mysql_real_escape_string($_POST['offerExists']);
    $offerTitle=mysql_real_escape_string($_POST['offerTitle']);
    $offerDescription=mysql_real_escape_string($_POST['offerDescription']);
    $isPoolAvailable=mysql_real_escape_string($_POST['isPoolAvailable']);
    $isGymAvailable=mysql_real_escape_string($_POST['isGymAvailable']);
    $isWifiAvailable=mysql_real_escape_string($_POST['isWifiAvailable']);
    $isVisaPaymentAvailable=mysql_real_escape_string($_POST['isVisaPaymentAvailable']);
    $isDiningInAvailable=mysql_real_escape_string($_POST['isDiningInAvailable']);
    $elgounaVoice=mysql_real_escape_string($_POST['elgounaVoice']);
    $email=mysql_real_escape_string($_POST['email']);
    $phoneNumber=mysql_real_escape_string($_POST['phoneNumber']);
    $info=mysql_real_escape_string($_POST['info']);
    $facebookLink=mysql_real_escape_string($_POST['facebookLink']);
    $twitterLink=mysql_real_escape_string($_POST['twitterLink']);
    $instagramLink=mysql_real_escape_string($_POST['instagramLink']);
    $youtubeLink=mysql_real_escape_string($_POST['youtubeLink']);
    $sql="insert into beaches values('','$name', '$type', '$location','$longitude','$latitude','0','$rating','$offerExists','$descrip','$offerTitle','$offerDescription','$isPoolAvailable','$isGymAvailable','$isWifiAvailable','$isVisaPaymentAvailable','$isDiningInAvailable','$accomadtionType','$elgounaVoice','$email','$phoneNumber','$info','$facebookLink','$twitterLink','$instagramLink','$youtubeLink','$order','')";
    $r=mysql_query($sql);
    if($r){
        $insertedId=mysql_insert_id();
        echo $insertedId;
        for($i=1;$i<=10;$i++){
            $simg="simg".$i;
            if($_FILES[$simg]['tmp_name']!=''){
                $info = getimagesize($_FILES[$simg]['tmp_name']);
                if ($info === FALSE) {
                    echo 'file problem.';
    		header("location:beaches.php?pgid=0&fl=2");
                }
                else{
                    $sql_p="insert into beaches_img values('','".$insertedId."','') ";
                    $r_p=mysql_query($sql_p);
                    if($r_p){
                        $insertedIdPhoto=mysql_insert_id();
                        $ext=$_FILES[$simg]['name'];
                        $ext=explode(".",$ext);
                        $valy=$insertedIdPhoto;
                        $name=$insertedIdPhoto.".".$ext[1];
                        $dirName="../images/beaches";
                        $uploadFile="$dirName/".$name;
                        move_uploaded_file($_FILES[$simg]['tmp_name'], $uploadFile);
                    }
                    else{
                        echo mysql_error();
                    }
                    $filename = $uploadFile;
    // Content type
    //header('Content-Type: image/jpeg');
    //
    //// Get new sizes
    //list($width, $height) = getimagesize($filename);
    //$newwidth = '960';
    //$newheight = '630';
    //
    //// Load
    //$thumb = imagecreatetruecolor($newwidth, $newheight);
    //$source = imagecreatefromjpeg($filename);
    //
    //// Resize
    //imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    //
    //imagejpeg($thumb,$filename,100); //file name also indicates the folder where to save it to
    //imagedestroy($thumb);
                    $sql_p="update beaches_img set img='".$name."' where id='".$insertedIdPhoto."' ";
                    $r_p=mysql_query($sql_p);
                    if($r_p) {
                        echo 'images query success';
                        header("location:beaches.php?pgid=0&fl=1");
                    }
                    else {
                        echo 'images failure';
                    }
                }
            }
        }
    }
    else{
        echo mysql_error();
    	header("location:beaches.php?pgid=0&fl=2");
    }
}
else {
    echo 'things not set.';
	header("location:beaches.php?pgid=0&fl=2");
}

?>