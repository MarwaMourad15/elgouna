<?php

session_start();
//include("check_session.php");
include("../db_conn.php");
if(isset($_POST['username'],
        $_POST['password'],
        $_POST['name'],
        $_POST['type'], 
        $_POST['location'])) {
    
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $name = mysql_real_escape_string($_POST['name']);
    $type = $_POST['type'];
    $location = mysql_real_escape_string($_POST['location']);
    $order = $_POST['order'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $review_score = $_POST['score'];
    $rating_star = $_POST['rating'];
    $description = mysql_real_escape_string($_POST['description']);
    $wifi_check = isset($_POST['wifi-check']) ? ($_POST['wifi-check'] == 'available'
            ? '1' : '0') : '0'; 
    $visa_check = isset($_POST['visa-check']) ? ($_POST['visa-check'] == 'available'
            ? '1' : '0') : '0'; 
    $dining_check = isset($_POST['dining-check']) ? ($_POST['dining-check'] == 'available'
            ? '1' : '0') : '0'; 
    $offer_check = isset($_POST['offer-check']) ? ($_POST['offer-check'] == 'available'
            ? '1' : '0') : '0'; 
    $offer_title = mysql_real_escape_string($_POST['offer-title']);
    $offer_description = mysql_real_escape_string($_POST['offer-description']);
    $elgounaVoice=mysql_real_escape_string($_POST['elgounaVoice']);
    $email = mysql_real_escape_string($_POST['email']);
    $phone_number = $_POST['phone-number'];
    $info = mysql_real_escape_string($_POST['info']);
    $facebook_link = mysql_real_escape_string($_POST['facebook-link']);
    $twitter_link = mysql_real_escape_string($_POST['twitter-link']);
    $instagram_link = mysql_real_escape_string($_POST['instagram-link']);
    $youtube_link = mysql_real_escape_string($_POST['youtube-link']);
    $venue_save_sql = "insert into venues "
            . "values ('', '$username', "
            . "'$password', "
            . "'$name', "
            . "'$type', "
            . "'$location', "
            . "'$latitude',"
            . "'$longitude',"
            . "'$review_score',"
            . "'$rating_star',"
            . "'$description',"
            . "'$wifi_check',"
            . "'$visa_check',"
            . "'$dining_check',"
            . "'$offer_check',"
            . "'$offer_title',"
            . "'$offer_description',"
            . "' ',"
            . "'$email',"
            . "'$phone_number',"
            . "'$info',"
            . "'$facebook_link',"
            . "'$twitter_link',"
            . "'$instagram_link',"
            . "'$youtube_link',"
            . "'$order',"
            . "'1',"
            . "'')";
    
    //SAVE VENUE
    $save_venue_query = mysql_query($venue_save_sql);
    
    if($save_venue_query) {
        
        $dir = "../images/venues/";
        $saved_venue_id = mysql_insert_id();
        
        if(!empty($_FILES['venue-logo']['name'])) {
                        
            $logo = $_FILES['venue-logo']['name'];
            $logo = str_replace(" ", "-", $logo);
            $insert_logo_sql = "insert into venues_img values ('', " . "'$saved_venue_id', " . "'$logo')";
            $insert_logo_query = mysql_query($insert_logo_sql);
            if($insert_logo_query) {
                $saved_logo_id = mysql_insert_id();
                $prefixed_logo = $saved_logo_id . '_' . $logo;
                $prefix_logo_query = mysql_query("update venues_img set img = '$prefixed_logo' where id = '$saved_logo_id'");
                if($prefix_logo_query) {
                    $logo_path = $dir . $prefixed_logo;
                    $upload_logo = move_uploaded_file($_FILES['venue-logo']['tmp_name'], $logo_path);
                    var_dump($_FILES['venue-logo']['tmp_name']);
                    echo "\n";
                    var_dump($upload_logo);
                    echo "<br/>";
                    if($upload_logo) {
                        // header("location: venues.php?pgid=0&fl=1");
                        // Get new sizes

                        list($width, $height) = getimagesize($logo_path);
                        $new_width = '960';
                        $new_height = '630';

                        // Load
                        $thumb = imagecreatetruecolor($new_width, $new_height);
                        $source = imagecreatefromjpeg($logo_path);
                        var_dump($thumb);
                        echo "<br/>";
                        var_dump($logo_path);
                        echo "<br/>";
                        var_dump($source);
                        // Resize
                        imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        // file name also indicates the folder to save it to
                        imagejpeg($thumb, $logo_path, 100); 
                        imagedestroy($thumb);
                        echo 'success1';
    //                            header("location: venues.php?pgid=0&fl=1");
                    }
                    else {
                        echo 'logo wasn';
    //                            header("location: venues.php?pgid=0&fl=2");
                    }
                }
                else {
                    
                    echo mysql_query();
//                        header("location: venues.php?pgid=0&fl=2");
                }
            }
            else {

                echo mysql_query();
//                        header("location: venues.php?pgid=0&fl=2");
            }
        }
        else {

            echo 'logo empty';
//                header("location: venues.php?pgid=0&fl=2");
        }
        if(!empty($_FILES['venue-main-img']['name'])) {
                        
            $main_img = $_FILES['venue-main-img']['name'];
            $main_img = str_replace(" ", "-", $main_img);
            $insert_main_img_sql = "insert into venues_img values ('', '$saved_venue_id', '$main_img')";
            $insert_main_img_query = mysql_query($insert_main_img_sql);
            if($insert_main_img_query) {
                $saved_main_img_id = mysql_insert_id();
                $prefixed_main_img = $saved_main_img_id . '_' . $main_img;
                $prefix_main_img_query = mysql_query("update venues_img set img = '$prefixed_main_img' where id = '$saved_main_img_id'");
                if($prefix_main_img_query) {
                    $main_img_path = $dir . $prefixed_main_img;
                    $upload_main_img = move_uploaded_file($_FILES['venue-main-img']['tmp_name'], $main_img_path);
                    if($upload_main_img) {

                        //header("location: venues.php?pgid=0&fl=1");
                        // Get new sizes
                        list($width, $height) = getimagesize($main_img_path);
                        $new_width = '960';
                        $new_height = '630';

                        // Load
                        $thumb = imagecreatetruecolor($new_width, $new_height);
                        $source = imagecreatefromjpeg($main_img_path);

                        // Resize
                        imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        // file name also indicates the folder to save it to
                        imagejpeg($thumb, $main_img_path, 100); 
                        imagedestroy($thumb);
                        echo 'success2';
    //                            header("location: venues.php?pgid=0&fl=1");
                    }
                    else {

                        echo '1';
    //                            header("location: venues.php?pgid=0&fl=2");
                    }
                }
                else {
                    
                    echo '2';
    //                            header("location: venues.php?pgid=0&fl=2");
                }
            }
            else {

                echo mysql_query();
//                        header("location: venues.php?pgid=0&fl=2");
            }
        }
        else {

            echo 'main image empty ya 7ayawan';
//                header("location: venues.php?pgid=0&fl=2");
        }
        $img_count = count($_FILES['venue-imgs']['name']);

    //    var_dump($_FILES['venue-imgs']['name']);
//        echo $img_count;
        
        for($i = 0; $i < $img_count; $i++) {
            if(!empty($_FILES['venue-imgs']['tmp_name'][$i])) {
    //            var_dump($_FILES['venue-imgs']['tmp_name'][$i]);
                    $filename = $_FILES['venue-imgs']['name'][$i];
                    $filename = str_replace(" ", "-", $filename);
                    $save_venue_img_sql = "insert into venues_img values('', '$inserted_id', '$filename') ";

                    //SAVE VENUE IMAGES
                    $save_venue_img_query = mysql_query($save_venue_img_sql);
                    if($save_venue_query) { 

                        if($save_venue_img_query) {

                            $saved_image_id = mysql_insert_id();
                            $image_prefixed = $saved_image_id . '_' . $filename;
                            $save_venue_img_prefixed_sql = "update venues_img set img = '$image_prefixed'";
                            $save_venue_img_prefixed_query = mysql_query($save_venue_img_prefixed_sql);
                            if($save_venue_img_prefixed_query) {
                                $dir = "../images/venues/";
                                $upload_file = $dir . $image_prefixed;
                                $upload_image = move_uploaded_file($_FILES['venue-imgs']['tmp_name'][$i], $upload_file);
                                if($upload_image) {
                                    // Get new sizes
                                    list($width, $height) = getimagesize($upload_file);
                                    $new_width = '960';
                                    $new_height = '630';

                                    // Load
                                    $thumb = imagecreatetruecolor($new_width, $new_height);
                                    $source = imagecreatefromjpeg($upload_file);

                                    // Resize
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                                    // file name also indicates the folder to save it to
                                    imagejpeg($thumb, $filename, 100);
                                    imagedestroy($thumb);
                                    echo 'success';
                                    //header("location: venues.php?pgid=0&fl=1");
                                }
                            }
                            else {
                                
                                echo mysql_error();
                    //            header("location: venues.php?pgid=0&fl=2");
                            }
                        }
                        else {
                            
                            echo mysql_error();
                  //          header("location: venues.php?pgid=0&fl=2");
                        }
                    } else {
                        echo mysql_error();
                        //header("location: venues.php?pgid=0&fl=2");
                    }
            }
            else {
                
                echo 'images empty';
                //header("location: venues.php?pgid=0&fl=2");
            }
        }
        header("location: venues.php?pgid=0&fl=1");
    }
    else {
        
        echo mysql_error();
        header("location: venues.php?pgid=0&fl=2");
    }
}
else {
    
    header("location: venues.php?pgid=0&fl=2");
}

?>