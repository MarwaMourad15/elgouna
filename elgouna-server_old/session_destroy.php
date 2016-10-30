<?php

header("Access-Control-Allow-Origin: '*'");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

include("db_conn.php");
unset($_SESSION);
session_destroy();

?>