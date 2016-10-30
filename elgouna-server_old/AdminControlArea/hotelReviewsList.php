<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44 = "select * from hotel_review where user_id<>'' and hotel_id='$_GET[id]' order by approved asc, date desc";
$res44 = mysql_query($sql44);
$row44 = mysql_fetch_array($res44);
$num = mysql_num_rows($res44);
$ID = $_POST['pgid'];
$limit = 15;
if ($ID == "")
    $ID = 0;
$D = $ID + 1;
if ($ID == "") {
    $start = 0;
} else {
    $start = $ID * $limit;
}
$pagenumber = ceil($num / $limit);
$end = $start + $limit;
$sql = "select * from hotel_review where user_id<>'' and hotel_id='$_GET[id]' order by approved asc, date desc limit $start,$limit";
$result = mysql_query($sql);
?><div class="well"  >
<?php
if ($num != 0) {
    ?>
        <div style="float:right; right:30px;"><strong><?php echo $num; ?> Reviews</strong></div>
        <table class="table"  style="">
            <thead style="">
                <tr>
                    <th style="width:150px;">Date</th>
                    <th style="width:200px;  " > Name</th>
                    <th style="width:600px;  " >Review</th>
                    <th style="width:100px;  " >Rating</th>
                    <th style="width:100px;  " >Status</th>
                    <th style="width: 26px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $k = 0;
                while ($row = mysql_fetch_array($result)) {
                    $k++;
                    $e = $k % 2;
                    ?>

                    <tr <?php if ($e == 0) { ?> style="background-color:#EFEFEF" <?php } ?>>
                        <td width="20"><?php echo $row['date']; ?></td>
                        <td width="400" style=" width:200px;"><?php
                            $sql_u = "select * from users where id='$row[user_id]'";
                            $r_u = mysql_query($sql_u);
                            $row_u = mysql_fetch_array($r_u);
                            echo $row_u['name'];
                            ?></td>
                        <td width="400" style=" width:600px;"><?php echo $row['review']; ?></td>

                        <td width="400" style=" width:100px;"><?php echo $row['rating']; ?></td>
                        <td width="400" style=" width:100px;"><?php
                            if ($row['approved'] == 0) {
                                echo "Pending";
                            } else if ($row['approved'] == 1) {
                                echo "Approved";
                            } else {
                                echo "Declined";
                            }
                            ?></td>
                        <td width="26">
                            <a href="#myModal2"  onclick="deleteItem('ApproveHotelReview.php', '<?php echo $row['id']; ?>', '<?php echo $_POST['pgid']; ?>', '2')" role="button" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                            <a href="#myModal"  onclick="deleteItem('deleteHotelReview.php', '<?php echo $row['id']; ?>', '<?php echo $_POST['pgid']; ?>', '2')" role="button" data-toggle="modal"><i class="fa fa-remove"></i></a> <?php if ($row['hidden'] == 1) { ?><i class="icon-remove-circle"></i><?php } ?>         </td>
                    </tr>

    <?php }
    ?>
            </tbody>
        </table>
    <?php } else {
    ?>
        <i class="fa fa-exclamation-triangle" style="width:100%;padding:20px 0;text-align:center;color:darkred;font-size:50px;opacity:0.5"></i>
        <p style="text-align:center;color:#000;font-size:16px;font-weight:bold">
            No reviews were found.
        </p>
<?php } ?>

</div>
        <?php if ($num > $limit) { ?>
    <div class="pagination">
        <ul>
            <?php if ($D != 1) { ?>
                <li><a  href="javascript:ListFn('<?php echo $ID - 1; ?>','hotelReviewsList.php?id=<?php echo $_GET['id']; ?>');" title="Previous Page">« Prev.</a></li>
            <?php } ?>
            <?php
            $e = 0;
            $s = 4;
            if ($_POST['pgid'] >= $s - 2) {
                $e = $_POST['pgid'] - 1;
                $s = $e + $s;
            }
            if ($s > $pagenumber)
                $s = $pagenumber;
            for ($i = $e; $i < $s; $i++) {
                ?>
                <?php if ($D != ($i + 1)) { ?>
                    <li> <a href="javascript:ListFn('<?php echo $i; ?>','hotelReviewsList.php?id=<?php echo $_GET['id']; ?>');"   title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                    <?php } else { ?>
                    <li > <a href="javascript:ListFn('<?php echo $i; ?>','hotelReviewsList.php?id=<?php echo $_GET['id']; ?>');" style="background-color:#F4F4F4"  title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                <?php }
            }
            ?>

    <?php if ($D != ($pagenumber)) { ?>
                <li><a href="javascript:ListFn('<?php echo $ID + 1; ?>','hotelReviewsList.php?id=<?php echo $_GET['id']; ?>');" title="Next Page">Next »</a></li>
    <?php } ?>
        </ul>
    </div>
    <?php
}?>