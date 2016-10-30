<style>
    .pagination a.selected {
        background: #EFEFEF;
    }
</style>
<script src="lib/jquery-1.8.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function deleteVenue(vid) {
        $('.btn-danger').click(function () {
            $("#logdingImg").show();
            console.log(vid);
            $.ajax({
                type: "POST",
                url: "deleteVenue.php",
                data: {
                    venue_id: vid
                },
                success: function (data) {
                    $("#logdingImg").hide();
                    window.location.href = "?pgid=0&fl=1";
                    console.log(data);
                },
                error: function (data) {
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
$all_venues_sql = "select *"
        . " from venues";
$all_venues_query = mysql_query($all_venues_sql);
if ($all_venues_query) {

    $all_venues_rows = mysql_num_rows($all_venues_query);
    if ($all_venues_rows > 0) {

        $limit = 15;
        if (isset($_POST['pgid'])) {

            $page = $_POST['pgid'];
            if ($page != 0) {

                $offset = ($page - 1) * $limit;
            } else {

                $page = 0;
                $offset = 0;
                $D = 0;
            }
        }
    }
    $pages = ceil($all_venues_rows / $limit);
}
//$end=$start+$limit;
$venues_sql = "select *"
        . " from venues"
        . " order by id desc"
        . " limit $limit"
        . " offset $offset";
$venues_query = mysql_query($venues_sql);
if ($venues_query) {
    ?>     
            <!--<div><h1><? //$_POST['pgid'] ?></h1></div>-->
    <div class="well">
        <table class="table"  style="">
            <thead style="">
                <tr>
                    <th style="width:20px;">#</th>
                    <th style="width:400px;" >Title</th>
                    <th style="width:400px;" >Rating Stars</th>
                    <th style="width:400px;" ></th>
                    <th style="width:400px;" ></th>
                    <th style="width:400px;" >Likes</th>
                    <th style="width: 26px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $venues_rows = mysql_num_rows($venues_query);
                if ($venues_rows > 0) {

                    $count = 0;
                    while ($venues_arr = mysql_fetch_assoc($venues_query)) {

                        $count++;
                        $is_even = $count % 2;
                        ?>
                        <tr 
                        <?php
                        if ($is_even == 0) {
                            ?> 
                                style="background-color:#EFEFEF" 
                                <?php
                            }
                            ?>
                            >
                            <td width="20">
                                <?php
                                $page = $_POST['pgid'];
                                echo isset($page) ? (($page != 1 && $page != 0) ? $count + (($_POST['pgid'] - 1) * 15) : $count) : $count;
                                ?>
                            </td>
                            <td id="venues-name" width="400" 
                                style="max-width:117px; 
                                word-wrap: break-word; 
                                white-space: normal">
            <?php
            echo $venues_arr['name'];
            ?>
                            </td>
                            <td width="400" style="width:400px;">
                                <?php
                                for ($i = 0; $i < $venues_arr['ratingStar']; $i++) {
                                    ?>
                                    <img src="images/star.png" />
                                    <?php
                                }
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td width="400" style="width:400px;">
                                <?php
                                $likes_sql = "select id"
                                        . " from user_hotel_like"
                                        . " where hotel_id = '" . $venues_arr['id'] . "'";
                                $likes_query = mysql_query($likes_sql);
                                if ($likes_query) {

                                    $likes_num = mysql_num_rows($likes_query);
                                    if($likes_num > 0) {
                                        echo '(' . $likes_num . ') likes';
                                    }
                                    else {
                                        echo 'No likes';
                                    }
                                }
                                ?>
                            </td>
                            <td width="26">
                                <a href="javascript:addNewItem('createNewVenue.php?id=
                                <?php
                                echo $venues_arr['id'];
                                ?>
                                   ','
                                <?php
                                echo $page;
                                ?>
                                   ');">
                                    <i class="fa fa-pencil">
                                    </i>
                                </a>
                                <a href="#myModal" id="delete" role="button" data-toggle="modal" onclick="deleteVenue(<?= $venues_arr['id'] ?>)">
                                    <i class="fa fa-remove">

                                    </i>
                                </a>
                            </td>
                        </tr>
                                <?php
                            }
                            if ($all_venues_rows > $limit) {
                                ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <ul>        
                                   <?php
                                   if ($page > 1) {
                                       ?>
                            <li>
                                <a href='javascript:ListFn("<?= $page - 1 ?>", "venuesList.php")' 
                                   title='previous page'>
                                    &laquo; Prev
                                </a>
                            </li>
                <?php
            }

            for ($i = 1; $i <= $pages; $i++) {

                if ((!(isset($page)) || $page == 0) && $i == 1) {

                    $is_selected = 'selected';
                } else {

                    $is_selected = $i == $page ? 'selected' : '';
                }
                ?>
                            <li> 
                                <a href="javascript:ListFn('<?= $i ?>
                                   ','venuesList.php')" id="page-<?= $i ?>" title="page-<?= $i ?>" class="<?= $is_selected ?>">
                            <?= $i ?>
                                </a>
                            </li>
                <?php
            }
            if ($page < $pages) {
                ?>
                            <li>
                                <a href='javascript:ListFn("<?= $page + 1 ?>", "venuesList.php")' 
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
                } else {
                    ?>
            <tr>
                <td colspan="6"> 
                    <p style="text-align:center; padding-top:20px; color:#3C5A9A; 
                       font-size:25px; font-weight:bold">
                        No venues found.
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
                Are You sure you want to delete this venues?
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
        <input type="hidden"  name="venueid" id="venueid" value="<?= $venues_arr['id'] ?>">
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

