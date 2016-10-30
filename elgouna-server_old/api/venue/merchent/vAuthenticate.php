<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
var_dump($_SESSION);
        if (isset($_SESSION['v_username']) && isset($_SESSION['v_id']) && isset($_SESSION['v_authenticated'])) {
            
            $resultData = array(
                "vName" => $_SESSION['v_name'],
                "vId" => $_SESSION['v_id'],
                "vAuthenticated" => $_SESSION['v_authenticated']
            );
            
        }else {
            $resultData = array(
                "vName" => "",
                "vId" => "",
                "vAuthenticated" => false
            );
            echo  json_encode($resultData);
	}
?>
