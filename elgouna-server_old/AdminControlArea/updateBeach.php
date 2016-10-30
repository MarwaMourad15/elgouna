<?php

session_start();
include("check_session.php");
include("../db_conn.php");
if (isset($_POST['name'], $_POST['rating'], $_POST['location'], $_POST['descrip']) && !empty($_POST['name']) && !empty($_POST['rating']) && !empty($_POST['location']) && !empty($_POST['descrip'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $type = mysql_real_escape_string($_POST['type']);
    $offerTitle = mysql_real_escape_string($_POST['offerTitle']);
    $rating = mysql_real_escape_string($_POST['rating']);
    $location = mysql_real_escape_string($_POST['location']);
    $latitude = mysql_real_escape_string($_POST['latitude']);
    $longitude = mysql_real_escape_string($_POST['longitude']);
    $rating = mysql_real_escape_string($_POST['rating']);
    $descrip = mysql_real_escape_string(str_replace("'", '`', $_POST['descrip']));
    $offerExists = mysql_real_escape_string($_POST['offerExists']);
    $offerDescription = mysql_real_escape_string(str_replace("'", '`', $_POST['offerDescription']));
    $isPoolAvailable = mysql_real_escape_string($_POST['isPoolAvailable']);
    $isGymAvailable = mysql_real_escape_string($_POST['isGymAvailable']);
    $isWifiAvailable = mysql_real_escape_string($_POST['isWifiAvailable']);
    $isVisaPaymentAvailable = mysql_real_escape_string($_POST['isVisaPaymentAvailable']);
    $isDiningInAvailable = mysql_real_escape_string($_POST['isDiningInAvailable']);
    $accomadtionType = mysql_real_escape_string(str_replace("'", '`', $_POST['accomadtionType']));
    $elgounaVoice = mysql_real_escape_string($_POST['elgounaVoice']);
    $email = mysql_real_escape_string($_POST['email']);
    $phoneNumber = mysql_real_escape_string($_POST['phoneNumber']);
    $info = mysql_real_escape_string($_POST['info']);
    $facebookLink = mysql_real_escape_string($_POST['facebookLink']);
    $twitterLink = mysql_real_escape_string($_POST['twitterLink']);
    $instagramLink = mysql_real_escape_string($_POST['instagramLink']);
    $youtubeLink = mysql_real_escape_string($_POST['youtubeLink']);
    $sql = "update beaches set name='$name', type='$type', location='$location',latitude='$latitude',longitude='$longitude',ratingStar='$rating',offerExists='$offerExists',offerTitle='$offerTitle',descrip='$descrip',offerDescription='$offerDescription',isPoolAvailable='$isPoolAvailable',isGymAvailable='$isGymAvailable',isWifiAvailable='$isWifiAvailable',isVisaPaymentAvailable='$isVisaPaymentAvailable',isDiningInAvailable='$isDiningInAvailable',accomadtionType='$accomadtionType',elgounaVoice='$elgounaVoice',email='$email',phoneNumber='$phoneNumber',info='$info',facebookLink='$facebookLink',twitterLink='$twitterLink',instagramLink='$instagramLink',youtubeLink='$youtubeLink',ord='$_POST[ord]' where id='$_GET[id]'";
    $r = mysql_query($sql);
    if ($r) {
        $insertedId = $_GET['id'];
        $sql_p = "select * from beaches_img where beach_id='$_GET[id]'";
        $r_p = mysql_query($sql_p);
        $z = 0;
        while ($row_p = mysql_fetch_array($r_p)) {
            $z++;
            $sname = "simgxx" . $z;
            var_dump($_FILES[$sname]);
            if ($_FILES[$sname]['tmp_name'] != '') {
                echo '000<br>';
                $info = getimagesize($_FILES[$sname]['tmp_name']);
                if ($info === FALSE) {
                    header("location:beaches.php?pgid=" . $_GET['pgid'] . "&fl=2");
                } else {
                    echo '000       k<br>';
                    $ext = $_FILES[$sname]['name'];
                    echo $ext . '<br>';
                    $ext = explode(".", $ext);
                    $photoId = $row_p['id'];
                    echo $photoId . '<br>';
                    $valy = $photoId;
                    $name = $photoId . "." . $ext[1];
                    $sql3 = "update beaches_img set img='$name' where id='$photoId'";
                    $r3 = mysql_query($sql3);
                    if (!$r3) {
                        echo mysql_error() . '<br>';
                    } else {
                        echo 'query success';
                        $dirName = "../images/beaches";
                        $uploadFile = "$dirName/" . $name;
                        echo $uploadFile . '<br>';
                        $upload_attempt = move_uploaded_file($_FILES[$sname]['tmp_name'], $uploadFile);
                        echo $_FILES[$sname]['tmp_name'] . '<br>';
                        if (!$upload_attempt) {
                            header("location:beaches.php?pgid=" . $_GET['pgid'] . "&fl=2");
                            echo 'failure 10<br>';
                        } else {
                            echo 'success 10<br>';
                            $filename = $uploadFile;
                            // Content type
                            //header('Content-Type: image/jpeg');
                            // Get new sizes
                            list($width, $height) = getimagesize($filename);
                            $newwidth = '960';
                            $newheight = '630';
                            // Load
                            $thumb = imagecreatetruecolor($newwidth, $newheight);
                            $source = imagecreatefromjpeg($filename);
                            // Resize
                            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                            imagejpeg($thumb, $filename, 100); //file name also indicates the folder where to save it to
                            imagedestroy($thumb);
                        }
                    }
                }
            }
        }
        for ($i = $z; $i <= 9; $i++) {
            $sname = "simg" . $i;
            if ($_FILES[$sname]['tmp_name'] != '') {
                $info = getimagesize($_FILES[$sname]['tmp_name']);
                if ($info === FALSE) {
                    header("location:beaches.php?pgid=" . $_GET['pgid'] . "&fl=2");
                } else {
                    $ext = $_FILES[$sname]['name'];
                    $ext = explode(".", $ext);
                    $sql3 = "insert into beaches_img values('','$insertedId','')";
                    $r3 = mysql_query($sql3);
                    $photoId = mysql_insert_id();
                    $valy = $photoId;
                    $name = $photoId . "." . $ext[1];
                    $sql3 = "update beaches_img set img='$name' where id='$photoId'";
                    //echo $sql3;
                    $r3 = mysql_query($sql3);
                    $dirName = "../images/beaches";
                    $uploadFile = "$dirName/" . $name;
                    move_uploaded_file($_FILES[$sname]['tmp_name'], $uploadFile);
                    $filename = $uploadFile;
// Content type
//header('Content-Type: image/jpeg');
// Get new sizes
                    list($width, $height) = getimagesize($filename);
                    $newwidth = '960';
                    $newheight = '630';
//
//// Load
                    $thumb = imagecreatetruecolor($newwidth, $newheight);
                    $source = imagecreatefromjpeg($filename);
//
//// Resize
                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
//
                    imagejpeg($thumb, $filename, 100); //file name also indicates the folder where to save it to
                    imagedestroy($thumb);
                }
            }
        }
        header("location:beaches.php?pgid=0&fl=1");
//            echo 'sucsuc';
    } else {
        header("location:beaches.php?pgid=0&fl=2");
    }
} else {
    header("location:beaches.php?pgid=0&fl=2");
}
?>














<?php

//	for($i=1;$i<=10;$i++){
//	$simg="simg".$i;
//	if($_FILES[$simg]['tmp_name']!=''){
//            echo 'it has';
//		$info = getimagesize($_FILES[$simg]['tmp_name']);
//	if ($info === FALSE) {
//		header("location:beaches.php?pgid=0&fl=2");
//	}else{
//
//			$sql_p="insert into beaches_img values('','".$insertedId."','$_FILES[$simg]['name']') ";
//			$r_p=mysql_query($sql_p);
//                        if($r_p) {
//                            
//                            $insertedIdPhoto=mysql_insert_id();
//                            $ext=$_FILES[$simg]['name'];
//                            $ext=explode(".",$ext);
//                            $valy=$insertedIdPhoto;
//                            $name=$insertedIdPhoto.".".$ext[1];
//                            $dirName="../images/beaches";
//                            $uploadFile="$dirName/".$name;
//                            $upload_attempt = move_uploaded_file($_FILES[$simg]['tmp_name'], $uploadFile);
//                            if($upload_attempt) {
//                                
//                                echo 'success';
//                            }
//                            else {
//                                
//                                echo 'failurrrre';
//                            }
//                            
//                        }
//                        else {
//                            
//                            echo 'failure' . mysql_error();
//                        }
//			
//			
//
//$filename = $uploadFile;
//// Content type
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
//
//			$sql_p="update beaches_img set img='".$name."' where id='".$insertedIdPhoto."' ";
//			$r_p=mysql_query($sql_p);
//		}
//		}
//                else {
//                    echo 'it hasnt';
//                    var_dump($_FILES[$simg]);
//                    continue;
//                }
//
//}
?>
































