<?php 

header("Access-Control-Allow-Origin: '*'");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
include("db_conn.php");
$user_json = file_get_contents('php://input');
$user_object = json_decode($user_json);
$payments_arr = array();
if(isset($user_object->user_id)) {
    $user_id = $user_object->user_id;
    $user_sql = "select * "
            . "from users "
            . "where id = '$user_id'";
    $user_query = mysql_query($user_sql);
    if($user_query) {
        $user_row = mysql_num_rows($user_query);
        if($user_row > 0) {
            $payments_sql = "select `payments`.*, `orders`.`order_code` "
                    . "from `payments` join `orders` "
                    . "on `payments`.`order_id` = `orders`.`id` "
                    . "where `payments`.`user_id` = '$user_id' "
                    . "order by `payments`.`payment_date` desc";
            $payments_query = mysql_query($payments_sql);
            if($payments_query) {
                $payments_rows = mysql_num_rows($payments_query);
                if($payments_rows > 0) {
                    while($payment_arr = mysql_fetch_assoc($payments_query)) {
                        array_push($payments_arr, $payment_arr);
                    }
                }
                else {
                    $payments_arr['message'] = "No payments for this user.";
                }
            }
            else {
                $payments_arr['mysql_message'] = mysql_error();
            }
        }
        else {
            $payments_arr['message'] = "There is no such user.";
        }
    }
    else {
        $payments_arr['mysql_message'] = mysql_error();
    }
}
else {
    $payments_arr['message'] = "User id is not set.";
}
echo json_encode($payments_arr);

?>
