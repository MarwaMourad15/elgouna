<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$startTime=$date." 00:00:00";
$endTime=$date." 23:59:59";

$sql = "select * from users where hidden=0";
$result= mysql_query($sql);
$num= mysql_num_rows($result);
if($num != 0)
{
					while($row=mysql_fetch_array($result)){
					$n=0;
					$sql="select * from times_track where user_id='".$row['id']."' and login_time>='$startTime' and login_time<='$endTime'";
					$r=mysql_query($sql);
					$n= mysql_num_rows($r);
					
					$sql_x="select * from users_vacancies where user_id='".$row['id']."' and from_date>='$startTime' and to_date<='$endTime'";
					$result_x= mysql_query($sql_x);
					$num_x= mysql_num_rows($result_x);
							if($n==0 && $num_x==0){
					/*****E-mail******************/
					$subject="Connectors Attandance Application";
					$headers = "From: \"Connectors\" <info@connectors-sm.com>\n"; 
					$headers .= "MIME-Version: 1.0\n"; 
					$headers .= "Content-Type: text/HTML; charset=utf-8\n";
					$message = "<table  border='0' align='left' cellpadding='0' cellspacing='0'>
									<tr>
									  <td >Dear, ". $row['name']."</td>
									 
									</tr>
									
									<tr>
									  <td valign='top'>You still not logged in the system, So please Click <a href=http://yourconnectors.com/connectors_hr/index.php?username=".$row['username']."&pass=".$row['password'].">HERE</a> to logged in.</td>
									
									</tr>
									<tr>
									   <td align='left'><br /><br /><br /><strong>Thanks</strong></td>
									
									</tr>
								</table>";
								
								$to=$row['email'];
					mail($to,$subject,$message,$headers);
					echo "Send To: ".$row['name']."<br />";
					
							}else{
							echo $row['name']." has been logged in<br />";
							}
					}
}
?>