<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
if(trim($_POST['id'])!='' ){
$ser=" and id<>'$_POST[id]' ";
}
$n="no";
$num=0;
$sql="select * from users where BINARY username='".$_POST['username']."' $ser";
$r=mysql_query($sql);
$num=mysql_num_rows($r);
if($num==0){
$n="ok";
}
echo $n;
?>