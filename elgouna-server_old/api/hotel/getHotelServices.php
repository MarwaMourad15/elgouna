<?php 
include("db_conn.php");
$rawPostData = file_get_contents('php://input',r);
$obj = json_decode($rawPostData);
$json = array();
$s="select id, title,img as imageURL from services where hidden=0 order by ord asc";
$r=mysql_query($s);
$n=0;
$n=mysql_num_rows($r);
	if($n!=0){
			while($row=mysql_fetch_assoc($r)){
			$json['services'][]=$row;
			}
}else{
			$json['services']=array();
}
echo json_encode($json);

?>