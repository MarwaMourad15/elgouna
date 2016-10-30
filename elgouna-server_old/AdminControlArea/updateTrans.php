<?php
//include("check_session.php");
include("../db_conn.php");
if(isset($_GET['tid'])) {
    $trans_to_be_updated_id = $_GET['tid'];
    if(isset($_POST['type'],
        $_POST['description'], 
        $_FILES['trans-img'])) {
        $type = mysql_real_escape_string($_POST['type']);
        $description = $_POST['description'];
        $img = '';
        $img_sql = '';
        if(!empty($_FILES['trans-img']['name'])) {
            $img_query = mysql_query("select * "
                    . "from transportation "
                    . "where id = '$trans_to_be_updated_id'");
            if($img_query) {
                $img_arr = mysql_fetch_assoc($img_query);
                $img = $img_arr['img'];
            }
            else {
                header("location: venues.php?pgid=0&fl=2");
                echo mysql_error();
            }
            $new_img = $_FILES['trans-img']['name'];
            $new_img = str_replace(" ", "-", $new_img);
            $new_img = $trans_to_be_updated_id . '_' . $new_img;
            $img_sql = ", `img` = '" . $new_img . "' ";
        }
        $update_trans_sql = "update `transportation` "
                . "set `type` = '$type', "
                . "`description` = '$description' "
                . $img_sql
                . "where `id` = $trans_to_be_updated_id";
//        echo $update_trans_sql . '<br/>';
        //UPDATE TRANS
        $update_trans_query = mysql_query($update_trans_sql);
        if($update_trans_query) {
            if(!empty($_FILES['trans-img']['tmp_name'])) {
                header("Content-type: image/jpeg");
                // Get new sizes
                list($width, $height) = getimagesize($new_img);
                $new_width = '960';
                $new_height = '630';
                // Load
                $thumb = imagecreatetruecolor($new_width, $new_height);
                $source = imagecreatefromjpeg($new_img);
                // Resize
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                // file name also indicates the folder to save it to
                imagejpeg($thumb, $new_img, 100);
                imagedestroy($thumb);
                unlink($thumb);
//                echo __DIR__;
                $dir = "../images/transportation/";
                $upload_file = $dir . $new_img;
                $upload_img = move_uploaded_file($_FILES['trans-img']['tmp_name'], $upload_file);
                echo $_FILES['trans-img']['tmp_name'] . '<br>';
                echo $upload_img . '<br>';
                if($upload_img) {
                    unlink($dir . $img);
                    echo 'main image uploaded<br>';
                    header("location: transportation.php?pgid=0&fl=1");
                }
                else {
                    echo 'main image not uploaded<br>';
                    header("location: transportation.php?pgid=0&fl=2");
                }
            }
            else {
                echo 'main image empty<br>';
                header("location: transportation.php?pgid=0&fl=1");
            }
        }
        else {
            echo mysql_error();
            header("location: transportation.php?pgid=0&fl=2");
        }
    }
    else {
        echo 'trans data is not set';
        header("location: transportation.php?pgid=0&fl=2");
    }
}
else {
    echo 'trans id is not set';
    header("location: transportation.php?pgid=0&fl=2");
}
?>