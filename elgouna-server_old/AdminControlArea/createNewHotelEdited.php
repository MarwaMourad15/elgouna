<?php
session_start();
include("../db_conn.php");

date_default_timezone_set('Africa/Cairo');
$respPage = "saveHotel.php?id=0";
$title = "Add New Hotel";
if ($_GET['id'] != '') {
    $sql = "select * from hotels where id='$_GET[id]' ";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $respPage = "updateHotel.php?id=" . $row['id'];
    $title = "Update Hotel";
}
?>
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
        <p class="block-heading" style=" "><?php echo $title; ?></p>
        <div class="block-body">

            <form action="<?php echo $respPage; ?>&pgid=<?php echo $_POST['pgid']; ?>&type=<?php echo $_GET['type']; ?>" method="post" enctype="multipart/form-data" name="coolform" id="coolform" onSubmit="return false;">
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
                                                <td><input type="text"  name="ord" id="ord" value="<?php echo $row['ord']; ?>"onkeypress="return numbersonly(event, false)"  class="input-xlarge" style=" "/></td>
                                                <td><strong>
                                                        Name: <astrex>*</astrex>
                                                    </strong></td>
                                                <td><input type="text"  name="name" id="name" value="<?php echo $row['name']; ?>" class="input-xlarge" style=" "/></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>
                                                        Rating Star: 
                                                    </strong></td>
                                                <td><select name="rating" id="rating"  class="input-xlarge" style=" ">
                                                        <option value="">Select Rating Star</option>
                                                        <?php for ($i = 1; $i <= 7; $i++) { ?>
                                                            <option value="<?php echo $i; ?>" <?php if ($row['ratingStar'] == $i) {
                                                            echo "selected";
                                                        } ?>><?php echo $i; ?></option>
<?php } ?>
                                                    </select></td>
                                                <td><strong>
                                                        Location: <astrex>*</astrex>
                                                    </strong></td>
                                                <td><input type="text"  name="location" id="location" value="<?php echo $row['location']; ?>" class="input-xlarge" style=" "/></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>
                                                        Latitude: 
                                                    </strong></td>
                                                <td><input type="text"  name="latitude" id="latitude" value="<?php echo $row['latitude']; ?>"onkeypress="return numbersonly(event, false)"  class="input-xlarge" style=" "/></td>
                                                <td><strong>
                                                        Longitude: 
                                                    </strong></td>
                                                <td><input type="text"  name="longitude" id="longitude" value="<?php echo $row['longitude']; ?>"onkeypress="return numbersonly(event, false)"  class="input-xlarge" style=" "/></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong> Pid: </strong></td>
                                                <td><input type="text"  name="pid" id="pid" value="<?php echo $row['pid']; ?>"onkeypress="return numbersonly(event, false)"  class="input-xlarge" style=" "/></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr bgcolor="#89080E">
                                    <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Description</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                                            <tr>
                                                <td width="150" valign="top"><strong>Details: <astrex>*</astrex></strong></td>
                                                <td><textarea name="descrip" id="descrip" style="width:100%; height:150px;"><?php echo str_replace('\"', '"', str_replace("\'", "'", $row['descrip'])); ?></textarea></td>
                                            </tr>
                                            <tr>
                                                <td valign="top"><strong>Accomadtion Type: </strong></td>
                                                <td><textarea name="accomadtionType" id="accomadtionType" style="width:100%; height:150px;"><?php echo str_replace('\"', '"', str_replace("\'", "'", $row['accomadtionType'])); ?></textarea></td>
                                            </tr>
                                        </table></td>
                                </tr>

                            </table></td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Offers</td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                                <tr>
                                    <td width="150">
                                        <strong>Offer Exist:</strong>                        </td>
                                    <td><input type="checkbox"  name="offerExists" id="offerExists" value="1" <?php if ($row['offerExists'] == 1) {
    echo "checked";
} ?> class="input-xlarge" style="direction:rtl"/></td>
                                    <td width="100">&nbsp;</td>
                                </tr>

                            </table></td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                                <tr>
                                    <td width="150" valign="top"><strong>Offer Title:</strong></td>
                                    <td><input type="text"  name="offerTitle" id="offerTitle" value="<?php echo $row['offerTitle']; ?>"  class="input-xlarge" style=" "/></td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top"><strong>Offer Details:</strong></td>
                                    <td><textarea name="offerDescription" id="offerDescription" style="width:100%; height:150px"><?php echo str_replace('\"', '"', str_replace("\'", "'", $row['offerDescription'])); ?></textarea></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Facilities</td>
                    </tr>
                    <tr>
                        <td><table border="0" cellspacing="5" cellpadding="5">
                                <tr valign="top">
                                    <?php
                                    $sql_s = "select * from services where hidden=0 order by ord asc";
                                    $r_s = mysql_query($sql_s);
                                    $d = 0;
                                    while ($row_s = mysql_fetch_array($r_s)) {
                                        $d++;
                                        $n_ex = 0;
                                        if ($_GET['id'] != '') {
                                            $sql_ex = "select id from services_hotel where service_id='$row_s[id]' and hotel_id='$_GET[id]'";
                                            $r_ex = mysql_query($sql_ex);
                                            $n_ex = mysql_num_rows($r_ex);
                                        }
                                        ?>
                                        <td><input  name="check<?php echo $row_s['id']; ?>" type="checkbox" class="input-xlarge " id="check<?php echo $row_s['id']; ?>" style="direction:rtl" value="<?php echo $row_s['id']; ?>" <?php if ($n_ex != 0) {
                                        echo "checked";
                                    } ?>/></td>
                                        <td><strong>
                                        <?php echo $row_s['title']; ?>
                                            </strong></td>
                                        <td width="20">&nbsp;</td>
    <?php
    if ($d == 6) {
        $d = 0;
        echo '</tr><tr>';
    }
}
?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Contact Information</td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
                                <tr>
                                    <td width="150" style="display:none"><strong> Elgouna Voice: </strong></td>
                                    <td style="display:none"><input type="text"  name="elgounaVoice" id="elgounaVoice" value="<?php echo $row['elgounaVoice']; ?>"  class="input-xlarge" style=" "/></td>
                                    <td><strong> E-mail:</strong></td>
                                    <td><input type="text"  name="email" id="email" value="<?php echo $row['email']; ?>" class="input-xlarge" style=" "/></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone Number:
                                        </strong></td>
                                    <td><input type="text"  name="phoneNumber" id="phoneNumber" value="<?php echo $row['phoneNumber']; ?>" class="input-xlarge" style=" "/></td>
                                    <td><strong> info:
                                        </strong></td>
                                    <td><input type="text"  name="info" id="info" value="<?php echo $row['info']; ?>" class="input-xlarge" style=" "/></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong> Facebook Link:
                                        </strong></td>
                                    <td><input type="text"  name="facebookLink" id="facebookLink" value="<?php echo $row['facebookLink']; ?>" class="input-xlarge" style=" "/></td>
                                    <td><strong> Twiteer Link:
                                        </strong></td>
                                    <td><input type="text"  name="twitterLink" id="twitterLink" value="<?php echo $row['twitterLink']; ?>" class="input-xlarge" style=" "/></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong> Instagram Link: </strong></td>
                                    <td><input type="text"  name="instagramLink" id="instagramLink" value="<?php echo $row['instagramLink']; ?>" class="input-xlarge" style=" "/></td>
                                    <td><strong> YouTube Link: </strong></td>
                                    <td><input type="text"  name="youtubeLink" id="youtubeLink" value="<?php echo $row['youtubeLink']; ?>" class="input-xlarge" style=" "/></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr bgcolor="#89080E">
                        <td style="background-color:#89080E; color:#FFFFFF; padding:10px 0px 10px 10px">Upload Images</td>
                    </tr>
                    <tr>
                        <td><table width="100%" border="0" cellspacing="5" cellpadding="5">
<?php
if ($_GET['id'] == '') {
    ?>  <?php
                                for ($i = 1; $i <= 10; $i++) {
        ?>
                                        <tr>

                                            <td valign="top"><label><?php if ($i == 1) {
                                    echo "Main Image";
                                } else { ?>Image :<?php } ?></label><span style="font-size:11px;">(960px X 630px)</span></td>
                                            <td valign="top"><input type="file"  name="simg<?php echo $i; ?>" id="simg<?php echo $i; ?>"  class="input-xlarge" /></td>
                                            <td width="130" valign="top">&nbsp;</td>
                                        </tr>
    <?php } ?>

<?php } else { ?>
    <?php
    $sql_p = "select * from hotels_img where hotel_id='$_GET[id]'";
    $r_p = mysql_query($sql_p);
    $z = 0;
    $n = 0;
    while ($row_p = mysql_fetch_array($r_p)) {
        $z++;
        ?>
                                        <tr>
                                            <td valign="top"><label><?php if ($z == 1) {
            $n = 1;
            echo "Main image";
        } else { ?>Image :<?php } ?></label><span style="font-size:11px;">(960px X 630px)</span></td>
                                            <td valign="top"><input type="file"  name="simgxx<?php echo $z; ?>" id="simgxx<?php echo $z; ?>"  class="input-xlarge" /></td>
                                            <td width="60" valign="top">&nbsp;</td>
                                            <td valign="top" id="serviceImg<?php echo $row_p['id']; ?>"><?php if ($row_p['img'] != '' && file_exists('../images/hotels/' . $row_p['img'])) { ?>
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td valign="top"><img src="../images/hotels/<?php echo $row_p['img']; ?>" width="100" /></td>
            <?php if ($z != 1) { ?>

                                                                <td valign="top"><a href="javascript:removeImages('removeHotelImg.php','<?php echo $row_p['id']; ?>');"><img src="close.png" /></a></td>
                                            <?php } ?>
                                                        </tr>
                                                    </table>
        <?php } ?></td>
                                        </tr>
    <?php } ?>

    <?php
    for ($i = $z; $i <= 9; $i++) {
        ?>
                                        <tr>
                                            <td valign="top"><label><?php if ($i == 1 && $n == 0) {
            echo "Main Image";
        } else { ?>Image <?php } ?>:</label><span style="font-size:11px;">(960px X 630px)</span></td>
                                            <td valign="top"><input type="file"  name="simg<?php echo $i; ?>" id="simg<?php echo $i; ?>"  class="input-xlarge" /></td>
                                            <td width="60" valign="top">&nbsp;</td>
                                            <td valign="top">&nbsp;</td>
                                        </tr>
    <?php } ?>

<?php } ?>

                            </table></td>
                    </tr>

                    <tr>
                        <td><table border="0" cellpadding="5" cellspacing="5">
                                <tr>
                                    <td><table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><div class="btn-toolbar">
                                                        <div id="buttonDiv">
                                                            <button type="submit"  onclick="saveEGX();" class="btn btn-primary"><i class="icon-save"></i> Save </button>
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