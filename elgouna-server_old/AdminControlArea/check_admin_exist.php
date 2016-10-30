<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$username = $_POST['username'];
$password =$_POST['pass'];
$sql = "select * from admin where BINARY `username`='$username' and BINARY `password` ='$password'";
$result= mysql_query($sql);
$num= mysql_num_rows($result);
if($num == 1)
{
$row=mysql_fetch_array($result);
$_SESSION['session_elgouna_mobileApp_username']=$username;
$_SESSION['session_elgouna_mobileApp_id']=$row['id'];
echo "ok";
}else{
echo "no";
}
?>