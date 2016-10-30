<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$s = "select id, name "
        . "from beaches_filter "
        . "order by ord asc";
$r = mysql_query($s);
if($r) {
    $n = mysql_num_rows($r);
    while($row = mysql_fetch_assoc($r)){
        $json[] = $row;
    }
}
echo json_encode($json);

?>
