<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
include("calendar.html");
date_default_timezone_set('Africa/Cairo');
$date=date("Y-m-d");
$sql="select * from booking_link where id='1'";
$r=mysql_query($sql);
$row=mysql_fetch_array($r);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>El Gouna Mobile App Administration Area </title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
    <script src="lib/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="Adminfunction.js" type="text/javascript"></script>
<script>
$( document ).ready(function() {
   <!-- Call function each 15 mins -->
});
</script>
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
        textarea {
            width: 95.2%;
            height: 250px;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    <div class="navbar">
        <?php include("header.php");?>
    </div>
    


    
    <?php include("menu.php");?>
    

    
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Manage El Gouna App Links</h1>
        </div>
        
              

        <div class="container-fluid">
        <div class="row-fluid">
        
        <div id="success-msg" class="alert alert-success" style="text-align:center; <?php if($_GET['fl']!=1){?>display:none<?php }?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Your Process has been done scuccessfully</strong>
    </div>
    
    
    
    <div id="fault-msg" class="alert alert-error" style="text-align:center;<?php if($_GET['fl']!=2){?>display:none<?php }?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Your Process has been failed</strong>
    </div>
        </div>
        
        
            <div class="row-fluid">
                    

<div id="dataList">
<div id="logdingImg" style="text-align:center;"><div class="row-fluid" >
    
    <div class="block span12" >
        <div class="block-body">
            
            <form action="doBooking_link.php?id=1"  method="post" enctype="multipart/form-data" name="coolform" id="coolform" onSubmit="return false;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
 
  <tr>
    <td></td>
  </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
        
        <tr>
          <td width="150" valign="top"><strong>
            <label>Booking Link:</label>
          </strong></td>
          <td valign="top"><input name="bookingURL" id="bookingURL" type="text" value="<?php echo $row['bookingURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>
          <td valign="top"><strong>
            <label>Facebook Link:</label>
          </strong></td>
          <td valign="top"><input name="facebookURL" id="facebookURL" type="text" value="<?php echo $row['facebookURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
        </tr>
        
        
        <tr>
          <td valign="top"><strong>
            <label>Twitter Link:</label>
          </strong></td>
          <td valign="top"><input name="twitterURL" id="twitterURL" type="text" value="<?php echo $row['twitterURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>
          <td valign="top"><strong>
            <label>Elgouna Link:</label>
          </strong></td>
          <td width="60" valign="top"><input name="elgounaURL" id="elgounaURL" type="text" value="<?php echo $row['elgounaURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
        </tr>
        <tr>
          <td valign="top"><strong>
            <label>Instagram Link:</label>
          </strong></td>
          <td valign="top"><input name="instagramURL" id="instagramURL" type="text" value="<?php echo $row['instagramURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>
          <td valign="top"><strong>
            <label>YouTube Link:</label>
          </strong></td>
          <td width="60" valign="top"><input name="youtubeURL" id="youtubeURL" type="text" value="<?php echo $row['youtubeURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
        </tr>
        <tr>
          <td valign="top"><strong>
            <label>Snapchat Link:</label>
          </strong></td>
          <td valign="top"><input name="snapchatURL" id="snapchat" type="text" value="<?php echo $row['snapchatURL'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>  
          <td valign="top"><strong>
            <label>Elgouna SMS:</label>
          </strong></td>
          <td valign="top"><input name="elgounaSMS" id="elgounaSMS" type="text" value="<?php echo $row['elgounaSMS'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><strong>
            <label>Elgouna Phone:</label>
          </strong></td>
          <td width="60" valign="top"><input name="elgounaPhone" id="elgounaPhone" type="text" value="<?php echo $row['elgounaPhone'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>  
          <td width="150" valign="top">&nbsp;</td>
          <td valign="top"><strong>
            <label>Elgouna E-mail:</label>
          </strong></td>
          <td valign="top"><input name="elgounaemail" id="elgounaemail" type="text" value="<?php echo $row['elgounaemail'];?>" class="input-xlarge" style="width:300px; height:35px;"></td>
          <td width="150" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top"><strong>
            <label>About Us:</label>
          </strong></td>
            <td colspan="5">
                <textarea name="about" id="about"><?php echo trim($row['about']); ?></textarea>
            </td>
        </tr>
    </table></td>
  </tr>
  

  
  
</table>
</td>
  </tr>
  <tr>
    <td><table border="0" cellpadding="5" cellspacing="5">
   

  
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="btn-toolbar">
    <div id="buttonDiv"><button type="submit"  onClick="saveBooking();" class="btn btn-primary"><i class="icon-save"></i> Save </button></div>
 
  <div class="btn-group">  </div>
  
</div></td>
 <td width="150">&nbsp;</td>
 <td><div id="error-div" class="alert alert-error" style="width:200px; text-align:center; display:none">The fill the highlighted field</div></td>
  </tr>
  
</table></td>
  </tr>
</table>




    </form>
        </div>
    </div>
</div></div>
</div>





<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete this?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal" onClick="confirmDelete('2');">Delete</button>
    </div>
    <input type="hidden"  name="pagename" id="pagename">
    <input type="hidden"  name="pgidNo" id="pgidNo">
    <input type="hidden"  name="rowId" id="rowId">
</div>


                    
                     <?php include("footer.php");?>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


