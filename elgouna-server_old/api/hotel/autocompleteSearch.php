<?php 

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
		
if($obj->query != "") {
    
    $str = " and name like '%" . $obj->query . "%'";
    $s = "select id as beachId, "
        . "name "
        . "from beaches "
        . "where id<>'' $str and hidden = 0 order by ord asc ";
    $n = 0;
    $r = mysql_query($s);
    $n = mysql_num_rows($r);
    if($n != 0) {

        while($row = mysql_fetch_array($r)) {

            $json['results']['beaches'][]=array("beachId"=>$row['beachId'],"name"=>$row['name']);
        }
    }
    else {

        $json['results']['beaches'] = array();
    }
    $s = "select id as hotelId, name from hotels "
            . "where id<>'' $str and hidden = 0 "
            . "order by ord asc ";
    $n = 0;
    $r = mysql_query($s);
    $n = mysql_num_rows($r);
    if($n != 0) {

        while($row = mysql_fetch_array($r)) {

            $json['results']['hotels'][]=array("hotelId"=>$row['hotelId'],"name"=>$row['name']);
        }
    }
    else {
        $json['results']['hotels'] = array();
    }		
    echo json_encode($json);
}


?>
