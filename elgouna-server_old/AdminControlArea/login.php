<?php 
/* -----------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
*/
require 'config.php';
require 'lib/facebook/facebook.php';
$facebook = new Facebook(array(
		'appId'		=>  $appID,
		'secret'	=> $appSecret,
		));
//get the user facebook id		
$user = $facebook->getUser();
//echo "hhh".$user;
if($user){

	try{
		//get the facebook user profile data
		$user_profile = $facebook->api('/me');
		$params = array('next' => $base_url.'logout.php');
		//logout url
		$logout =$facebook->getLogoutUrl($params);
		$_SESSION['User']=$user_profile;
		//echo "hhhh".$_SESSION['User'];
		$host="localhost";
$dbPass="m9[P[?zZEWO]";
$dbName="jehan_alamelsyarat";
$dbUser="jehan_alamelsyar";
$link = mysql_connect($host,$dbUser,$dbPass);
if (!$link) {
    die('Could not connect: '.mysql_error());
}
$db_selected = mysql_select_db($dbName, $link);
if (!$db_selected) {
    die ('Can\'t use '.$dbName.' : ' . mysql_error());
}
mysql_set_charset('utf8');

$twitter_id  = $_SESSION['User']['id'];
echo $twitter_id;
$twitter_email = $_SESSION['User']['email'];
$screen_name = $_SESSION['User']['name']; 
$profilepic = "https://graph.facebook.com/".$twitter_id."/picture";
$n=0;
$sql="select * from users where facebook='$twitter_id'";
$r=mysql_query($sql);
$n=mysql_num_rows($r);
if($n==0){
		$sql_x="insert into users values ('','$screen_name','$twitter_email','$screen_name','','','$twitter_id','','$profilepic')";
		echo $sql_x;
		$r_x=mysql_query($sql_x);
		$insertedID=mysql_insert_id();

}else{
$row=mysql_fetch_array($r);
$insertedID=$row['id'];
		$sql_x="update users set name='$screen_name',email='$twitter_email',username='$screen_name',img='$profilepic' where id='$insertedID'";
		$r_x=mysql_query($sql_x);

}
//Set the session variables
$_SESSION['alamElSyarat_account_id']  = $insertedID;
$_SESSION['alamElSyarat_account_username']  = $screen_name; //This is the @name

		$_SESSION['logout']=$logout;
		
	}catch(FacebookApiException $e){
		error_log($e);
		$user = NULL;
	}		
}
	
if(empty($user)){
//login url	
$loginurl = $facebook->getLoginUrl(array(
				'scope'			=> 'email,read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos',
				'redirect_uri'	=> $base_url.'login.php',
				'display'=>'popup'
				));

//echo $loginurl;
header('Location: '.$loginurl);

}





?>
<!-- after authentication close the popup -->
<script type="text/javascript">

//window.close();

</script>