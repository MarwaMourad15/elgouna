<?php 

include("db_conn.php");
include("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$json = array();
$sql = "select id as userId, "
        . "name,"
        . "imageURL,"
        . "phoneNumber,"
        . "gender,"
        . "birthDate,"
        . "address,"
        . "email,"
        . "zipCode,"
        . "fbId as facebookId,"
        . "notificationsEnabled,"
        . "mapsEnabled,"
        . "elgounaPhone,"
        . "elgounaSMS,"
        . "elgounaemail,"
        . "ehgzly_user_id "
        . "from users "
        . "where fbId='" . $obj->fbId . "'";
$query_2 = mysql_query($sql);
if($query_2){
    
    $row_num_2 = mysql_num_rows($query_2);
    if($row_num_2 == 1) {
        
        $rows = mysql_fetch_assoc($query_2);
        $json['status'] = '1';
        $json['userExists'] = '1';
        $json['user'] = $rows;
        $imgUr = "https://graph.facebook.com/" . $rows['facebookId'] 
                . "/picture?type=large";
        $json['user']['imageURL'] = $imgUr;
        $var = '{"UserName": "' . $json['user']['name'].'", "Password": "' 
                . $row_sql['userAuth'] . '"}';
        $response = \Httpful\Request
                ::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")
                ->body($var)->addHeaders(array(
                    'appToken' => getAppToken(),
                    'Content-Type' => 'application/json',))->send();
        $json['user']['ehgzly_user_token'] = $response->body->access_token;


        //Retry to sign up user again, this part need to be revisited
        if($response->body->access_token == null){
            
            $var1 = '{"UserName": "' . $json['user']['name'] . '", "Password": "'
                    . $row_sql['userAuth'] . '", "FullName": "' . $json['user']['name']
                    . '", "PhoneNumer": "' 
                    . $json['user']['phone'] . '", "Address": "masr"}';
            $var2 = '{"UserName": "' . $json['user']['name'] . '", "Password": "'
                    . $row_sql['userAuth'] . '"}';
            $response1 = \Httpful\Request::
                    post("http://e7gezly.cloudapp.net/api/user/AddUser")
                    ->body($var1)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
            $json['user']['ehgzly_user_id'] = $response1->body->UserId;
            $response2 = \Httpful\Request
                    ::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")
                    ->body($var2)->addHeaders(array(
                        'appToken' => getAppToken(),
                        'Content-Type' => 'application/json',))->send();
            $json['user']['ehgzly_user_token'] = $response2->body->access_token;
            if(repeatRequest($response1->code)){
                
                $response1 = \Httpful\Request
                        ::post("http://e7gezly.cloudapp.net/api/user/AddUser")
                        ->body($var1)->addHeaders(array(
                                'appToken' => getAppToken(),
                                'Content-Type' => 'application/json',))->send();
                $json['user']['ehgzly_user_id'] = $response1->body->UserId;
                $response2 = \Httpful\Request
                        ::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")
                        ->body($var2)->addHeaders(array(
                            'appToken' => getAppToken(),
                            'Content-Type' => 'application/json',))->send();
                $json['user']['ehgzly_user_token'] = $response2->body->access_token;
            }
            $sql_2 = "UPDATE users "
                    . "SET ehgzly_user_id = '{$response1->body->UserId}', "
                    . "ehgzly_user_token = '{$response2->body->access_token}' "
                    . "where id ='$insertedID'";
            $query_3 = mysql_query($sql_2);
            $json['user']['ehgzly_user_token'] = $response1->body->access_token;
        }
        if(repeatRequest($response->code)){
            
            $response = \Httpful\Request
                    ::post("http://e7gezly.cloudapp.net/api/user/GetUserToken")
                    ->body($var)->addHeaders(array(
                            'appToken' => getAppToken(),
                            'Content-Type' => 'application/json',))->send();
            $json['user']['ehgzly_user_token'] = $response->body->access_token;
        }
        $sql_3 = "UPDATE users "
                . "SET ehgzly_user_token = '{$response->body->access_token}' "
                . "where id = {$json['user']['userId']}";
        $query_4 = mysql_query($sql_3);
   	 $sql = "UPDATE users SET ehgzly_user_token='{$response->body->access_token}' where id ={$json['user']['userId']}";
    	$res = mysql_query($sql);
    	//appenza
    	$json['user']['cards'] = array();
	$cards_sql = "select * "
            . "from `user-card` "
            . "where user_id = " . $json['user']['userId'];
	$cards_query = mysql_query($cards_sql);
	if($cards_query) {
	        $cards_rows = mysql_num_rows($cards_query);
	        if($cards_rows > 0) {
	            while($card_arr = mysql_fetch_array($cards_query, MYSQLI_ASSOC)) {
	                	array_push($json['user']['cards'], $card_arr);
        	    }
		}
	}

    } else {
        
        $json['status'] = '1';
        $json['userExists'] = '0';
        $json['user'] = '';
    }
}else{
	$json['status']='1';
	$json['userExists']='0';
	$json['user']='';
}
echo json_encode($json);

?>
