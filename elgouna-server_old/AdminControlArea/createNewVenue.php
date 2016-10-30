<script src="lib/typed-master/dist/typed.min.js"></script>
<script src="Adminfunction.js"></script>

<?php 

session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$request_page = "saveVenue.php";    
$title = "Add New Venue";
$id_received = isset($_GET['id']);
global $venue_to_be_updated_arr; 
if($id_received) {
    
    $request_page = "updateVenue.php";
    $page_id = $_POST['pgid'];
    $venue_to_be_updated_id = $_GET['id'];
    $venue_to_be_updated_sql = "select * "
            . "from venues "
            . "where id = '$venue_to_be_updated_id'";
    $venue_to_be_updated_query = mysql_query($venue_to_be_updated_sql);
    if($venue_to_be_updated_query) {
        
        $venue_to_be_updated_row = mysql_num_rows($venue_to_be_updated_query);
        if($venue_to_be_updated_row > 0) {
            
            $venue_to_be_updated_arr = mysql_fetch_assoc($venue_to_be_updated_query);
            $title = 'Update ' . $venue_to_be_updated_arr['name'] . ' Venue';
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
    max-width: 16.6%!important;
    padding: 4px 0 35px 5px;
}
table.checkboxes td:nth-child(even) {
    width: 87.4%!important;
    max-width: 87.4%!important;
}
table.fields {
    width: 100%;
}
table.fields td {
    padding: 0 0 20px 5px;
}
table.fields td:nth-child(odd) {
    width: 16.6%!important;
    max-width: 16.6%!important;
    padding: 4px 0 20px 5px;
}
table.fields td:nth-child(even) {
    width: 34%!important;
    max-width: 34%!important;
}
table.images {
    table-layout: fixed;
}
table.images tr {
    border-top: 1px solid #dddddd;
}
table.images tr:nth-child(even) {
    background: #efefef;
}
table.images td:nth-child(even) {
    width: 34%!important;
    max-width: 34%!important;
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
    white-space: nowrap;
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
            <form action="<?php echo $request_page; if($id_received) echo '?vid=' . $venue_to_be_updated_id; ?>" 
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
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table width="100%" border="0" cellspacing="5" 
                                               cellpadding="5" class="fields">
                                            <tr>
                                                <td width="150">
                                                    <strong>
                                                        Username:
                                                    </strong>
                                                    <asterisk>
                                                        *
                                                    </asterisk>
                                                </td>
                                                <td>
                                                    <input type="text" name="username" 
                                                           id="username" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['venueUsername']); ?>"
                                                           class="input-xlarge"/>
                                                </td>
                                                <td>
                                                    <strong>
                                                        Password: 
                                                        <asterisk>
                                                            *
                                                        </asterisk>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="password" 
                                                           name="password" 
                                                           id="password" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['venuePass']); ?>" 
                                                           class="input-xlarge"/>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Name: 
                                                        <asterisk>
                                                            *
                                                        </asterisk>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="text"  name="name" 
                                                           id="name" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['name']); ?>" 
                                                           class = "input-xlarge"/>
                                                </td>
                                                <td width="150">
                                                    <strong>
                                                        Confirm Password:
                                                    </strong>
                                                    <asterisk>
                                                        *
                                                    </asterisk>
                                                </td>
                                                <td>
                                                    <input type="password" 
                                                           name="confirm" 
                                                           id="confirm" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['venuePass']); ?>" 
                                                           class="input-xlarge"/>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Location: 
                                                        <asterisk>
                                                            *
                                                        </asterisk>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="text"  name="location" 
                                                           id="location" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['location']); ?>" 
                                                           class="input-xlarge" 
                                                           style=" "/>
                                                </td>
                                                <td width="150">
                                                    <strong>
                                                        Type:
                                                    </strong>
                                                    <asterisk>
                                                        *
                                                    </asterisk>
                                                </td>
                                                <td>
                                                    <select name="type" id="type"  
                                                            class="input-xlarge">
                                                        <option value="default">
                                                            Select Venue Type
                                                        </option>
                                                        <option value="Restaurant" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Restaurant' ? 'selected' : ''; } ?>>
                                                            Restaurant
                                                        </option>
                                                        <option value="Bar" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Bar' ? 'selected' : ''; } ?>>
                                                            Bar
                                                        </option>
                                                        <option value="Restaurant and Bar" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Restaurant and Bar' ? 'selected' : ''; } ?>>
                                                            Restaurant & Bar
                                                        </option>
                                                        <option value="Bar and Lounge" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Bar and Lounge' ? 'selected' : ''; } ?>>
                                                            Bar & Lounge
                                                        </option>
                                                        <option value="Restaurant and Lounge" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Restaurant and Lounge' ? 'selected' : ''; } ?>>
                                                            Restaurant & Lounge
                                                        </option>
                                                        <option value="Cafe" <?php if($id_received) { echo $venue_to_be_updated_arr['type'] == 'Cafe' ? 'selected' : ''; } ?>>
                                                            Café
                                                        </option>
                                                            Café & Restaurant
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Latitude: 
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="number"  name="latitude" 
                                                           id="latitude" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['latitude']); ?>" 
                                                           onkeypress="return numbersonly
                                                               (event, false)"  
                                                               class="input-xlarge" 
                                                               style=" "/>
                                                </td>
                                                <td>
                                                    <strong>
                                                        Longitude: 
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="number"  name="longitude" 
                                                           id="longitude" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['longitude']); ?>" 
                                                           onkeypress="return numbersonly
                                                               (event, false)"  
                                                               class="input-xlarge" 
                                                               style=" "/>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Reivew Score:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="number" name="score" 
                                                           id="rev-score" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['reviewScore']); ?>" 
                                                            class="input-xlarge" 
                                                            style=""/>
                                                </td>
                                                <td>
                                                    <strong>
                                                        Rating Star:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <span class="starRating">
                                                        <input id="rating7" type="radio" 
                                                               name="rating" value="7"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '7' ? 'checked' : ''; } ?>>
                                                        <label for="rating7"></label>
                                                        <input id="rating6" type="radio" 
                                                               name="rating" value="6"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '6' ? 'checked' : ''; } ?>>
                                                        <label for="rating6"></label>
                                                        <input id="rating5" type="radio" 
                                                               name="rating" value="5"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '5' ? 'checked' : ''; } ?>>
                                                        <label for="rating5"></label>
                                                        <input id="rating4" type="radio" 
                                                               name="rating" value="4"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '4' ? 'checked' : ''; } ?>>
                                                        <label for="rating4"></label>
                                                        <input id="rating3" type="radio" 
                                                               name="rating" value="3"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '3' ? 'checked' : ''; } ?>>
                                                        <label for="rating3"></label>
                                                        <input id="rating2" type="radio" 
                                                               name="rating" value="2"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '2' ? 'checked' : ''; } ?>>
                                                        <label for="rating2"></label>
                                                        <input id="rating1" type="radio" 
                                                               name="rating" value="1"
                                                               <?php if($id_received) { echo $venue_to_be_updated_arr['ratingStar'] == '1' ? 'checked' : ''; }
                                                               else { echo 'checked'; }?>>
                                                        <label for="rating1"></label>
                                                    </span>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="150">
                                                    <strong>
                                                        Order:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="text" name="order" 
                                                           id="order" value="<?php if($id_received) echo trim($venue_to_be_updated_arr['ord']); ?>" 
                                                           onkeypress = "return 
                                                               numbersonly
                                                               (event, false)"  
                                                            class="input-xlarge" 
                                                            style = " "/>
                                                </td>
                                                <td>
                                                    &nbsp;
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
                                                    <textarea name="description" id="description" style="width:100%; height:150px"><?php echo trim($venue_to_be_updated_arr['description']); ?></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="checkboxes">
                                            <tr>
                                                <td>
                                                    <strong>
                                                        WiFi:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="checkbox" 
                                                           name="wifi-check"
                                                           value="available"
<?php

            if($id_received) echo $venue_to_be_updated_arr['wifiCheck'] == 1 ? 'checked' : '';

?>
                                                           
                                                           />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>
                                                        Visa Payment:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="checkbox" 
                                                           name="visa-check"
                                                           value="available"
<?php

            if($id_received) echo $venue_to_be_updated_arr['visaCheck'] == 1 ? 'checked' : '';

?>
                                                           />
                                                </td>
                                                <tr>
                                                <td>
                                                    <strong>
                                                        Dining-in:
                                                    </strong>
                                                </td>
                                                <td>
                                                    <input type="checkbox" 
                                                           name="dining-check"
                                                           value="available"
<?php
            if($id_received) echo $venue_to_be_updated_arr['diningCheck'] == 1 ? 'checked' : '';
?>
                                                        />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr bgcolor="#89080E">
                      <td style="background-color:#89080E; color:#FFFFFF; 
                          padding:10px 0px 10px 10px">
                          Offers
                      </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <table class="checkboxes">
                                <tr>
                                    <td style="padding:4px 0 20px 5px">
                                        <strong>Has Offer:</strong>                        
                                    </td>
                                    <td style="padding:4px 0 20px 5px">
                                        <input type="checkbox"  name="offer-check" 
                                                id="offer" value="available" 
                                                class="input-xlarge"
<?php

            if($id_received) echo $venue_to_be_updated_arr['offerCheck'] == 1 ? 'checked' : '';
                                                
?>
                                                
                                                />
                                    </td>
                                </tr>
                                <tr id="offer-title-row" style="display: none">
                                    <td>
                                        <strong>
                                            Offer Title:
                                        </strong>
                                        <asterisk>
                                            *
                                        </asterisk>
                                    </td>
                                    <td>
                                        <input type="text"  name="offer-title" 
                                                id="offer-title" 
                                                value="<?= $venue_to_be_updated_arr['offerTitle'] ?>" 
                                                class="input-xlarge"/>
                                    </td>
                                </tr>
                                <tr id="offer-desc-row" style="display: none">
                                    <td>
                                        <strong>
                                            Offer Details:
                                        </strong>
                                        <asterisk>
                                            *
                                        </asterisk>
                                    </td>
                                    <td>
                                        <textarea name="offer-description" id="offer-description" style="width:100%; height:150px"><?php echo trim($venue_to_be_updated_arr['offerDescription']); ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; 
                            padding:10px 0px 10px 10px">
                            Contact Information
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="5" 
                                   cellpadding="5" class="fields" style="margin-top:25px">
                                <tr>
                                    <td width="150" style="display:none">
                                        <strong> 
                                            Elgouna Voice: 
                                        </strong>
                                    </td>
                                    <td style="display:none">
                                        <input type="text"  name="elgounaVoice" 
                                               id="elgounaVoice" 
                                               value="<?= $venue_to_be_updated_arr['elgounaVoice'] ?>"
                                               class="input-xlarge" style=" "/>
                                    </td>
                                    <td>
                                        <strong> 
                                            E-mail:
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text"  name="email" id="email" 
                                               value="<?= $venue_to_be_updated_arr['email'] ?>"
                                               class="input-xlarge" style=" "/>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>
                                            Phone Number:
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="number"  name="phone-number" 
                                               id="phone-number" 
                                               value="<?= $venue_to_be_updated_arr['phoneNumber'] ?>"
                                               class="input-xlarge" style=""/>
                                    </td>
                                    <td>
                                        <strong> 
                                            Info:
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text" name="info" id="info" 
                                                value="<?= $venue_to_be_updated_arr['info'] ?>"
                                                class="input-xlarge" style=""/>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong> 
                                            Facebook Link:
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text"  name="facebook-link" 
                                               id="facebook-link" 
                                               value="<?= $venue_to_be_updated_arr['facebookLink'] ?>"
                                               class="input-xlarge" style=""/>
                                    </td>
                                    <td>
                                        <strong> 
                                            Twiteer Link:
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text"  name="twitter-link" 
                                               id="twitter-link" 
                                               value="<?= $venue_to_be_updated_arr['twitterLink'] ?>"
                                               class="input-xlarge" style=""/>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong> 
                                            Instagram Link: 
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text" name="instagram-link" 
                                               id="instagram-link" 
                                               value="<?= $venue_to_be_updated_arr['instagramLink'] ?>"
                                               class="input-xlarge" style=""/>
                                    </td>
                                    <td>
                                        <strong> 
                                            YouTube Link: 
                                        </strong>
                                    </td>
                                    <td>
                                        <input type="text" name="youtube-link" 
                                               id="youtube-link" 
                                               value="<?= $venue_to_be_updated_arr['youtubeLink'] ?>"
                                               class="input-xlarge" style=" "/>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; 
                            padding:10px 0px 10px 10px">
                            Upload Images
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:10px">
                            <i style="font-size:13px">
                                All images should have a resolution of no more than 960px &#10005; 630px.
                            </i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="5" cellpadding="5" class="images" style="margin-top:20px">
                                    <td style="padding:0; vertical-align:top">
                                        <div id="missing-main-img" 
                                            class="alert alert-error error-message">
                                            Please select a main image for the venue.
                                        </div>
                                        <div id="missing-logo" 
                                            class="alert alert-error error-message">
                                            Please select a logo for the venue.
                                        </div>
                                    </td>
                                    <td style="padding:0"></td><td style="padding:0"></td>
                                </tr>-->
<?php if(!$id_received) { ?>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Logo:
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
                                    </td>
                                    <td valign="top" style=""><input type="file" name="venue-logo" id="venue-logo" class="input-xlarge" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Main Image:
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
                                    </td>
                                    <td valign="top" style="">
                                        <input type="file" name="venue-main-img" id="venue-main-img" class="input-xlarge" />
                                    </td>
                                    <td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
<?php
                $i = 2;
                for ($j = 0; $j < 4; $j++) {
?>
                                <tr>
                                    <td valign="top">
                                        <label>Image <?php echo $i; ?>:</label>
                                    </td>
                                    <td valign="top"><input type="file" name="venue-imgs[]" value="<?php echo $i; ?>" id="venue-img-<?php echo $i; ?>" class="input-xlarge" /></td>
<?php $i++; ?>
                                    <td valign="top"><label>Image <?php echo $i; ?>:</label></td>
                                    <td valign="top">
                                        <input type="file" name="venue-imgs[]" value="<?php echo $i; ?>" id="venue-img-<?php echo $i; ?>" class="input-xlarge" />
                                    </td>
                                </tr>
                           
<?php     $i++;
                }   ?>
                            </table>
                        </td>
                    </tr>
<?php

            } 
            else {
                $dir = '../images/venues/';
?>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Logo:
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
                                    </td>
                                    <td style='white-space:nowrap' valign="middle">
<?php
                $venue_to_be_updated_logo_sql = "select * "
                        . "from venues_img "
                        . "where venue_id = '$venue_to_be_updated_id' "
                        . "order by id asc "
                        . "limit 1";
                $venue_to_be_updated_logo_query = mysql_query($venue_to_be_updated_logo_sql);
                if($venue_to_be_updated_logo_query) {
                    $venue_to_be_updated_logo_rows = mysql_num_rows($venue_to_be_updated_logo_query);
                    if($venue_to_be_updated_logo_rows > 0) {
                        $venue_to_be_updated_logo_arr = mysql_fetch_assoc($venue_to_be_updated_logo_query);
                        $venue_to_be_updated_logo = 
                                $venue_to_be_updated_logo_arr['img'];
                        if(file_exists($dir . $venue_to_be_updated_logo)) {
?>
                                        <img class="logo-thumb" src="<?= $dir . $venue_to_be_updated_logo ?>"/>
                                        <input type="file" name="venue-logo" id="venue-logo" value="venue-logo" class="input-xlarge" style="display:none"/>
                                        <img src="e.png" id="alter-logo" name="logo" style="margin-left:30px;
                                                cursor:pointer" />
                                        <div id="file-text-logo" class="file-text">
                                        </div>
<?php

                        }
                        else {

?>
                                        <font style="font-size:14px">Logo file does not exist.</font>
                                        <input type="file" name="venue-logo" id="venue-logo" value="venue-logo" class="input-xlarge" style="margin-left:20px"/>
                                        <div id="file-text-logo" class="file-text"></div>
                                        
<?php
                            
                        }
                    } else {
                        
?>
                                        <input type="file" name="venue-logo" id="venue-logo" class="input-xlarge" />
<?php

                    }
                }
                else {
                    
                    echo mysql_error();
                }

?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Main Image:
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
                                    </td>
                                    <td style='white-space:nowrap' valign="middle">
<?php

                $venue_to_be_updated_main_image_sql = "select * " . "from venues_img " . "where venue_id = '$venue_to_be_updated_id' " . "order by id asc " . "limit 1 " . "offset 1";
                $venue_to_be_updated_main_image_query = mysql_query($venue_to_be_updated_main_image_sql);
                if($venue_to_be_updated_main_image_query) {
                    $venue_to_be_updated_main_image_rows = mysql_num_rows($venue_to_be_updated_main_image_query);
                    if($venue_to_be_updated_main_image_rows > 0) {
                        $venue_to_be_updated_main_image_arr = mysql_fetch_assoc($venue_to_be_updated_main_image_query);
                        $venue_to_be_updated_main_image = $venue_to_be_updated_main_image_arr['img'];
                        if(file_exists($dir . $venue_to_be_updated_main_image)) {
?>
                                        <img class="main-thumb" src="<?= $dir . $venue_to_be_updated_main_image ?>"/>
                                        <input type="file" name="venue-main-img" id="main-img" value="venue-main-img" class="input-xlarge" style="display:none"/>
                                        <img src="e.png" id="alter-main-img" name="main-img" style="margin-left:30px;
                                                cursor:pointer" />
                                        <div id="file-text-main-img" class="file-text"/>
<?php
                        } else {
?>
                                        <font style="font-size:14px">Image file does not exist.</font>
                                        <input type="file" name="venue-main-img" id="main-img" value="venue-main-img" class="input-xlarge" style="margin-left:20px"/>
                                        <div id="file-text-main-img" class="file-text"/>
<?php
                            
                        }
                    } else {
?>
                                        <input type="file" name="venue-main-img" id="venue-main-img" class="input-xlarge" />
<?php
                    }
                } else {
                    echo mysql_error();
                }
?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
<?php
            
                $images_offset = 2;
                $venue_to_be_updated_images_sql = "select * " 
                        . "from `venues_img` " 
                        . "where `venue_id` = '$venue_to_be_updated_id' " 
                        . "order by id asc " 
                        . "limit 10 " 
                        . "offset 2";
                $venue_to_be_updated_images_query = mysql_query($venue_to_be_updated_images_sql);
                if($venue_to_be_updated_images_query) {
                    $venue_to_be_updated_images_rows = mysql_num_rows($venue_to_be_updated_images_query);
                    if($venue_to_be_updated_images_rows > 0) {
                        while ($venue_to_be_updated_image_arr = mysql_fetch_assoc($venue_to_be_updated_images_query)) {
                            $venue_to_be_updated_image = $venue_to_be_updated_image_arr['img'];
?>
                                <tr>
                                    <td valign="top">
                                        <label>Image <?php echo $images_offset; ?>:</label>
                                    </td>
                                    <td valign="top" id="<?= $venue_to_be_updated_image_arr['id'] ?>">
                                        <img class="thumb" src="<?= $dir . $venue_to_be_updated_image ?>"/>
                                        <a href="javascript:remove_venue_image('removeVenueImage.php', '<?= $venue_to_be_updated_image_arr['id']; ?>', '<?= $venue_to_be_updated_image; ?>');" style="margin-left: 30px;">
                                            <img id="delete" src="d.png" />
                                        </a>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
<?php
                            $images_offset++;
                        }
                        $i = $images_offset;
                        $gallery_rows = ceil((10 - $i) / 2);
                        for($i = $images_offset; $i < 10; $i++) {
                            
?>
                            <tr>
                                <td valign="top">
                                    <label>Image <?php echo $i; ?>:</label>
                                </td>
                                <td valign="top">
                                    <input type="file" name="venue-imgs[]" value="<?php echo $i; ?>" id="venue-img-<?php echo $i; ?>" class="input-xlarge" />
                                </td>
<?php 
    
                            $i++; 
                            
?>
                                <td valign="top">
                                    <label>
                                        Image <?php echo $i; ?>:
                                    </label>
                                </td>
                                <td valign="top">
                                    <input type="file" name="venue-imgs[]" value="<?php echo $i; ?>" id="venue-img-<?php echo $i; ?>" class="input-xlarge" />
                                </td>
                            </tr>
<?php

                        }

                    }
                    else {
                        
                        for($i = $images_offset; $i <= 10; $i++) {
                            
?>                            
                                <tr>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="file" name="venue-imgs[]"
                                                id="<?php echo $i ?>"
                                                value="venue-img-<?php echo $i ?>"
                                                class="input-xlarge" />
                                    </td>
<?php
                            $i++;
?>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>:
                                        </label>
                                    </td>
                                    <td>
                                        <input type="file" name="venue-imgs[]"
                                                id="<?php echo $i ?>"
                                                value="venue-img-<?php echo $i ?>"
                                                class="input-xlarge" />
                                    </td>
                                </tr>
<?php

                        }
                    }
                }
                else {
                    
                    echo mysql_error();
                }
            }
            
?>
                            </table>
                        </td>
                    </tr>
<?php 

                                     

?>
                    <tr>
                        <td>
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
                                                                onclick='javascript:ListFn("<?= $page_id ?>", "venuesList.php")'
                                                                class="btn btn-primary mybutton">
                                                                <i class="fa fa-chevron-left"></i> 
                                                                Back
                                                            </button>
                                                            <div class="tab10"></div>
                                                            <button 
                                                                type="submit"  
                                                                onclick=
                                                                "saveEGXO(<?php echo ($id_received) ? '1' : '0'; ?>);" 
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
