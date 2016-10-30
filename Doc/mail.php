<?php
$fromMail = "muhammed.fareed.94@gmail.com";
$body = 'There is a change in the API Please check the below link <br>';
$body .= '<a href="http://www.yadoctory.com/Doc">Doctory API Doucmentation</a>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
if(isset($_GET['doc'])) {
	if($_GET['doc']=='c4f71711be211972c8086a35e28611d1')
	if (mail('blackx01blackx@gmail.com, blackx_01@yahoo.com', 'Doctory Change In API', $body, $headers)) {
		echo 'Done';
	} else {
		echo 'error';
	}
}else{
	echo'None';
}
?>