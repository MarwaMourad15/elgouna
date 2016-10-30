<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$username = $_POST['username'];
$password =$_POST['pass'];
$sql = "update admin set `username`='$username' ,`password` ='$password' where id=1";
$result= mysql_query($sql);
if($result)
{
echo "ok";
}else{
echo "no";
}
?>