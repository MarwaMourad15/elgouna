<?php

include("db_conn.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$limit = "20";
$start = $obj->lastId;
$s = "select id,"
        . "review,"
        . "rating,"
        . "user_id,"
        . "date "
        . "from beach_review "
        . "where  beach_id = '" . $obj->beachId . "' "
        . "and `approved`=1 "
        . "order by date asc limit $start, $limit";
$r = mysql_query($s);
if($r) {
    $n = mysql_num_rows($r);
    if($n != 0) {

        $count = $obj->lastId;
        while($row = mysql_fetch_assoc($r)) {

            $count++;
            $sql_u = "select name, imageURL "
                    . "from users "
                    . "where id = '$row[user_id]'";
            $r_u = mysql_query($sql_u);
            $row_u = mysql_fetch_array($r_u);
            if($row_u['imgURL'] != '') {

                $imgURL = $row_u['imgURL'];
            }
            else {

                $imgURL = '';
            }
            $user = array(
                "username" => $row_u['name'],
                "imgURL" => $imgURL
            );
            $json['reviews'][] = array(
                "recordId" => $count,
                "id" => $row['id'],
                "review" => $row['review'],
                "rating" => $row['rating'],
                "user" => $user, 
                "date" => $row['date']
            );
        }
    }
    else {

        $json['reviews'] = array();
    }
}
echo json_encode($json);

?>
