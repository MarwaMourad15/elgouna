<?php 
include("db_conn.php");
$rawPostData = file_get_contents('php://input',r);
$obj = json_decode($rawPostData);
$json = array();
$limit="20";
$start=$obj->{'lastId'};

if($obj->{'lastId'}==0 ){

$sql="select pid from hotels where id='".$obj->{'hotelId'}."'";
$r=mysql_query($sql);
$row=mysql_fetch_array($r);
$reviewPro=0;
if($row['pid']!=0){
						
					$reviewsData= file_get_contents('http://connect.reviewpro.com/v1/lodging/review/published?pid='.$row['pid'].'&api_key=3xr4g6us6xmf5xq6abz84kbh5u3b9vght2xa29pd&sig=b396f6a3bb4e98c9ebe1e56e6518afa40700344456937ea1d21d6c142507ec3e');
					$reviewsData=json_decode($reviewsData);
					//print_r($reviewsData);
									$rr=0;
									foreach($reviewsData->productReviews as $s=>$x){
									foreach($x->reviews as $n=>$m){
		$reviewPro++;
		$userData = new stdClass();
		$userData->username = $m->author->name;
		$userData->imgURL = "";
		$reviewDate = gmdate("d-m-Y", $m->publishDate);
		$rating = ($m->ratings->OVERALL->value/ $m->ratings->OVERALL->outOf) *5 ;
//var_dump($m);
		$json['reviews'][]=array("recordId"=>$reviewPro,"id"=>"","review"=>$m->text,"rating"=>$rating,"user"=>$userData, "date"=>$reviewDate);

									
			}
			}
}



}
$s="select id,review,rating,user_id,date from hotel_review where hotel_id='".$obj->{'hotelId'}."' and  `approved`=1 order by date asc limit $start,$limit";

$r=mysql_query($s);
$n=mysql_num_rows($r);


		$count=$obj->{'lastId'};

			while($row=mysql_fetch_assoc($r)){
						$count++;

$sql_u="select name , imageURL from users where id='$row[user_id]'";
$r_u=mysql_query($sql_u);
$row_u=mysql_fetch_array($r_u);
if($row_u['imgURL']!=''){$imgURL=$row_u['imgURL'];}else{$imgURL='';}
	$user=array("username"=>$row_u['name'],"imgURL"=>$imgURL);


$json['reviews'][]=array("recordId"=>$count,"id"=>$row['id'],"review"=>$row['review'],"rating"=>$row['rating'],"user"=>$user, "date"=>$row['date']);



			
			}
if($reviewPro==0 && $n==0){
			$json['reviews']=array();
}
echo json_encode($json);
?>
