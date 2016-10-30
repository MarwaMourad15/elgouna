<?php

//session_start();
//include("check_session.php");
include("../db_conn.php");
if(isset($_GET['vid'])) {
    $venue_to_be_updated_id = $_GET['vid'];
    if(isset($_POST['username'],
        $_POST['password'],
        $_POST['name'],
        $_POST['type'], 
        $_POST['location'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);
        $name = mysql_real_escape_string($_POST['name']);
        $type = mysql_real_escape_string($_POST['type']);
        echo $type;
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
//echo addslashes($description);
        $update_venue_sql = "update venues "
                . "set venueUsername = '$username', "
                . "venuePass = '$password', "
                . "name = '$name', "
                . "type = '$type', "
                . "location = '$location', "
                . "longitude = '$longitude', "
                . "latitude = '$latitude', "
                . "reviewScore = '$review_score', "
                . "ratingStar = '$rating_star', "
                . "description = '$description', "
                . "offerCheck = '$offer_check', "
                . "offerTitle = '$offer_title', "
                . "offerDescription = '$offer_description', "
                . "wifiCheck = '$wifi_check', "
                . "visaCheck = '$visa_check', "
                . "diningCheck = '$dining_check', "
                . "elgounaVoice = '', "
                . "email = '$email', "
                . "phoneNumber = '$phone_number', "
                . "info = '$info', "
                . "facebookLink = '$facebook_link', "
                . "twitterLink = '$twitter_link', "
                . "instagramLink = '$instagram_link', "
                . "youtubeLink = '$youtube_link', "
                . "ord = '$order' "
//                . "merchant_id = '1' "
                . "where id = '$venue_to_be_updated_id'";
        //UPDATE VENUE
        $update_venue_query = mysql_query($update_venue_sql);
        if($update_venue_query) {
            $updated_venue_id_sql = "select * " . "from venues " . "where id = '$venue_to_be_updated_id'";
            $updated_venue_id_query = mysql_query($updated_venue_id_sql);
            if($updated_venue_id_query) {
                $updated_venue_id_row = mysql_num_rows($updated_venue_id_query);
                if($updated_venue_id_row > 0) {
                    $updated_venue_arr = mysql_fetch_array($updated_venue_id_query);
                    if(!empty($_FILES['venue-logo']['name'])) {
                        $logo_id_sql = "select * " . "from venues_img "
                                . "where venue_id = '$updated_venue_arr[0]' "
                                . "order by id asc "
                                . "limit 1";
                        $logo_id_query = mysql_query($logo_id_sql);
                        if($logo_id_query) {
                            $logo_id_rows = mysql_num_rows($logo_id_query);
                            if($logo_id_rows > 0) {
                                $logo_id_arr = mysql_fetch_assoc($logo_id_query);
                                $logo_id = $logo_id_arr['id'];
                                $logo = $logo_id_arr['img'];
                                $new_logo = $_FILES['venue-logo']['name'];
                                $new_logo = str_replace(" ", "-", $new_logo);
                                $new_logo_prefixed = $logo_id . '_' . $new_logo;
                                echo $new_logo_prefixed . '<br>';
                                $update_logo_sql = "update venues_img "
                                        . "set img = '$new_logo_prefixed' "
                                        . "where id = '$logo_id'";
                                $update_logo_query = mysql_query($update_logo_sql);
                                if($update_logo_query) {
                                    //Get new sizes
                                    list($width, $height) = getimagesize($new_logo);
                                    $new_width = '960';
                                    $new_height = '630';
                                    // Load
                                    $thumb = imagecreatetruecolor($new_width, $new_height);
                                    $source = imagecreatefromjpeg($new_logo);
                                    // Resize
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, 
                                            $new_width, $new_height, $width, $height);
                                    // file name also indicates the folder to save it to
                                    imagejpeg($thumb, $new_logo, 100); 
                                    imagedestroy($thumb);
//                                    $dir = "../images/venues/";
                                    $dir = dirname(__DIR__) . '\\images\\venues\\'; 
                                    $upload_file = $dir . $new_logo_prefixed;
                                    $upload_logo = move_uploaded_file(
                                            $_FILES['venue-logo']['tmp_name'], 
                                        $upload_file);
                                    if($upload_logo) {
                                        header("location: venues.php?pgid=0&fl=1");
                                        unlink($dir . $logo);
                                        echo 'logo uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=1");
                                    }
                                    else {
                                        echo 'logo not uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=2");
                                    }
                                }
                                else {
                                    echo 'erroneous logo update query: ' 
                                    . mysql_error() . '<br>';
                                    header("location: venues.php?pgid=0&fl=2");
                                }
                            }
                            else {
                                echo 'no logo found<br>';
                                header("location: venues.php?pgid=0&fl=2");
                            }
                        }
                        else {
                            echo 'erroneous logo query: ' . mysql_error() . '<br>';
                            header("location: venues.php?pgid=0&fl=2");
                        }
                    }
                    else {
                        echo 'empty logo<br>';
                        header("location: venues.php?pgid=0&fl=1");

                    }
                    if(!empty($_FILES['venue-main-img']['name'])) {
                        $main_img_id_sql = "select * "
                                . "from venues_img "
                                . "where venue_id = '$updated_venue_arr[0]' "
                                . "order by id asc "
                                . "limit 1 "
                                . "offset 1";
                        $main_img_id_query = mysql_query($main_img_id_sql);
                        if($main_img_id_query) {
                            $main_img_id_rows = mysql_num_rows($main_img_id_query);
                            if($main_img_id_rows > 0) {
                                $main_img_id_arr = mysql_fetch_assoc($main_img_id_query);
                                $main_img_id = $main_img_id_arr['id'];
                                $main_img = $main_img_id_arr['img'];
                                $new_main_img = $_FILES['venue-main-img']['name'];
                                $new_main_img = str_replace(" ", "-", $new_main_img);
                                $new_main_img_prefixed = $main_img_id . '_' 
                                        . $new_main_img;
                                $update_main_image_sql = "update venues_img "
                                        . "set img = '$new_main_img_prefixed' "
                                        . "where id = '$main_img_id'";
                                $update_main_image_query = 
                                        mysql_query($update_main_image_sql);
                                if($update_main_image_query) {
                                    // Get new sizes
                                    list($width, $height) = 
                                            getimagesize($new_main_img);
                                    $new_width = '960';
                                    $new_height = '630';
                                    // Load
                                    $thumb = imagecreatetruecolor($new_width, 
                                            $new_height);
                                    $source = 
                                            imagecreatefromjpeg($new_main_img);
                                    // Resize
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, 
                                            $new_width, $new_height, $width, $height);
                                    // file name also indicates the folder to save it to
                                    imagejpeg($thumb, $new_main_img, 100); 
                                    imagedestroy($thumb);
                                    $dir = "../images/venues/";
                                    $upload_file = $dir . $new_main_img_prefixed;
                                    $upload_main_img = move_uploaded_file(
                                            $_FILES['venue-main-img']['tmp_name'], 
                                        $upload_file);
                                    if($upload_main_img) {
                                        header("location: venues.php?pgid=0&fl=1");
                                        unlink($dir . $main_img);
                                        echo 'main image uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=1");
                                    }
                                    else {
                                        echo 'main image not uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=2");
                                    }
                                }
                                else {
                                    echo 'erroneous main image update query: ' 
                                    . mysql_error() . '<br>';
                                    header("location: venues.php?pgid=0&fl=2");
                                }
                            }
                            else {
                                echo 'no main image found<br>';
                                header("location: venues.php?pgid=0&fl=2");
                            }
                        }
                        else {
                            echo 'erroneous main image query: ' . mysql_error() . '<br>';
                            header("location: venues.php?pgid=0&fl=2");
                        }
                    }
                    else {
                        echo 'empty main image<br>';
                        header("location: venues.php?pgid=0&fl=1");
                    }
                    $img_count = count($_FILES['venue-imgs']['name']);
                    $images_empty = false;
                    for($i = 0; $i < $img_count; $i++) {
                        if(empty($_FILES['venue-imgs']['name'][$i])) {
                            $images_empty = true;
                            continue;
                        }
                        $info = getimagesize($_FILES['venue-imgs']['tmp_name'][$i]);
                        if (!$info) {
                            header("location: venues.php?pgid=0&fl=2");
                        }
                        else {
                            $new_venue_img = $_FILES['venue-imgs']['name'][$i];
                            $new_venue_img = str_replace(" ", "-", $new_venue_img);
                            $save_venue_img_sql = "insert into venues_img "
                                    . "values('', "
                                    . "'$updated_venue_arr[0]', "
                                    . "'$new_venue_img')";
                            //SAVE VENUE IMAGES
                            $save_venue_img_query = mysql_query($save_venue_img_sql);
                            if($save_venue_img_query) {
                                $saved_image_id = mysql_insert_id();
                                $new_venue_img_prefixed = $saved_image_id . '_' 
                                        . $new_venue_img;
                                $save_venue_img_prefixed_sql = "update venues_img "
                                        . "set img = '$new_venue_img_prefixed' "
                                        . "where id = '$saved_image_id'";
                                $save_venue_img_prefixed_query = 
                                        mysql_query($save_venue_img_prefixed_sql);
                                if($save_venue_img_prefixed_query) {
                                    //Get new sizes
                                    list($width, $height) = getimagesize($new_venue_img);
                                    $new_width = '960';
                                    $new_height = '630';
                                    // Load
                                    $thumb = imagecreatetruecolor($new_width, $new_height);
                                    $source = imagecreatefromjpeg($new_venue_img);
                                    // Resize
                                    imagecopyresized($thumb, $source, 0, 0, 0, 0, 
                                            $new_width, $new_height, $width, $height);
                                    // file name also indicates the folder to save it to
                                    imagejpeg($thumb, $filename, 100); 
                                    imagedestroy($thumb);
                                    $dir = "../images/venues/";
                                    $upload_file = $dir . $new_venue_img_prefixed;
                                    $upload_image = move_uploaded_file(
                                            $_FILES['venue-imgs']['tmp_name'][$i], 
                                            $upload_file);
                                    if($upload_image) {
                                        echo 'image ' . $i . ' uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=1");
                                    }
                                    else {
                                        echo 'image ' . $i . ' not uploaded<br>';
                                        header("location: venues.php?pgid=0&fl=2");
                                    }
                                }
                                else {
                                    echo 'erroneous image update query: ' 
                                    . mysql_error() . '<br>';
                                    header("location: venues.php?pgid=0&fl=2");
                                }
                            }
                            else {
                                echo 'erroneous image query: ' 
                                    . mysql_error() . '<br>';
                                header("location: venues.php?pgid=0&fl=2");
                            }
                        }
                    }
                    if($images_empty) {
                        echo 'images empty<br>';
                        header("location: venues.php?pgid=0&fl=1");
                    }
                }
                else {
                    header("location: venues.php?pgid=0&fl=2");
                    echo 'no such venue<br>';
                }
            }
            else {
                header("location: venues.php?pgid=0&fl=2");
                echo 'erroneous venue update query: ' . mysql_error() . '<br>';
            }
        }
        else {
            header("location: venues.php?pgid=0&fl=2");
            echo 'erroneous venue query: ' . mysql_error() . '<br>';
        }
    }
    else {
        header("location: venues.php?pgid=0&fl=2");
        echo 'venue params are not set';
    }
}
else {
    header("location: venues.php?pgid=0&fl=2");
    echo 'venue id is not set';
}

?>
