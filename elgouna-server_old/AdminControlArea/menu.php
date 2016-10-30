<link rel="stylesheet" href="">
<style>
    .icon-pad {
        padding: 0 10px 0 6px;
    }
    .icon-wrap {
        width: 35px;
        display: inline-block;
    }
</style>
<div class="sidebar-nav">
    <a href="#dist-menuzx" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-user icon-pad"></div></i>User's Accounts</a>
    <ul id="dist-menuzx" class="nav nav-list collapse <?php
    if ($file2 == 'users.php') {
        echo "in";
    }
    ?>">
        <li <?php if ($file2 == 'users.php') { ?>class="active" <?php } ?> ><a href="users.php">Manage User's Account</a></li>
    </ul>        


    <a href="#dist-menuz" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-list icon-pad"></i></div>El Gouna App Links</a>
    <ul id="dist-menuz" class="nav nav-list collapse <?php
    if ($file2 == 'booking.php') {
        echo "in";
    }
    ?>">
        <li <?php if ($file2 == 'booking.php') { ?>class="active" <?php } ?> ><a href="booking.php">Manage Link</a></li>

    </ul>        



    <a href="#dist-menu" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-envelope-o icon-pad"></i></div>Contact us</a>
    <ul id="dist-menu" class="nav nav-list collapse <?php
    if ($file2 == 'contact.php') {
        echo "in";
    }
    ?>">
        <li <?php if ($file2 == 'contact.php') { ?>class="active" <?php } ?> ><a href="contact.php">Manage Contact Inquiries</a></li>

    </ul>        



    <a href="#cars-menu" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-hotel icon-pad"></i></div>Hotels</a>
    <ul id="cars-menu" class="nav nav-list collapse <?php
    if ($file2 == 'hotels.php' || $file2 == 'services.php') {
        echo "in";
    }
    ?>">
        <li <?php if ($file2 == 'services.php') { ?>class="active" <?php } ?> ><a href="services.php">Manage Servcies</a></li>

        <li <?php if ($file2 == 'hotels.php') { ?>class="active" <?php } ?> ><a href="hotels.php">Manage Hotels</a></li>

    </ul>        



    <a href="#cars-menux" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-home icon-pad"></i></div>Beaches</a>
    <ul id="cars-menux" class="nav nav-list collapse <?php
    if ($file2 == 'beaches.php') {
        echo "in";
    }
    ?>">

        <li <?php if ($file2 == 'beaches.php') { ?>class="active" <?php } ?> ><a href="beaches.php">Manage Beaches </a></li>

    </ul>        

    <!--appenza-->
    <a href="#venues-menu" class="nav-header" data-toggle="collapse">
        <div class="icon-wrap"><i class="fa fa-home icon-pad">
        </i></div>Venues
    </a>
    <ul id="venues-menu" class="nav nav-list collapse 
        <?php
        if ($file2 == 'resetPass.php') {
            echo "in";
        }
        ?>
        ">
        <li 
            <?php
            if ($file2 == 'resetPass.php') {
                ?>
                class="active" 

    <?php
}
?> 
            >
            <a href="venues.php">
                Manage Venues
            </a>
        </li>
    </ul>
    <a href="#trans-menu" class="nav-header" data-toggle="collapse">
        <div class="icon-wrap"><i class="fa fa-bus icon-pad">
        </i></div>Transportation
    </a>
    <ul id="trans-menu" class="nav nav-list collapse 
    <?php
    if ($file2 == 'resetPass.php') {
        echo "in";
    }
    ?>
        ">
        <li 
        <?php
        if ($file2 == 'resetPass.php') {
            ?>
                class="active" 

                <?php
            }
            ?> 
            >
            <a href="transportation.php">
                Manage Transportation Types
            </a>
        </li>
    </ul>
    <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><div class="icon-wrap"><i class="fa fa-cog icon-pad"></i></div>Account Settings</a>
    <ul id="accounts-menu" class="nav nav-list collapse <?php
    if ($file2 == 'resetPass.php') {
        echo "in";
    }
    ?>">
        <li <?php if ($file2 == 'resetPass.php') { ?>class="active" <?php } ?> ><a href="resetPass.php">Update Account Info</a></li>
    </ul>






</div>