<?php 
session_start();
include("../db_conn.php");

date_default_timezone_set('Africa/Cairo');
$respPage="saveService.php?id=0";
$title="Add New Service";
if($_GET['id']!=''){
$sql="select * from services where id='$_GET[id]' ";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$respPage="updateServcie.php?id=".$row['id'];
$title="Update Service";
}?>
<style type="text/css">
<!--
astrex{
color:#FF0000;
font-weight:bold;
}
-->
</style>

<div class="row-fluid" >
    
    <div class="block span12" >
        <p class="block-heading" style=" "><?php echo $title;?></p>
        <div class="block-body">
            
            <form action="<?php echo $respPage;?>&pgid=<?php echo $_POST['pgid'];?>&type=<?php echo $_GET['type'];?>" method="post" enctype="multipart/form-data" name="coolform" id="coolform" onSubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                            <tr>
                              <td width="150"><strong>
                                Order:
                              </strong></td>
                              <td><input type="text"  name="ord" id="ord" value="<?php echo $row['ord'];?>"onkeypress="return numbersonly(event, false)"  class="input-xlarge" style=" "/></td>
                              <td><strong>
                                Name: <astrex>*</astrex>
                              </strong></td>
                              <td><input type="text"  name="name" id="name" value="<?php echo $row['title'];?>" class="input-xlarge" style=" "/></td>
                              <td>&nbsp;</td>
                            </tr>
                            
                        </table></td>
                      </tr>
                      
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      
                  </table></td>
                </tr>
                
                <tr bgcolor="#89080E">
                  <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Upload Images</td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
        
          <td valign="top"><label>Image :</label><span style="font-size:11px;"></span></td>
          <td valign="top"><input type="file"  name="simg" id="simg"  class="input-xlarge" /></td>
          <td width="130" valign="top">&nbsp;</td>
          </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td><table border="0" cellpadding="5" cellspacing="5">
                      <tr>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><div class="btn-toolbar">
                                  <div id="buttonDiv">
                                    <button type="submit"  onclick="saveResearchCov();" class="btn btn-primary"><i class="icon-save"></i> Save </button>
                                  </div>
                                <div class="btn-group"> </div>
                              </div></td>
                              <td width="150">&nbsp;</td>
                              <td><div id="error-div" class="alert alert-error" style="width:200px; text-align:center; display:none">The fill the highlighted field</div></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
          </form>
      </div>
    </div>
</div>