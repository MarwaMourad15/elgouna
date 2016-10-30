<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44 = "select * from beaches where hidden=0 order by ord asc";
//echo $sql44;
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
$sql = "select * from beaches where hidden=0 order by ord asc limit $start,$limit";
$result = mysql_query($sql);
?><div class="well"  >
<?php
if ($num != 0) {
    $k = 0;
    ?>
    <table class="table"  style="">
        <thead style="">
            <tr>
                <th style="width:20px">#</th>
                <th style="width:400px">Title</th>
                <th style="width:400px">Rating Stars</th>
                <th style="width:400px">Likes</th>
                <th style="width:400px">Reviews</th>
                <th style="width:400px">Manage Reviews</th>
                <th style="width: 26px">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($row = mysql_fetch_array($result)) {
        $k++;
        $e = $k % 2;
        ?>
            <tr <?php if ($e == 0) { ?> style="background-color:#EFEFEF" <?php } ?>>
                <td width="20"><?php echo $k + ($_POST['pgid'] * 15); ?></td>
                <td width="400" style=" width:400px;"><?php echo $row['name']; ?></td>
                <td width="400" style=" width:400px;"><?php for ($i = 0; $i < $row['ratingStar']; $i++) { ?><img src="images/star.png" /><?php } ?></td>
                <td width="400" style=" width:400px;"><?php
                    $sql_like = "select id from user_beach_like where beach_id='$row[id]'";
                    $r_like = mysql_query($sql_like);
                    $n_like = 0;
                    $n_like = mysql_num_rows($r_like);
                    echo '(' . $n_like . ') Likes';
                    ?></td>
                <td width="400" style=" width:400px;"><?php
                    $sql_r = "select title from rate_range where `start`<='$row[reviewScore]' and `end`>='$row[reviewScore]'";
                    $r_r = mysql_query($sql_r);
                    $row_r = mysql_fetch_array($r_r);
                    $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
                    echo $reviewScoreFinal;
                    ?></td>
                <td width="400" style=" width:400px;">
                <?php
                $sql_re = "select id from beach_review where beach_id='$row[id]' and approved=0";
                $r_re = mysql_query($sql_re);
                $n_re = 0;
                $n_re = mysql_num_rows($r_re);
                if($n_re > 0) {
                ?>
                    <a href="beachReviews.php?id=<?php echo $row['id']; ?>">
                <?php
                echo $n_re;
                if($n_re > 1) {
                ?> 
                        reviews
                <?php 
                }
                else {
                ?> 
                        review
                <?php 
                }
                ?>
                </a>
                <?php
                } 
                else {
                ?>
                    No reviews
                <?php
                }
                ?>
                </td>
                <td width="26">
                    <a href="javascript:addNewItem('createNewBeach.php?id=<?php echo $row['id']; ?>','<?php echo $_POST['pgid']; ?>');"><i class="fa fa-pencil"></i></a>
                    <a href="#myModal" onclick="deleteItem('deleteBeach.php', '<?php echo $row['id']; ?>', '<?php echo $_POST['pgid']; ?>', '3')" role="button" data-toggle="modal"><i class="fa fa-remove"></i></a> <?php if ($row['hidden'] == 1) { ?><i class="icon-remove-circle"></i><?php } ?>         </td>
            </tr>
                
        <?php }
        ?>
        </tbody>
    </table>
    <?php
    } else { ?>
        <i class="fa fa-exclamation-triangle" style="width:100%;padding:20px 0;text-align:center;color:darkred;font-size:50px;opacity:0.5"></i>
        <p style="text-align:center;color:#000;font-size:16px;font-weight:bold">
            No beaches were found.
        </p>
<?php } ?>

</div>
        <?php if ($num > $limit) { ?>
    <div class="pagination">
        <ul>
            <?php if ($D != 1) { ?>
                <li><a  href="javascript:ListFn('<?php echo $ID - 1; ?>','beachesList.php');" title="Previous Page">« Prev.</a></li>
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
                    <li> <a href="javascript:ListFn('<?php echo $i; ?>','beachesList.php');"   title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                    <?php } else { ?>
                    <li > <a href="javascript:ListFn('<?php echo $i; ?>','beachesList.php');" style="background-color:#F4F4F4"  title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                <?php }
            } ?>

    <?php if ($D != ($pagenumber)) { ?>
                <li><a href="javascript:ListFn('<?php echo $ID + 1; ?>','beachesList.php');" title="Next Page">Next »</a></li>
    <?php } ?>
        </ul>
    </div>
<?php
}?>