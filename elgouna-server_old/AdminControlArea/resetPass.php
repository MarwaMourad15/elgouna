<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
$date=date("Y-m-d");
$sql="select * from admin where id=1";
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
  <body class=""  style="font-family:Tahoma"> 
  <!--<![endif]-->
    
    <div class="navbar">
       <?php include("header.php");?>
    </div>
    

 <?php include("menu.php");?>
    
    <div class="content"  style=" min-height:580px;">
        
        <div class="header">
            <div class="stats"></div>
          <h1 class="page-title" style=" ">Update Account Information</h1>
        </div>
        
                <div class="container-fluid">
            <div class="row-fluid">
          



<div class="row-fluid" id="error_msg" style="display:none" >

    <div class="alert alert-error" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"></button>
        <strong>Wrong Username or Password</strong> 
    </div>
    
</div>


<div class="row-fluid" >
    
    <div class="block span6 offset3" >
        <p class="block-heading" style=" ">Change username or password</p>
        <div class="block-body">
            
                <form action="#" method="post" enctype="multipart/form-data" onSubmit="return false;">
                <label style=" ">Username: </label>
                    <input type="text" name="username" id="username" value="<?php echo $row['username'];?>" class="span12" style=" ">
                    <label style=" ">Password: </label>
                    <input type="password" id="password" name="password" value="<?php echo $row['password'];?>" class="span12" style=" ">
                    <div id="loginButton"><input value="Update" type="submit" onClick="ChangeSetting();" class="btn btn-primary pull-right"></div>
                  
                    <div class="clearfix"></div>
                </form>
           
        </div>
    </div>
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


