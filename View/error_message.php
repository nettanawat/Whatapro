<!DOCTYPE html>
<html>
<head>
    <title>WAP</title>
    <?php
    include dirname(__FILE__) . '/../Config.php';
    $assetPath = Config::PATH.'';
    include_once '../assets.php';
    session_start();
    ?>
    <meta http-equiv='refresh' content='3;url=Whatapro'>

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img width="80px" src="../Whatapro/img/logo.png">
        </div>
        <div class="navbar-collapse collapse">

        </div><!--/.nav-collapse -->
    </div>
</div>

<div  style="margin: 80px;" class="container-fluid">
    <div class="row text-center">
        <div class="col-md-12">
            <h2 class="text-danger">Oops!</h2>
        </div>
        <div class="col-md-12">
            <p class="text-danger"><?php echo("<p class='text-danger'> ".$_SESSION['error_message']." </p>");
                unset($_SESSION['error_message']);
                ?></p>
        </div>
    </div>
</div> <!-- /container -->
</body>
<script src="<?php echo $assetPath; ?>/jquery.js"></script>
<script src="<?php echo $assetPath; ?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>