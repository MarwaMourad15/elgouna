<?php 
$name= $_SERVER['REQUEST_URI'];
$pgmain=explode("/", $name);
$file=$pgmain[count($pgmain) - 1];
if($file==''){
$file='index.php';}
$file2=explode("?",$file);
$file2=$file2[0];?><div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li><a href="logout.php" class="hidden-phone visible-tablet visible-desktop" role="button">Logout</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" >
                            <i class="icon-user"></i> <?php echo $_SESSION['session_elgouna_mobileApp_username'];?>
                           
                        </a>

                        <ul class="dropdown-menu" style="display:none">
                            <li><a tabindex="-1" href="#"></a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="http://kangaroo-dm.com/" target="_blank"><span class="first"></span> <span class="second"><img src="images/logo.png" style="height:80px; border-radius:10px;"></span></a>
        </div>