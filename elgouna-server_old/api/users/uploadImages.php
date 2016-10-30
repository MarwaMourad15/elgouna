<?php

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$user_query = mysql_query("select * "
        . "from users "
        . "where id = '$obj->userId'");
if($user_query) {
    $user_row = mysql_num_rows($user_query);
    if($user_row > 0) {
        $img = $obj->file;
        $img = str_replace(' ', '+', (str_replace('data:image/png;base64,', '', $img)));
        $data = base64_decode($img);
        //Physical path to the directory
        $dir = getcwd() . '\\images\\users\\';
        $dir = preg_replace('/\\\\/', '/', $dir);
        //Relative path to the directory
        $path = 'http://' 
                . $_SERVER['HTTP_HOST'] 
                . dirname($_SERVER['PHP_SELF']) 
                . '/images/users/';
        $file = $dir . $obj->userId . '.png';
        $upload_attempt = file_put_contents($file, $data);
        if(!$upload_attempt) {
            $json['msg'] = 'Image upload failure.';
        }
        else {
            $image = $path . $obj->userId . '.png';
            $save_image_query = mysql_query("update users "
                    . "set imageURL = '$image' "
                    . "where id = '$obj->userId'");
            if($save_image_query) {
                $json['img_name'] = $image;
            }
            else {
                $json['mysql_msg'] = mysql_error();
            }
        }
    }
    else {
        $json['msg'] = 'There is no such user.';
    }
}
else {
    $json['mysql_msg'] = mysql_error();
}
echo json_encode($json, JSON_UNESCAPED_SLASHES);

?>
