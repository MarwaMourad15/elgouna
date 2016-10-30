<?php
if(trim($_SESSION['session_elgouna_mobileApp_username'])=='' || trim($_SESSION['session_elgouna_mobileApp_id'])=='' || trim($_SESSION['session_elgouna_mobileApp_id'])=='0' || trim($_SESSION['session_elgouna_mobileApp_username'])==' ' || empty($_SESSION['session_elgouna_mobileApp_id']) || empty($_SESSION['session_elgouna_mobileApp_username']) ){
header("location:index.php");
}
?>