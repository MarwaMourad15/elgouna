<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44 = "select * from contact where msg<>'' order by id desc";
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
$sql = "select * from contact where msg<>'' order by id desc limit $start,$limit";
$result = mysql_query($sql);
?><div class="well"  >
    <div style="float:right; right:30px;"><strong><?php echo $num; ?> Inquiries</strong></div>
    <?php if ($num != 0) {
        ?>
        <table class="table"  style="">
            <thead style="">
                <tr>
                    <th style="width:20px;">#</th>
                    <th width="150" style="width:200px;  " > Date</th>
                    <th style="width:200px;  " >Name</th>
                    <th style="width:200px;  " >E-mail</th>
                    <th style="width:200px;  " >Phone</th>
                    <th style="width:300px;  " >Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $k = 0;
                while ($row = mysql_fetch_array($result)) {
                    $k++;
                    $e = $k % 2;
                    ?>
                    <tr valign="top" style="background-color:#EFEFEF" <?php if ($e == 0) { ?> <?php } ?>>
                        <td width="20"><?php echo $k + ($_POST['pgid'] * 15); ?></td>
                        <td width="200" style=" width:200px;"><?php echo $row['date']; ?></td>
                        <td width="500" style=" width:200px;"><?php echo $row['name']; ?></td>
                        <td width="500" style=" width:200px;"><?php echo $row['email']; ?></td>
                        <td width="500" style=" width:200px;"><?php echo $row['phone']; ?></td>
                        <td width="500" style=" width:300px;"><?php echo $row['msg']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <i class="fa fa-exclamation-triangle" style="width:100%;padding:20px 0;text-align:center;color:darkred;font-size:50px;opacity:0.5"></i>
        <p style="text-align:center;color:#000;font-size:16px;font-weight:bold">
            No contacts were found.
        </p>
    <?php } ?>

</div>
<?php if ($num > $limit) { ?>
    <div class="pagination">
        <ul>
            <?php if ($D != 1) { ?>
                <li><a  href="javascript:ListFn('<?php echo $ID - 1; ?>','contactList.php');" title="Previous Page">« Prev.</a></li>
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
                    <li> <a href="javascript:ListFn('<?php echo $i; ?>','contactList.php');"   title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                <?php } else { ?>
                    <li > <a href="javascript:ListFn('<?php echo $i; ?>','contactList.php');" style="background-color:#F4F4F4"  title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                        <?php
                    }
                }
                ?>

            <?php if ($D != ($pagenumber)) { ?>
                <li><a href="javascript:ListFn('<?php echo $ID + 1; ?>','contactList.php');" title="Next Page">Next »</a></li>
            <?php } ?>
        </ul>
    </div>
    <?php
}?>