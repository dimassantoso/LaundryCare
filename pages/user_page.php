<?php 
    session_start();
    require_once('../php/db.php');
    require_once('../php/error.php');
    set_error_handler('handleError');
    require('../php/url.php');
    set_error_handler('handleError');
    if(!isset($_SESSION['login_user'])){
        //echo $login_page;
        header('Location: '.$reg);
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <title>LaundryCare: Professional Laundry Service</title>

    <!-- stylesheet css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/nivo-lightbox.css">
    <link rel="stylesheet" href="../css/nivo_themes/default/default.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/user_.css">    
    <script src="../js/vendor/modernizr-2.6.2.min.js"></script>
   
    <!-- google web font css -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700' rel='stylesheet' type='text/css'>

</head>
<body data-spy="scroll" data-target=".navbar-collapse">
    
<!-- navigation -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="../index.php" class="navbar-brand smoothScroll">LaundryCare</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../index.php" class="smoothScroll">HOME</a></li>
                <?php
                    if(count($_SESSION)>0){
                        // echo "<li><a href='pages/login.php'>".$_SESSION['login_user']."</a></li>";
                        echo "<li class='dropdown'>".   
                            "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".
                            $_SESSION['login_user']."<b class='caret'></b></a>".
                            "<ul class='dropdown-menu'>".                                
                                "<li><a href='../php/logout.php'>LOG OUT</a></li>".
                                "</ul></li>";

                    }
                ?>
                
            </ul>
        </div>
    </div>
</div>  
<div class="user-wrapper">
    <div  class="wrapper">
        <div class="user-wrap">
            <div class="user-menu left">
                <div class="user-avatar">
                    <span>
                        <img src="../images/user-avatar.png">
                    </span>
                    <h1><?php echo $_SESSION['login_user'];?></h1>
                    <a href="../php/logout.php">
                        <i class="fa fa-sign-out" aria-hidden=true>Log Out</i>
                    </a>
                </div>
                <div class="user-link">
                    <ul>
                        <li>
                            <a href="user_page.php?query=myorder">
                                <i class="fa fa-shopping-cart"></i>My Order</a>
                        </li>
                        <li>
                            <a href="user_page.php?query=user_password">
                                <i class="fa fa-cog"></i>Setting</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
                if(isset($_GET['query'])){
                    $page = $_GET['query'];
                    if($page=='user_data'||$page=='user_password'||$page=='myorder')
                        include $page.'.php';
                    else
                        echo "You requested a non-exist page";
                } 
                else
                    include 'myorder.php';
            ?>
        </div>
    </div>
</div>

<!-- service section -->

<!-- divider section -->
<div class="container">
    <div class="row">
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-10 col-sm-10">
            <hr>
        </div>
        <div class="col-md-1 col-sm-1"></div>
    </div>
</div>

<?php
    include 'footer.php';
?>

<!-- divider section -->
<div class="container">
    <div class="row">
        <div class="col-md-1 col-sm-1"></div>
        <div class="col-md-10 col-sm-10">
            <hr>
        </div>
        <div class="col-md-1 col-sm-1"></div>
    </div>
</div>

<!-- copyright section -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p>Copyright &copy; 2017 4bit Digital Firm 
                
                - Design: <a rel="nofollow" href="http://www.4bit.com" target="_parent">4bit</a></p>
            </div>
        </div>
    </div>
</div>

<!-- scrolltop section -->
<a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a>


<!-- javascript js -->  
<script src="../js/jquery-v3.js"></script>
<script src="../js/bootstrap.min.js"></script>  
<script src="../js/nivo-lightbox.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/jquery.nav.js"></script>
<script src="../js/isotope.js"></script>
<script src="../js/imagesloaded.min.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/login.js"></script>
</body>
</html>