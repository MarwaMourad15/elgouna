<?php
include('db_conn.php');
include('./vendor/nategood/httpful/bootstrap.php');
function updateAppToken() {
    $appTokenKey = "E7gzlyAppToken";
    $response = \Httpful\Request
            ::post("http://e7gezly.cloudapp.net/api/AppSecurity/getapptoken/")->body('{
    "App_Key": "862c687c-59be-48d8-ab88-cb94c330b714",
    "App_secret": "862c687c-59be-48d8-ab88-cb94c330b714"}')
            ->addHeader('Content-Type', 'application/json')->send();		
    $select_key = 'SELECT * FROM app_config where app_config.key = "'.$appTokenKey.'";';
    $sql_ex = mysql_query($select_key);
    $rows = 0;
    if($sql_ex) {
    
        $rows=mysql_num_rows($sql_ex);
    }
    if($rows == 0) {
        $insret_app_token = "INSERT INTO `app_config` (`key`, `value`) "
                . "VALUES ('" . $appTokenKey . "', '" 
                . $response->body->access_token . "')";
        $r = mysql_query($insret_app_token);
        $insertedID = mysql_insert_id($conn);
    }	
    else {
    
        $insret_app_token = "UPDATE app_config "
                . "SET value = '{" . $response->body->access_token . "}' "
                . "WHERE app_config.key = '{" . $appTokenKey . "}';";
        echo $insret_app_token;
        $r = mysql_query($insret_app_token);
        if($r) {
            $row = mysql_fetch_assoc($r);
        }
        echo mysql_error();
    }
}
function getAppToken(){
    $appTokenKey = "E7gzlyAppToken";
    $select_key = 'SELECT * '
            . 'FROM app_config '
            . 'where app_config.key = "' . $appTokenKey . '";';
    $sql_ex = mysql_query($select_key);
    if($sql_ex) {
        
        $result=mysql_fetch_assoc($sql_ex);
        // var_dump($result);
    }
    if ($result == 0) {
        
        updateAppToken();
    }
    return $result['value'];
}
function repeatRequest($code = 0) {
    if ($code != 200) {
        
        getAppToken();
        return true;
    }
    else {
        
        return false;
    }
}
?>
