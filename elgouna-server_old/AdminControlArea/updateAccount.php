<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
$n="no";
if(trim($_POST['name'])!='' && trim($_POST['username'])!='' && trim($_POST['password'])!='' ){

	$sql="update users  set name='$_POST[name]',email='$_POST[email]', position='$_POST[pos]', join_date='$_POST[joinDate]', username='$_POST[username]',password='$_POST[password]' where id='$_POST[id]'";
	//echo $sql;
	$r=mysql_query($sql);
	if($r){
	$n="ok";
	}

}
echo $n.",".$_POST['pgid'];
?>