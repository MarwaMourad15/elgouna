<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s = "select bookingURL,"
        . "facebookURL,"
        . "elgounaURL,"
        . "twitterURL,"
        . "youtubeURL,"
        . "instagramURL,"
        . "snapchatURL,"
        . "elgounaPhone,"
        . "elgounaSMS,"
        . "elgounaemail,"
        . "about,"
        . "paymobAPIKey, "
        . "paymobSecretKey, "
        . "paymobMerchantId, "
        . "paymobSecureHash "
        . "from booking_link "
        . "where id = 1";
$r = mysql_query($s);
$n = mysql_num_rows($r);
if($n == 1) {
    
    $row = mysql_fetch_assoc($r);
    $json = $row;
}
echo json_encode($json);

?>
