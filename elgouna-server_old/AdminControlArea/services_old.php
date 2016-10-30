<?php 
session_start();
include("check_session.php");
include("../db_conn.php");
$date=date("Y-m-d");
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
    <script type="text/javascript" src="nicEdit-latest.js"></script>
<script>
$( document ).ready(function() {
   ListFn('<?php echo $_GET['pgid'];?>','servicesList.php');
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
  <body class="" style="font-family:Tahoma"> 
  <!--<![endif]-->
    
    <div class="navbar">
        <?php include("header.php");?>
    </div>
    


    
    <?php include("menu.php");?>
    

    
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Manage Hotel's Services</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="home.php">Home</a> <span class="divider">/</span></li>
            <li class="active"><a href="javascript:ListFn('0','servicesList.php');">Services List</a></li>
        </ul>

        <div class="container-fluid">
        <div class="row-fluid">
        <div id="success-msg" class="alert alert-success" style="text-align:center; <?php if($_GET['fl']!=1){?> display:none<?php }?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Process Done Successfully</strong>
    </div>
    
    
    <div id="fault-msg" class="alert alert-error" style="text-align:center; <?php if($_GET['fl']!=2){?> display:none<?php }?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Process failed.</strong>
    </div>
        </div>
            <div class="row-fluid">
                    
<div class="btn-toolbar"  id="addingDiv">
    <button class="btn btn-primary" onClick="javascript:addNewItem('createNewService.php','')"><i class="icon-plus"></i>Add New Service</button>
  <div class="btn-group">
  </div>
</div>


<div id="dataList">
<div id="logdingImg" style="text-align:center; display:none"><img src="loading_circle.gif"></div>
</div>





<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are You sure you want to delete this?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
        <button class="btn btn-danger" data-dismiss="modal" onClick="confirmDelete('1');">Delete</button>
    </div>
    <input type="hidden"  name="clientsType" id="clientsType" value="<?php echo $_GET['type'];?>">

    <input type="hidden"  name="pagename" id="pagename">
    <input type="hidden"  name="pgidNo" id="pgidNo">
    <input type="hidden"  name="rowId" id="rowId">
    <input type="hidden"  name="funcId" id="funcId">
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


