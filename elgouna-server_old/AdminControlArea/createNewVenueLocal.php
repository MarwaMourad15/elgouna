<head>
    <script src="lib/jquery-1.8.1.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js">
    </script>
    <script src="lib/bootstrap-filestyle.min.js">
    </script>
    <script type="text/javascript" src="Adminfunction.js">
    </script>
</head>
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
    width: 34%!important;
}
.error-message {
    float: left;
    display: none;
    margin: 0;
    text-align: center;
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
textarea {
    width: 98.5%!important;
}
/*.main-img-container {
    float: left;
    width: 350px;
    padding: 10px;
    background: white;
    border: 1px solid #999999;
    box-shadow: 5px 5px 10px #C3C3C3;
}*/
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
.file-text {
    display: inline-block;
    padding-left: 10px; 
    white-space: normal;
}
</style>
<div id="row-fluid" class="row-fluid" >
    <div class="block span12" >
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
                                <tr style="background: whitesmoke">
                                    <td style="width: 165px; height: 38px">
                                        <div class="required">
                                            <asterisk>
                                                *
                                            </asterisk>
                                            fields are required.
                                        </div>
                                    </td>
                                    <td style="vertical-align: top">
                                        <div id="error-div" 
                                            class="alert alert-error error-message">
                                            Please fill the highlighted field(s).
                                        </div>
                                        <div id="mismatch-div" 
                                            class="alert alert-error error-message">
                                            Passwords do not match.
                                        </div>
                                        <div id="missing-offer" 
                                            class="alert alert-error error-message">
                                            Please provide an offer.
                                        </div>
                                        <div id="missing-offerTitle" 
                                            class="alert alert-error error-message">
                                            Please provide a title for the offer.
                                        </div>
                                        <div id="missing-offerDesc" 
                                            class="alert alert-error error-message">
                                            Please describe the offer.
                                        </div>
                                        <div id="missing-main-img" 
                                            class="alert alert-error error-message">
                                            Please select a main image for the venue.
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
                                                        <option value="restaurant" selected="<?php if($id_received) echo $venue_to_be_updated_arr['type'] == 'restaurant' ? 'selected' : ''; ?>">
                                                            Restaurant
                                                        </option>
                                                        <option value="club" selected="<?php if($id_received) echo $venue_to_be_updated_arr['type'] == 'club' ? 'selected' : ''; ?>">
                                                            Club
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
                                                    <input type="text"  name="latitude" 
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
                                                    <input type="text"  name="longitude" 
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
                                                    <input type="text" name="score" 
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
                                                    <select name="rating" id="rating"  
                                                            class="input-xlarge">
                                                        <option value="">
                                                            Select Rating Star
                                                        </option>
<?php 

            for($i = 1; $i <= 7; $i++) {

?>
                                                         <option value = "<?php echo $i; ?>"

<?php 

                if($venue_to_be_updated_arr['ratingStar'] == $i) {

                    echo "selected";
                }

?>

                                                            ><?php echo $i; ?>
                                                         </option>
<?php 


            }

?>
                                                    </select>
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
                                            <tr style="display: none">
                                                <td>
                                                    <strong>
                                                        Description:
                                                    </strong>
                                                </td>
                                                <td>
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
                                    <td>
                                        <strong>Has Offer:</strong>                        
                                    </td>
                                    <td>
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
                                        <input type="text"  name="phone-number" 
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
                                All images should have a resolution no more than (960px &#10005; 630px).
                            </i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="5" cellpadding="5"
                                   class="fields" style="margin-top:20px">
<?php 

            if(!$id_received) {
                
?>
                                <tr style="background: whitesmoke;">
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Logo
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top" style="">
                                        <input type="file" name="venue-logo"
                                                id="venue-logo" 
                                                class="input-xlarge" />
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr style="background: whitesmoke;">
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Main Image
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top" style="">
                                        <input type="file" name="venue-main-img"
                                                id="venue-main-img" 
                                                class="input-xlarge" />
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
<?php
                
                $i = 2;
                for ($j = 0; $j < 4; $j++) {

?>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>: 
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top">
                                        <input type="file" name="venue-imgs[]"
                                                value="<?php echo $i; ?>" 
                                                id="venue-img-<?php echo $i; ?>" 
                                                class="input-xlarge" />
                                    </td>
<?php

                    $i++;                

?>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>: 
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top">
                                        <input type="file" name="venue-imgs[]"
                                                value="<?php echo $i; ?>" 
                                                id="venue-img-<?php echo $i; ?>" 
                                                class="input-xlarge" />
                                    </td>
                                </tr>
                           
<?php 
                    $i++;
                }
                
?>
                            </table>
                        </td>
                    </tr>
<?php

            } 
            else {
                $dir = '../images/venues/';
                
?>
                                <tr style="background: whitesmoke">
                                    <td valign="top">
                                        <label>
                                            <strong>
                                                Main Image:
                                            </strong>
                                            <asterisk>
                                                *
                                            </asterisk>
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td style='white-space:nowrap' valign="middle">
<?php

                $venue_to_be_updated_main_image_sql = "select * "
                        . "from venues_img "
                        . "where venue_id = '$venue_to_be_updated_id' "
                        . "order by id asc "
                        . "limit 1";
                $venue_to_be_updated_main_image_query = 
                        mysql_query($venue_to_be_updated_main_image_sql);
                if($venue_to_be_updated_main_image_query) {
                    $venue_to_be_updated_main_image_rows = 
                            mysql_num_rows($venue_to_be_updated_main_image_query);
                    if($venue_to_be_updated_main_image_rows > 0) {
                        
                        $venue_to_be_updated_main_image_arr = 
                                mysql_fetch_assoc($venue_to_be_updated_main_image_query);
                        $venue_to_be_updated_main_image = 
                                $venue_to_be_updated_main_image_arr['img'];
                        if(file_exists($dir . $venue_to_be_updated_main_image)) {
                            
?>
                                        <img class="main-thumb" src="<?= $dir . $venue_to_be_updated_main_image ?>"/>
                                        <input type="file" name="venue-main-img"
                                                id="main-img"
                                                value="venue-main-img"
                                                class="input-xlarge" 
                                                style="display:none"/>
                                        <img src="edito.png" id="alter-main-img" 
                                                name="main-img" 
                                                style="margin-left:30px;  
                                                cursor:pointer" />
                                        <div id="file-text" 
                                             class="file-text">
                                            
                                        </div>
<?php

                        }
                        else {
                            
?>
                                        <font style="font-size:14px">
                                            Image file does not exist.
                                        </font>
                                        <input type="file" name="venue-main-img"
                                                id="main-img"
                                                value="venue-main-img"
                                                class="input-xlarge" 
                                                style="display:none"/>
                                        <img src="edito.png" id="alter-main-img" 
                                                name="main-img" 
                                                style="margin-left:30px;  
                                                cursor:pointer" />
                                        <div id="file-text" 
                                             class="file-text">
                                            
                                        </div>
                                        
<?php
                            
                        }
                    }
                    else {
                        
?>
                                        <input type="file" name="venue-main-img"
                                                value="1" 
                                        id="venue-main-img" 
                                               class="input-xlarge" />
<?php

                    }
                }
                else {
                    
                    echo mysql_error();
                }

?>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
<?php
            
                $images_offset = 2;
                $venue_to_be_updated_images_sql = "select * "
                        . "from `venues_img` "
                        . "where `venue_id` = '$venue_to_be_updated_id' "
                        . "order by id asc "
                        . "limit 10 "
                        . "offset 1";
                $venue_to_be_updated_images_query = mysql_query($venue_to_be_updated_images_sql);
                if($venue_to_be_updated_images_query) {
                    
                    $venue_to_be_updated_images_rows 
                            = mysql_num_rows($venue_to_be_updated_images_query);
                    if($venue_to_be_updated_images_rows > 0) {
?>
                                <tr>
<?php
                        
                        while ($venue_to_be_updated_image_arr = 
                                mysql_fetch_assoc($venue_to_be_updated_images_query)) {

                            $venue_to_be_updated_image = 
                                    $venue_to_be_updated_image_arr['img'];

?>
                                <tr>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $images_offset; ?>:
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top" id="<?= $venue_to_be_updated_image_arr['id'] ?>">
                                        <img class="thumb" src="<?= $dir . $venue_to_be_updated_image ?>"/>
                                        <a href="javascript:remove_venue_image('removeVenueImage.php', '<?= $venue_to_be_updated_image_arr['id']; ?>', '<?= $venue_to_be_updated_image; ?>');" style="margin-left: 20px;">
                                            <img id="delete" src="deleto.png" />
                                        </a>
                                    </td>
                                </tr>
<?php

                            $images_offset++;
                        }
//                        if($venue_to_be_updated_images_rows % 2 == 0) {
                            
?>
                                <!--</tr>-->
<?php
                        
//                        }
                        $i = $images_offset;
                        $gallery_rows = ceil((10 - $i) / 2);
//                        for($j = 0; $j < $gallery_rows; $j++) {
                        for($i = $images_offset; $i < 10; $i++) {
                            
//                            if($venue_to_be_updated_images_rows % 2 == 0) {
                                
?>                          
                                <tr>
<?php

//                            }
                            
?>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>:
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
                                    </td>
                                    <td valign="top">
                                        <input type="file" name="venue-imgs[]"
                                                id="<?php echo $i ?>"
                                                value="venue-img-<?php echo $i ?>"
                                                class="input-xlarge" />
                                    </td>
<?php

//                            if($venue_to_be_updated_images_rows % 2 != 0) {
                                
//                                $i++;
?>
                                <!--</tr>-->
                                <!--<tr>-->
<?php

//                            }
//                            else {
                            
//                                $i++;

//                            }
?>                                    
<!--                                    <td valign="top">
                                        <label>
                                            Image <?php // echo $i; ?>:
                                        </label>
                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>
                                    </td>
                                    <td valign="top">
                                        <input type="file" name="venue-imgs[]"
                                                id="<?php // echo $i ?>"
                                                value="venue-img-<?php // echo $i ?>"
                                                class="input-xlarge" />
                                    </td>-->
<?php

//                            if($venue_to_be_updated_images_rows % 2 == 0) {
                                
//                                $i++;
?>
                                <!--</tr>-->
<?php

//                            }
//                            else {
                                
//                                $i++;
//                            }
?>
                                </tr>
<?php

                        }

                    }
                    else {
                        
                        for($i = $images_offset; $i < 10; $i++) {
                            
?>                            
                                <tr>
                                    <td valign="top">
                                        <label>
                                            Image <?php echo $i; ?>:
                                        </label>
<!--                                        <span style="font-size:11px;">
                                            (960px &#10005; 630px)
                                        </span>-->
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
            
?>
                                <tr>
                                    <td valign="top">
                                        
                                    </td>
                                </tr>
<?php

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
                                                                type="submit"  
                                                                onclick=
                                                                "saveEGXO();" 
                                                                class=
                                                                "btn 
                                                                btn-primary">
                                                                <i class=
                                                                   "icon-save"
                                                                   >
                                                                </i> 
                                                                Save 
                                                            </button>
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