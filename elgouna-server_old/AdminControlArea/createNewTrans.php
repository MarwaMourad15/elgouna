<script src="lib/typed-master/dist/typed.min.js"></script>
<script src="Adminfunction.js"></script>
<?php 
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$request_page = "saveTrans.php";    
$title = "Add New Transportation Type";
$id_received = isset($_GET['id']);
global $trans_to_be_updated_arr; 
if($id_received) {
    $request_page = "updateTrans.php";
    $trans_to_be_updated_id = $_GET['id'];
    $trans_to_be_updated_sql = "select * "
            . "from transportation "
            . "where id = '$trans_to_be_updated_id'";
    $trans_to_be_updated_query = mysql_query($trans_to_be_updated_sql);
    if($trans_to_be_updated_query) {
        $trans_to_be_updated_row = mysql_num_rows($trans_to_be_updated_query);
        if($trans_to_be_updated_row > 0) {
            $trans_to_be_updated_arr = mysql_fetch_assoc($trans_to_be_updated_query);
            $title = 'Update ' . $trans_to_be_updated_arr['type'] . ' Transportation Type';
        }
    }
}
?>
<style type="text/css">
asterisk {
    color:#FF0000;
    font-weight:bold;
}
table.checkboxes {
    width: 100%;
}
table.checkboxes td {
    padding: 0 0 36px 5px;
}
table.checkboxes td:nth-child(odd) {
    width: 16.6%!important;
    padding: 4px 0 35px 5px;
}
table.checkboxes td:nth-child(even) {
    width: 87.4%!important;
}
table.fields {
    width: 100%;
}
table.fields td {
    padding: 0 0 20px 5px;
}
table.fields td:nth-child(odd) {
    width: 16.6%!important;
    padding: 4px 0 20px 5px;
}
table.fields td:nth-child(even) {
    width: 83.4%!important;
}
table.images tr {
    border-top: 1px solid #dddddd;
}
table.images tr:nth-child(even) {
    background: #efefef;
}
table.images td:nth-child(even) {
    width: 34%!important;
}
.images td {
    padding: 15px 0 15px 0;
}
.error-message {
    float: left;
    display: none;
    padding: 8px;
    margin: 0;
    text-align: left;
    color: rgba(255,33,0,0.8);
    background: #e4e4e4;
}
.error-message span {
    color: rgba(0,0,0,0.8);
}
.required {
    float: left;
}
.top-table {
    margin-top: 0!important;
}
input {
    white-space: pre-wrap;
}
input[type="checkbox"] {
    margin: 0!important;
}
select {
    width: 284px!important;
}
.checkboxes textarea {
    width: 98.5%!important;
}
.fields textarea {
    width: 95.2%!important;
}
img.thumb {
    width: 190px;
    padding: 7px;
    border: 1px solid #999999;
    box-shadow: 5px 5px 10px #C3C3C3;
}
img.main-thumb {
    width: 257px;
    padding: 10px;
    border: 1px solid #999999;
    background: white;
    box-shadow: 5px 5px 10px #C3C3C3;
}
img.logo-thumb {
    width: 110px;
    padding: 10px;
    border: 1px solid #999999;
    background: white;
    box-shadow: 5px 5px 10px #C3C3C3;
}
.file-text {
    display: inline-block;
    padding-left: 10px; 
    white-space: normal;
}
.file-text a:hover {
    color: #0088cc;
    text-decoration: underline;
}
.starRating:not(old){
    overflow        : hidden;
    float           : left;
}
.starRating:not(old) > input{
    display         : none;
    float           : right;
    opacity         : 0;
}
.starRating:not(old) > label{
    display         : block;
    float           : right;
    width           : 30px;
    height          : 25px;
    margin          : 0!important;
    padding-right   : 5px;
    position        : relative;
    background      : url('../AdminControlArea/images/star-dead.png');
    background-size : contain;
    background-repeat: no-repeat;
}
.starRating:not(old) > label:not(:first-child){
    /*margin-right: -10px;*/
}
.starRating:not(old) > label:before{
    content         : '';
    display         : block;
    width           : 30px;
    height          : 25px;
    background      : url('../AdminControlArea/images/star.png');
    background-size : contain;
    background-repeat: no-repeat;
    opacity         : 0;
    transition      : opacity 0.05s linear;
}
.starRating:not(old) > label:hover:before,
.starRating:not(old) > label:hover ~ label:before,
.starRating:not(:hover) > :checked ~ label:before{
    opacity : 1;
}
#buttonDiv img {
    display: none;
    margin-left: 30px;
}
.tab10 {
    display: inline-block;
    width: 10px;
}
.mybutton {
    min-width: 100px;
}
.typed-cursor {
    opacity: 1;
}
</style>
<div id="row-fluid" class="row-fluid" >
    <div id="head" class="block span12" >
        <p class="block-heading" style=" ">
<?php 
echo $title;
?>
        </p>
        <div class="block-body">
            <form action="<?php echo $request_page; if($id_received) echo '?tid=' . $trans_to_be_updated_id; ?>" 
                  method="post" enctype="multipart/form-data" 
                  name="coolform" id="coolform" onSubmit="return false;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                    <tr>
                        <td>
                            <table class="top-table" width="100%" border="0" 
                                   cellpadding="0" cellspacing="0">
                                <tr style="background:whitesmoke">
                                    <td style="width:198px; padding:8px;
                                                vertical-align:top">
                                        <div class="required">
                                            <asterisk>
                                                *
                                            </asterisk>
                                            fields are required.
                                        </div>
                                    </td>
                                    <td style="vertical-align:top;">
                                        <div id="error-div" 
                                            class="error-message">
                                        </div>
<!--                                        <div id="mismatch-div" 
                                            class="alert alert-error error-message">
                                            Passwords do not match.
                                        </div>
                                        <div id="inv-score-div" 
                                            class="alert alert-error error-message">
                                            Review score cannot be more than 5.
                                        </div>
                                        <div id="inv-desc-div" 
                                            class="alert alert-error error-message">
                                            Please enter a valid description.
                                        </div>
                                        <div id="short-desc-div" 
                                            class="alert alert-error error-message">
                                            Description is too short.
                                        </div>
                                        <div id="missing-main-img" 
                                            class="alert alert-error error-message">
                                            Please select a main image for the trans.
                                        </div>
                                        <div id="missing-logo" 
                                            class="alert alert-error error-message">
                                            Please select a logo for the trans.
                                        </div>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" border="0" cellspacing="5" 
                                               cellpadding="5" class="fields">
                                            <tr>
                                                <td width="150">
                                                    <strong>
                                                        Type:
                                                    </strong>
                                                    <asterisk>
                                                        *
                                                    </asterisk>
                                                </td>
                                                <td>
                                                    <input type="text" name="type" 
                                                           id="type" value="<?php if($id_received) echo trim($trans_to_be_updated_arr['type']); ?>"
                                                           class="input-xlarge"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Description:
                                                    </strong>
                                                    <asterisk>
                                                        *
                                                    </asterisk>
                                                </td>
                                                <td colspan="3">
                                                    <textarea name="description" id="description" style="width:100%; height:150px"><?php echo trim($trans_to_be_updated_arr['description']); ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top">
                                                    <label>
                                                        <strong>
                                                            Image:
                                                        </strong>
                                                        <asterisk>
                                                            *
                                                        </asterisk>
                                                    </label>
                                                </td>
<?php
if($id_received) {
?>
                                                <td style='white-space:nowrap' valign="middle">
<?php
//    var_dump($trans_to_be_updated_arr);
    $trans_to_be_updated_image = $trans_to_be_updated_arr['img'];
    $dir = '../images/transportation/';
    if(file_exists($dir . $trans_to_be_updated_image)) {
?>
                                                    <img class="main-thumb" src="<?= $dir . $trans_to_be_updated_image ?>"/>
                                                    <input type="file" name="trans-img" id="trans-img" value="trans-img" class="input-xlarge" style="display:none"/>
                                                    <img src="e.png" id="alter-img" style="margin-left:30px;
                                                            cursor:pointer" />
                                                    <div id="file-text-img" class="file-text"></div>
<?php
    } 
    else {
?>
                                                    <font style="font-size:14px">Image file does not exist.</font>
                                                    <input type="file" name="trans-img" id="img" value="trans-img" class="input-xlarge" style="margin-left:20px"/>
<?php

    }
?>
                                                </td>
<?php
}
else {
?>                                              <td valign="top" style="">
                                                    <input type="file" name="trans-img" id="trans-img" class="input-xlarge" />
                                                </td>
<?php
}
?>
                                            </tr>
                                        </table>
                            <table border="0" cellpadding="5" cellspacing="5">
                                <tr>
                                    <td>
                                        <table border="0" 
                                               cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <div class="btn-toolbar">
                                                        <div id="buttonDiv">
                                                            <button 
                                                                onclick='javascript:ListFn("", "transList.php")'
                                                                class="btn btn-primary mybutton">
                                                                <i class="fa fa-chevron-left"></i> 
                                                                Back
                                                            </button>
                                                            <div class="tab10"></div>
                                                            <button 
                                                                type="submit"  
                                                                onclick=
                                                                "saveEGXT(<?php echo ($id_received) ? '1' : '0'; ?>);" 
                                                                class=
                                                                "btn 
                                                                btn-primary mybutton">
                                                                <i class=
                                                                   "fa fa-save"
                                                                   >
                                                                </i> 
                                                                Save 
                                                            </button>
                                                            <img src="loading.gif"/>
                                                        </div>
                                                        <div class="btn-group"> 
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="150">
                                                    &nbsp;
                                                </td>
                                                <td>    
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>

?>
