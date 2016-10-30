<style>
    
    .pagination a.selected {
        background: #EFEFEF;
    }
    
</style>
<script src="lib/jquery-1.8.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function deleteTrans(tid) {
        console.log(tid);
        $('.btn-danger').click(function() {
            $("#logdingImg").show();
            $.ajax({
                type: "POST",
                url: "deleteTrans.php",
                data: {
                    trans_id: tid
                },
                success: function(data) {
                    $("#logdingImg").hide();
                    window.location.href = "?pgid=0&fl=1";
                    console.log(data);
                },
                error: function(data) {
                    $("#logdingImg").hide();
                    window.location.href = "?pgid=0&fl=2";
                    console.log(data);
                }
            });
        });
    }
</script>
<?php 

session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
global $D;
$all_trans_sql = "select *"
        . " from transportation";
$all_trans_query = mysql_query($all_trans_sql);
if($all_trans_query) {
    
    $all_trans_rows = mysql_num_rows($all_trans_query);
    if($all_trans_rows > 0) {
        
        $limit = 15;
        if(isset($_POST['pgid'])) {
            
            $page = $_POST['pgid'];
            if($page != 0) {
                
                $offset = ($page - 1) * $limit;
            }
            else {
                
                $page = 0;
                $offset = 0;
                $D = 0;
            }
        }
    }
    $pages = ceil($all_trans_rows / $limit);
}

//$end=$start+$limit;
$trans_sql = "select *"
        . " from transportation"
        . " order by id asc"
        . " limit $limit"
        . " offset $offset";
$trans_query = mysql_query($trans_sql);
if($trans_query) {
    
?>     
        <!--<div><h1><? //$_POST['pgid'] ?></h1></div>-->
        <div class="well">
            <table class="table"  style="">
                <thead style="">
                    <tr>
                        <th style="width:20px;">#</th>
                        <th style="width:400px;" >Type</th>
                        <th style="width:400px;" ></th>
                        <th style="width:400px;" ></th>
                        <th style="width:400px;" ></th>
                        <th style="width:400px;" ></th>
                        <th style="width: 26px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php 

    $trans_rows = mysql_num_rows($trans_query);
    if($trans_rows > 0) {

        $count = 0;
        while($trans_arr = mysql_fetch_assoc($trans_query)) {

            $count++;
            $is_even = $count % 2;
	   
?>
                    <tr 
<?php 

            if($is_even == 0) {
                            
?> 
                        style="background-color:#EFEFEF" 
<?php 

            }
                        
?>
                        >
                        <td width="20">
<?php 

            $page = $_POST['pgid'];
            echo isset($page)
                    ? (($page != 1 && $page != 0)
                            ? $count + (($_POST['pgid'] - 1) * 15) 
                            : $count) 
                    : $count; 
                            
?>
                        </td>
                        <td id="trans-name" colspan="5"
                            style="max-width:117px; 
                                    word-wrap: break-word; 
                                    white-space: normal">
<?php 

            echo $trans_arr['type'];
                            
?>
                        </td>
                        <td width="26">
                            <a href="javascript:addNewItem('createNewTrans.php?id=
<?php 

            echo $trans_arr['id'];
                                
?>
                               ','
<?php 

            echo $page;
                                
?>
                               ');">
                                <i class="fa fa-pencil">
                                </i>
                            </a>
                            <a href="#myModal" id="delete" role="button" data-toggle="modal" onclick="deleteTrans(<?= $trans_arr['id'] ?>)">
                                <i class="fa fa-remove">
                                    
                                </i>
                            </a>
                        </td>
                    </tr>
<?php 

        }
        if($all_trans_rows > $limit) {
?>
                </tbody>
            </table>
            <div class="pagination">
                <ul>        
<?php
            if($page > 1) {
                
?>
                    <li>
                        <a href='javascript:ListFn("<?= $page - 1 ?>", "transList.php")' 
                           title='previous page'>
                            &laquo; Prev
                        </a>
                    </li>
<?php
            }
            
            for($i = 1 ; $i <= $pages ; $i++) {
                
                if((!(isset($page)) || $page == 0) && $i == 1) {
                    
                    $is_selected = 'selected';
                }
                else {
                    
                    $is_selected = $i == $page ? 'selected' : '';
                }

?>
                    <li> 
                        <a href="javascript:ListFn('<?= $i ?>
                                   ','transList.php')" id="page-<?= $i ?>" title="page-<?= $i ?>" class="<?= $is_selected ?>">
                            <?= $i ?>
                        </a>
                    </li>
<?php 

            }
            if($page < $pages) {
                
?>
                    <li>
                        <a href='javascript:ListFn("<?= $page + 1 ?>", "transList.php")' 
                           title='next page'>
                            Next &raquo; 
                        </a>
                    </li>
<?php

            }
            
?>
                </ul>
            </div>
<?php

        }
    }
    else {
                        
?>
                    <tr>
                        <td colspan="6"> 
                            <p style="text-align:center; padding-top:20px; color:#3C5A9A; 
                               font-size:25px; font-weight:bold">
                                No trans found.
                            </p>
                        </td>
                    </tr>
<?php 

    }
                    
?>
                </tbody>
            </table>
        </div>
        <div class="modal small hide fade" id="myModal" tabindex="-1" 
                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                    aria-hidden="true">
                    ×
                </button>
                <h3 id="myModalLabel">Delete Confirmation</h3>
            </div>
            <div class="modal-body">
                <p class="error-text">
                    <i class="icon-warning-sign modal-icon">
                    </i>
                    Are You sure you want to delete transportation type?
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">
                    No
                </button>
                <button class="btn btn-danger" data-dismiss="modal">
                    Delete
                </button>
            </div>
            <input type="hidden"  name="clientsType" id="clientsType" value="<?php echo $_GET['type']; ?>">
            <input type="hidden"  name="pagename" id="pagename">
            <input type="hidden"  name="pgidNo" id="pgidNo">
            <input type="hidden"  name="rowId" id="rowId">
            <input type="hidden"  name="funcId" id="funcId">
        </div>
        <div id="logdingImg" style="text-align:center; display:none">
            <img src="loading_circle.gif">
        </div>
<?php 

}

?>

