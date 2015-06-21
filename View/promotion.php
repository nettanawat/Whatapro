<?php
include_once 'session.php';

?>
<html>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../google_jsapi.js"></script>


</head>
<body>
<div style="margin: 55px;"></div>

<div style="padding-bottom: 30px;" class="container-fluid">
    <div class="row">

        <div style="height: 350px" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div style="height: 350px" class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="../img/bake.jpg" alt="...">
                </div>
                <div class="item">
                    <img src="../img/bake_opacity.png" alt="...">
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
    <!--row-->
</div>
<!--container-->
<div class="container-fluid text-center">
    <p>Copyright &copy; nettanawat 2015 All rights reserved</p>
</div>
</body>
</html>
