<?php 
include("../db_conn.php");
$s="select * from services";
$r=mysql_query($s);
while($row=mysql_fetch_array($r)){
$img="http://localhost/elgouna/images/services/".$row['id'].".png";
$d="update services set img='$img' where id='$row[id]'";
$n=mysql_query($d);
}
?>
