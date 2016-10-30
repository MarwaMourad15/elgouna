<?php 
include("db_conn.php");
$json = array();
$trans_types_query = mysql_query("select * "
        . "from transportation");
if($trans_types_query) {
    $trans_types_rows = mysql_num_rows($trans_types_query);
    if($trans_types_rows > 0) {
        while($trans_type_arr = mysql_fetch_assoc($trans_types_query)) {
            $json[] = $trans_type_arr;
        }
    }
}
else {
    echo mysql_error();
}
echo json_encode($json);
?>
