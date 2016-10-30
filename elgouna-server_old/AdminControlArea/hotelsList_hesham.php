<?php 
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44="select * from hotels where hidden=0 order by ord asc";
//echo $sql44;
$res44=mysqli_query($conn, $sql44);
$row44=mysqli_fetch_array($res44);
$num=mysqli_num_rows($res44);
$ID=$_POST['pgid'];
$limit=15;
if($ID=="")
$ID=0;
$D=$ID+1;
if($ID=="")
	{$start=0;}
else 
	{$start=$ID*$limit;}

$pagenumber=ceil($num/$limit);
$end=$start+$limit;
$sql = "select * from hotels where hidden=0 order by ord asc limit $start,$limit";
$result=mysqli_query($conn, $sql);
?><div class="well"  >

    <table class="table"  style="">
      <thead style="">
        <tr>
          <th style="width:20px;">#</th>
          <th style="width:400px;  " > Title</th>
          <th style="width:400px;  " >Rating Stars</th>

          <th style="width:400px;  " >Likes</th>
          <th style="width:400px;  " >Reviews</th>
          <th style="width:400px;  " >Manage Reviews</th>
          <th style="width: 26px;">Actions</th>
        </tr>
      </thead>
      <tbody >
      <?php if($num!=0){
	  $k=0;
	   while($row=mysqli_fetch_array($result)){
	   $k++;
	   $e=$k%2;
	   
	  ?>
        <tr <?php if( $e==0){?> style="background-color:#EFEFEF" <?php }?>>
          <td width="20"><?php echo $k+($_POST['pgid']*15);?></td>
          <td width="400" style=" width:400px;"><?php echo $row['name'];?></td>
          <td width="400" style=" width:400px;"><?php for($i=0;$i<$row['ratingStar'];$i++){?><img src="images/star.png" /><?php }?></td>

          <td width="400" style=" width:400px;"><?php 
		  $sql_like="select id from user_hotel_like where hotel_id='$row[id]'";
			$r_like=mysqli_query($conn, $sql_like);
			$n_like=0;
			$n_like=mysqli_num_rows($r_like);
echo '('.$n_like .') Likes';
		  ?></td>
          <td width="400" style=" width:400px;"><?php 
		  $sql_r="select title from rate_range where `start`<='$row[reviewScore]' and `end`>'$row[reviewScore]'";
			$r_r=mysqli_query($conn, $sql_r);
			$row_r=mysqli_fetch_array($r_r);
			$reviewScoreFinal=$row_r['title']." (".$row['reviewScore'].")";
			echo $reviewScoreFinal;
		  ?></td>
          <td width="400" style=" width:400px;"><a href="hotelReviews.php?id=<?php echo $row['id'];?>">Manage<br />(<?php 
		  $sql_re="select id from hotel_review where hotel_id='$row[id]' and approved=0";
		  $r_re=mysqli_query($conn, $sql_re);
		  $n_re=0;
		  $n_re=mysqli_num_rows($r_re);
		  echo $n_re;
		  ?>) new reviews</a></td>
          <td width="26">
              <a href="javascript:addNewItem('createNewHotel.php?id=<?php echo $row['id'];?>','<?php echo $_POST['pgid'];?>');"><i class="icon-pencil"></i></a>
              <a href="#myModal" onclick="deleteItem('deleteHotel.php','<?php echo $row['id'];?>','<?php echo $_POST['pgid'];?>','1')" role="button" data-toggle="modal"><i class="icon-remove"></i></a> <?php if($row['hidden']==1){?><i class="icon-remove-circle"></i><?php }?>         </td>
        </tr>
        <?php }}else{?>
         <tr><td colspan="6"> <p style="text-align:center; padding-top:20px; color:#3C5A9A; font-size:25px; font-weight:bold">Sorry... There is no data Found</p></td></tr>
        <?php }?>
      </tbody>
    </table>
</div>
<?php if($num>$limit){?>
<div class="pagination">
    <ul>
     <?php if($D!=1){ ?>
        <li><a  href="javascript:ListFn('<?php echo $ID-1;?>','hotelsList.php');" title="Previous Page">« Prev.</a></li>
        <?php }?>
   <?php 
	  $e=0;
	  $s=4;
	  if($_POST['pgid']>=$s-2)
	 {
		 $e=$_POST['pgid']-1;
		  $s=$e+$s;
	 }
		  if($s > $pagenumber)
		  $s=$pagenumber;	
	   for($i=$e ; $i<$s ; $i++){?>
					<?php if($D!=($i+1)){ ?>
        <li> <a href="javascript:ListFn('<?php echo $i; ?>','hotelsList.php');"   title="<?php  echo $i+1;?>"><?php  echo $i+1;?></a></li>
        <?php }else{?>
       <li > <a href="javascript:ListFn('<?php echo $i; ?>','hotelsList.php');" style="background-color:#F4F4F4"  title="<?php  echo $i+1;?>"><?php  echo $i+1;?></a></li>
											<?php }}?>
                                           
 <?php if($D!=($pagenumber)){ ?>
        <li><a href="javascript:ListFn('<?php echo $ID+1;?>','hotelsList.php');" title="Next Page">Next »</a></li>
        <?php }?>
    </ul>
</div>
<?php }?>