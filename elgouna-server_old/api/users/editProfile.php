<?php 
include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$sql_ex = "select * "
        . "from users "
        . "where id='$obj->userId'";
$r_ex = mysql_query($sql_ex);
$n_ex = 0;
$n_ex = mysql_num_rows($r_ex);
if($n_ex == 1) {
    $row_ex = mysql_fetch_array($r_ex);
    $sql_exx = "select id "
            . "from users "
            . "where email = '" . $obj->email . "' and id<>'" . $obj->userId . "'";
    $r_exx = mysql_query($sql_exx);
    $n_exx = 0;
    $n_exx = mysql_num_rows($r_exx);
    if($n_exx == 0){
        $s="update users " 
                . "set userAuth = '" . $obj->userAuth . "', name = '" . $obj->name 
                . "', email = '" . $obj->email 
                . "', phoneNumber = '" . $obj->phoneNumber . "', gender = '" 
                . $obj->gender . "', birthDate = '" . $obj->birthday . "', address='" 
                . $obj->address . "' , zipCode = '" . $obj->zipCode . "', "
                . "notificationsEnabled = '" . $obj->notificationEnabled 
                . "', mapsEnabled = '" . $obj->mapsEnabled . "'"
                . "where id = '$row_ex[id]'";
        $r = mysql_query($s);
        $insertedID = $row_ex['id'];
        $s = "select id as userId, "
                . "name,"
                . "imageURL,"
                . "phoneNumber,"
                . "gender,"
                . "birthDate,"
                . "address,"
                . "email,"
                . "zipCode,"
                . "fbId as facebookId,"
                . "notificationsEnabled,"
                . "mapsEnabled,"
                . "elgounaPhone,"
                . "elgounaSMS,"
                . "elgounaemail "
                . "from users "
                . "where id = '$insertedID'";
        $r = mysql_query($s);
        $json['status'] = '1';
        $row = mysql_fetch_assoc($r);
        $json['user'] = $row;
    } 
    else {
        
	$json['status']='0';
	$json['user']='';
	$json['msg']='This email is already registered to another user.';
    }
}
else {
    
    $json['status'] = '0';
    $json['user'] = '';
    $json['msg'] = 'This email does not exist.';
}
echo json_encode($json, JSON_UNESCAPED_SLASHES);

?>
