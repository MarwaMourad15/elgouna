<?php
session_start();
include("../db_conn.php");
date_default_timezone_set('Africa/Cairo');
$sql44 = "select * from services where hidden=0 order by ord asc";
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
$sql = "select * from services where hidden=0 order by ord asc limit $start,$limit";
$result = mysql_query($sql);
?><div class="well"  >


    <?php if ($num != 0) {
        ?>
        <table class="table"  style="">
            <thead style="">
                <tr>
                    <th style="width:20px;">#</th>
                    <th style="width:400px;  " > Title</th>
                    <th style="width:400px;  " ></th>
                    <th style="width:400px;  " ></th>
                    <th style="width:400px;  " ></th>
                    <th style="width:400px;  " ></th>
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
                        <td width="20"><?php echo $k + ($_POST['pgid'] * 15); ?></td>
                        <td width="400" style=" width:400px;"><?php echo $row['title']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td width="26">
                            <a href="javascript:addNewItem('createNewService.php?id=<?php echo $row['id']; ?>','<?php echo $_POST['pgid']; ?>');"><i class="fa fa-pencil"></i></a>
                            <a href="#myModal" onclick="deleteItem('deleteServcie.php', '<?php echo $row['id']; ?>', '<?php echo $_POST['pgid']; ?>', '5')" role="button" data-toggle="modal"><i class="fa fa-remove"></i></a> <?php if ($row['hidden'] == 1) { ?><i class="icon-remove-circle"></i><?php } ?>         </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
        <?php } else {
        ?>
        <i class="fa fa-exclamation-triangle" style="width:100%;padding:20px 0;text-align:center;color:darkred;font-size:50px;opacity:0.5"></i>
        <p style="text-align:center;color:#000;font-size:16px;font-weight:bold">
            No hotels were found.
        </p>
    <?php } ?>

</div>
<?php if ($num > $limit) { ?>
    <div class="pagination">
        <ul>
            <?php if ($D != 1) { ?>
                <li><a  href="javascript:ListFn('<?php echo $ID - 1; ?>','servicesList.php');" title="Previous Page">« Prev.</a></li>
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
                    <li> <a href="javascript:ListFn('<?php echo $i; ?>','servicesList.php');"   title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                <?php } else { ?>
                    <li > <a href="javascript:ListFn('<?php echo $i; ?>','servicesList.php');" style="background-color:#F4F4F4"  title="<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                    <?php }
                } ?>

            <?php if ($D != ($pagenumber)) { ?>
                <li><a href="javascript:ListFn('<?php echo $ID + 1; ?>','servicesList.php');" title="Next Page">Next »</a></li>
    <?php } ?>
        </ul>
    </div>
<?php
}?>