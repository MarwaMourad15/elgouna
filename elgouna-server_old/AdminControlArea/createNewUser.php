<?php 
session_start();
include("../db_conn.php");

date_default_timezone_set('Africa/Cairo');
if($_GET['id']!=''){
$sql="select * from users where id='$_GET[id]' ";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$respPage="updateBanner.php?id=".$row['id'];
$title="View User Profile";
}?><div class="row-fluid" >
    
    <div class="block span12" >
        <p class="block-heading" style=" "><?php echo $title;?></p>
        <div class="block-body">
            
            <form action="<?php echo $respPage;?>&pgid=<?php echo $_POST['pgid'];?>" method="post" enctype="multipart/form-data" name="coolform" id="coolform" onSubmit="return false;">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
  <?php if($row['imageURL']!=''){?>
    <td width="250" valign="top"><img src="<?php echo $row['imageURL'];?>" width="140"/></td>
    <?php }?>
    <td valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0" style=" ">
  <tr>
    <td width="150"><table width="100%" border="0">
 
  <tr>
    <td width="200"><strong>
      Name:
    </strong></td>
    <td><?php echo $row['name'];?></td>
    <td width="150">&nbsp;</td>
    <td width="200"><strong>
      E-mail:
    </strong></td>
    <td><?php echo $row['email'];?></td>
    </tr>
  
  <tr>
    <td width="150"><strong>
      Phone:
    </strong></td>
    <td><?php echo $row['phoneNumber'];?></td>
    <td width="150">&nbsp;</td>
    <td width="150"><strong>
      Gender:
    </strong></td>
    <td><?php if($row['gender']==1){echo "Female";}else{echo "Male";}?></td>
    </tr>
  
  <tr>
    <td width="150"><strong>
      Date Of Birth:
    </strong></td>
    <td><?php echo $row['birthDate'];?></td>
    <td width="150">&nbsp;</td>
    <td width="150"><strong>
      Zip Code:
    </strong></td>
    <td><?php echo $row['zipCode'];?></td>
    </tr>
  


  
</table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="150"><strong> Address: </strong></td>
        <td><?php echo $row['address'];?></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="200"><strong>Notifications Enabled: </strong></td>
        <td><?php if($row['notificationsEnabled']!=''){echo '<img src="images/cr.png" width="15">';}?></td>
        <td width="150">&nbsp;</td>
        <td width="200"><strong>Maps Enabled: </strong></td>
        <td><?php if($row['mapsEnabled']!=''){echo '<img src="images/cr.png" width="15">';}?></td>
      </tr>
      <tr>
        <td width="150"><strong> Elgouna Phone: </strong></td>
        <td><?php echo $row['elgounaPhone'];?></td>
        <td width="150">&nbsp;</td>
        <td width="150"><strong> Elgouna SMS: </strong></td>
        <td><?php echo $row['elgounaSMS'];?></td>
      </tr>
      <tr>
        <td width="150"><strong> Elgouna E-mail: </strong></td>
        <td><?php echo $row['elgounaemail'];?></td>
        <td width="150">&nbsp;</td>
        <td width="150"><strong> &nbsp;</strong></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  

   <tr>
     <td>&nbsp;</td>
   </tr>
</table></td>
  </tr>
</table>





    </form>
      </div>
    </div>
</div>