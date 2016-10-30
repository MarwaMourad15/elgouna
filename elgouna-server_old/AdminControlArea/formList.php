<?php 
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44="select * from filling_form  order by date desc";
$res44=mysql_query($sql44);
$row44=mysql_fetch_array($res44);
$num=mysql_num_rows($res44);
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
$sql = "select * from filling_form order by date desc limit $start,$limit";
$result=mysql_query($sql);
?><div class="well"  >

    <table class="table"  style="">
      <thead style="">
        <tr>
          <th style="width:20px;">#</th>
          <th style="width:200px;  " >Date</th>
          <th style="width:200px;  " >Name</th>
         <th style="width:200px;  " >Phone</th>
         <th style="width:200px;  " >E-mail</th>
         <th style="width:200px;  " >Message</th>

        </tr>
      </thead>
      <tbody >
      <?php if($num!=0){
	  $k=0;
	   while($row=mysql_fetch_array($result)){
	   $k++;
	   $e=$k%2;
	   
	  ?>
        <tr <?php if( $e==0){?> style="background-color:#EFEFEF" <?php }?>>
          <td width="20"><?php echo $k+($_POST['pgid']*15);?></td>
            <td width="400" style=" width:200px;"><?php echo $row['date'];?></td>
          <td width="400" style=" width:200px;"><?php 
		  echo $row['name'];?></td>
          <td width="400" style=" width:200px;"><?php echo $row['phone'];?></td>
            <td width="400" style=" width:200px;"><?php echo $row['email'];?></td>
              <td width="400" style=" width:200px;"><?php echo $row['msg'];?></td>

         
        </tr>
        <?php }}else{?>
         <tr><td colspan="6"> <p style="text-align:center; padding:20px; color:#000; font-size:16px; font-weight:bold"><i class="fa fa-exclamation-triangle" style="color:darkred;padding-right:10px"></i>No reviews were found.</p></td></tr>
        <?php }?>
      </tbody>
    </table>
</div>
<?php if($num>$limit){?>
<div class="pagination">
    <ul>
     <?php if($D!=1){ ?>
        <li><a  href="javascript:ListFn('<?php echo $ID-1;?>','formList.php?type=<?php echo $_GET['type'];?>');" title="Previous Page">« Prev.</a></li>
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
        <li> <a href="javascript:ListFn('<?php echo $i; ?>','formList.php?type=<?php echo $_GET['type'];?>');"   title="<?php  echo $i+1;?>"><?php  echo $i+1;?></a></li>
        <?php }else{?>
       <li > <a href="javascript:ListFn('<?php echo $i; ?>','formList.php?type=<?php echo $_GET['type'];?>');" style="background-color:#F4F4F4"  title="<?php  echo $i+1;?>"><?php  echo $i+1;?></a></li>
											<?php }}?>
                                           
 <?php if($D!=($pagenumber)){ ?>
        <li><a href="javascript:ListFn('<?php echo $ID+1;?>','formList.php?type=<?php echo $_GET['type'];?>');" title="Next Page">Next »</a></li>
        <?php }?>
    </ul>
</div>
<?php }?>