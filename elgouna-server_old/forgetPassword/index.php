<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Gouna Mobile Applications</title>
    <link href="styles/style.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.1.min.js"></script>
    <script src="../func.js"></script>
</head>
<?php

include("../AdminControlArea/db_conn.php");
if(isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $token_query = mysql_query("select * "
            . "from users "
            . "where auth_reset_token = '$token'");
    if($token_query) {
        $token_row = mysql_num_rows($token_query);
        if($token_row == 0) {
            
            
?>
    <body>
        <div class="container" style="background:none; background-color:#F4F3F1">
            <div class="logo">
                <img src="images/logo.png" />
            </div>
            <div class="inner">
                <h2>
                    Invalid token.
                </h2>
            </div>
        </div>
    </body>
<?php    

            exit;
        }
        else {
            $user_arr = mysql_fetch_assoc($token_query);
            $uid = $user_arr['id'];
        }
        
?>
    <body>
        <div class="container" style="background:none; background-color:#F4F3F1">
            <div class="logo">
                <img src="images/logo.png" />
            </div>
            <div class="inner">
                <h2>
                    El Gouna Mobile Application
                </h2>
                <h4>
                    Please make sure to fill all the fields.
                </h4>
                <div id="thx-div" class='thx-div'>
                    <h3>
                        Your password has been reset.
                    </h3>
                </div>
                <label>
                    New Password:
                </label>
                <input type="text" name="pass" id="pass"/>
                <label>
                    Confirm New Password:
                </label>
                <input type="text" name="cpass" id="cpass"/>
                <div id="error-div" style="display:none">
                    <p>
                        Passwords do not match.
                    </p>
                </div>
                <input type="hidden" name="uid" id="uid" value="<?= $uid ?>">
                <br>
                <div class="clearfix"></div>
                <div id="buttonDiv">
                    <a href="javascript:validateForm();" class="submit_btn">
                        Submit
                    </a>
                </div>
                <div id="loadiDiv" style="display:none">
                    <img src="../AdminControlArea/loading.gif">
                </div>
            </div>
        </div>
        
    </body>
<?php

    }
    else {
        echo mysql_error();
    }
}

?>
</html>
