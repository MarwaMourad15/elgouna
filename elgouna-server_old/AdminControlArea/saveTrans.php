<?php
session_start();
//include("check_session.php");
include("../db_conn.php");
if(isset($_POST['type'],
        $_POST['description'], 
        $_FILES['trans-img'])) {
    $type = mysql_real_escape_string($_POST['type']);
    $description = mysql_real_escape_string($_POST['description']);
    echo $description;
    $img_sql = '';
    if(!empty($_FILES['trans-img']['name'])) {
        $img = $_FILES['trans-img']['name'];
        $img = str_replace(" ", "-", $img);
        $img_sql = " '$img')";
    }
    $trans_save_sql = "insert into transportation "
            . "values ('', "
            . "'$type', "
            . "'$description', " 
            . $img_sql;
    //SAVE TRANSPORTATION TYPE
    $save_trans_query = mysql_query($trans_save_sql);
    if($save_trans_query) {
        echo 'trans saved.';
        $saved_trans_id = mysql_insert_id();
        $img = $saved_trans_id . '_' . $img;
        $img_query = mysql_query("update transportation "
                . "set img = '$img' "
                . "where id = '$saved_trans_id'");
        if($img_query) {
            echo 'image saved.';
            $dir = "../images/transportation/";
            $img_path = $dir . $img;
            //header("location: transs.php?pgid=0&fl=1");
            // Get new sizes
            list($width, $height) = getimagesize($img_path);
            $new_width = '960';
            $new_height = '630';
            // Load
            $thumb = imagecreatetruecolor($new_width, $new_height);
            $source = imagecreatefromjpeg($img_path);
            // Resize
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            // file name also indicates the folder to save it to
            imagejpeg($thumb, $img_path, 100); 
            imagedestroy($thumb);
            $upload_img = move_uploaded_file($_FILES['trans-img']['tmp_name'], $img_path);
            if($upload_img) {
                echo 'success';
                header("location: transportation.php?pgid=0&fl=1");
            }
            else {
//                echo '1';
                header("location: transs.php?pgid=0&fl=2");
            }
        }
        else {
//            echo mysql_error();
            header("location: transs.php?pgid=0&fl=2");
        }
    }
    else {
//        echo mysql_error();
        header("location: transs.php?pgid=0&fl=2");
    }
}
else {
//    echo 'transportation data is not set.';
    header("location: transportation.php?pgid=0&fl=2");
}
?>