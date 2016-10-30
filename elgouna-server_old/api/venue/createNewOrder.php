<?php

include("db_conn.php");
$order_data_json = file_get_contents('php://input');
$order_data_json_object = json_decode($order_data_json);

$order_creation_date = date("Y-m-d");
$add_order_sql = "insert into orders "
        . "values ('', "
        . "'$order_data_json_object->order_code', "
        . "'$order_data_json_object->amount', "
        . "'$order_creation_date', "
        . "'$order_data_json_object->closed', "
        . "'NULL', "
        . "'$order_data_json_object->last_payment_date', "
        . "'$order_data_json_object->venue_name')";
$add_order_query = mysql_query($add_order_sql);
echo ($add_order_query) ? 'success' : mysql_error($conn);

?>
