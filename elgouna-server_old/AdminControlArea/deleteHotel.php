<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$sql="update hotels set hidden=1 where id='$_POST[id]'";
$r=mysql_query($sql);
?>